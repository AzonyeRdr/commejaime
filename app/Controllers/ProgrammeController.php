<?php

namespace App\Controllers;

use App\Models\Programme;
use App\Models\Objectif;
use App\Models\ProgrammeRegime;
use App\Models\IngredientRegime;
use App\Models\User;
use App\Models\InscriptionProgramme;
use App\Models\ProgrammeSport;
use App\Models\InfoUser;
use App\Controllers\InfoUserController;
class ProgrammeController extends BaseController
{
    public function programmeSuggereIMC($id){
        $infoUserModel=new InfoUser();
        $userInfo=$infoUserModel->find($id);
        $poids = $userInfo['poids'];
        $infoUserController=new InfoUserController();
        $poidsIdeal=$infoUserController->calculPoidsIdeal($id);
        $variationPoids = $poids - $poidsIdeal;
        if($variationPoids<0){
            return 1;
        }
        else if($variationPoids>0){
            return 2;
        }

    }
    public function index()
    {
        $user = session()->get('user');

        $modelProgramme = new Programme();
        $modelObjectif = new Objectif();
        $modelProgrammeRegime = new ProgrammeRegime();
        $modelIngredientRegime = new IngredientRegime();

        $programmes = $modelProgramme->findAll();
        $objectifs = $modelObjectif->findAll();

        $vIngredientRegimes = $modelIngredientRegime->findAll();
        $prixParRegime = [];
        foreach ($vIngredientRegimes as $vir) {
            if (!isset($prixParRegime[$vir['regimeId']])) {
                $prixParRegime[$vir['regimeId']] = 0;
            }
            $prixParRegime[$vir['regimeId']] += ($vir['pourcentage'] / 100) * $vir['poidsTotalPlat'] * $vir['prixG'];
        }

        $programmeRegimes = $modelProgrammeRegime->findAll();

        foreach ($programmes as &$programme) {
            $programme['objectif'] = $modelObjectif->find($programme['objId']);

            $prixTotal = 0;
            foreach ($programmeRegimes as $pr) {
                if ($pr['programmeId'] == $programme['id']) {
                    $prixTotal += $prixParRegime[$pr['regimeId']] ?? 0;
                }
            }
            $programme['prix'] = $prixTotal;

            if ($user['roleId'] == 2) {
                $programme['prix'] = floor($programme['prix'] * 0.85);
            }
        }

        return view('program/index', [
            'programmes' => $programmes,
            'objectifs' => $objectifs,
            'isGold' => $user['roleId'] == 2
        ]);
    }

    public function inscrire()
    {
        $programmeId = $this->request->getPost('programmeId');

        $modelProgramme = new Programme();
        $modelUser = new User();
        $modelInscription = new InscriptionProgramme();
        $modelProgrammeRegime = new ProgrammeRegime();
        $modelIngredientRegime = new IngredientRegime();

        $programme = $modelProgramme->find($programmeId);
        if (!$programme) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Programme non trouvé'
            ]);
        }

        $user = session()->get('user');

        $vIngredientRegimes = $modelIngredientRegime->findAll();
        $prixParRegime = [];

        foreach ($vIngredientRegimes as $vir) {
            if (!isset($prixParRegime[$vir['regimeId']])) {
                $prixParRegime[$vir['regimeId']] = 0;
            }
            $prixParRegime[$vir['regimeId']] += ($vir['pourcentage'] / 100) * $vir['poidsTotalPlat'] * $vir['prixG'];
        }

        $programmeRegimes = $modelProgrammeRegime->where('programmeId', $programme['id'])->findAll();

        $prixTotal = 0;
        foreach ($programmeRegimes as $pr) {
            $regimeId = $pr['regimeId'];
            $prixTotal += $prixParRegime[$regimeId] ?? 0;
        }

        if ($user['roleId'] == 2) {
            $prixTotal = floor($prixTotal * 0.85);
        }

        $inscriptionExistante = $modelInscription
            ->where('userId', $user['id'])
            ->where('programmeId', $programmeId)
            ->first();

        if ($inscriptionExistante) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Vous êtes déjà souscrit à ce programme.'
            ]);
        }

        $userData = $modelUser->find($user['id']);
        if ($userData['montant'] < $prixTotal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Solde insuffisant. Veuillez recharger votre portefeuille.'
            ]);
        }

        $newMontant = $userData['montant'] - $prixTotal;
        $modelUser->update($user['id'], [
            'montant' => $newMontant
        ]);

        $modelInscription->insert([
            'userId' => $user['id'],
            'programmeId' => $programmeId,
            'dateInscription' => date('Y-m-d')
        ]);

        session()->set('user', array_merge($user, [
            'montant' => $newMontant
        ]));

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Programme acheté avec succès!'
        ]);
    }

    public function detail($id = null)
    {

        $user = session()->get('user');
        $modelInscription = new InscriptionProgramme();

        $inscriptionExistante = $modelInscription
            ->where('userId', $user['id'])
            ->where('programmeId', $id)
            ->first();

        if (!$inscriptionExistante) {
            return redirect()->back()->with('NonInscrit', 'Vous devez vous inscrire pour accéder à ce programme');
        }

        $modelProgramme = new Programme();
        $modelProgrammeRegime = new ProgrammeRegime();
        $modelProgrammeSport = new ProgrammeSport();

        $programme = $modelProgramme->find($id);

        $regimes = $modelProgrammeRegime->where('programmeId', $id)->findAll();
        $sports = $modelProgrammeSport->where('programmeId', $id)->findAll();

        $planning = [];
        $nombreJour = $programme['nombreJour'] ?? 7;

        for ($i = 1; $i <= $nombreJour; $i++) {
            $jourModulo = (($i - 1) % 7) + 1;

            $planning[$i] = [
                'regimes' => array_filter($regimes, fn($r) => $r['jour'] == $jourModulo),
                'sports' => array_filter($sports, fn($s) => $s['jour'] == $jourModulo)
            ];
        }

        return view('program/detail', [
            'programme' => $programme,
            'planning' => $planning
        ]);
    }


    public function stat()
    {
        $db = \Config\Database::connect();

        $programmes = $db->table('programme p')
            ->select('
                p.id,
                p.nom,
                p.nombreJour,
                p.poids,
                o.lib as objectif,
                COUNT(ip.id) as nbInscription
            ')
            ->join('objectif o', 'o.id = p.objId')
            ->join('inscriptionProgramme ip', 'ip.programmeId = p.id', 'left')
            ->groupBy('p.id')
            ->get()
            ->getResultArray();

        return view('admin/programme', [
            'programmes' => $programmes
        ]);
    }
}
