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

class ProgrammeController extends BaseController
{
    public function programmeSuggereIMC($id)
    {
        $infoUserModel = new \App\Models\InfoUser();
        $userInfo = $infoUserModel->find($id);

        if (!$userInfo) {
            return 1;
        }

        $poids = (float) $userInfo['poids'];
        $taille = (float) $userInfo['taille'] / 100;
        $poidsIdeal = 21.5 * ($taille * $taille);
        $variationPoids = $poids - $poidsIdeal;

        if ($variationPoids < 0) {
            return 1;
        }

        if ($variationPoids > 0) {
            return 2;
        }

        return 1;
    }

    public function index()
    {
        $user = session()->get('user');
        $modelInfoUser = new \App\Models\InfoUser();
        $userInfo = $modelInfoUser->where('userId', $user['id'])->first();

        if (!$userInfo) {
            return redirect()->to(site_url('/infoUser/afficherFormulaire'))->with('error', 'Vous devez remplir votre formulaire d\'informations personnelles avant d\'accéder aux programmes');
        }

        return $this->renderProgrammes(null, false);
    }

    public function programmesSuggereesIMC()
    {
        $user = session()->get('user');
        $modelInfoUser = new \App\Models\InfoUser();
        $userInfo = $modelInfoUser->where('userId', $user['id'])->first();

        if (!$userInfo) {
            return redirect()->to(site_url('/infoUser/afficherFormulaire'))->with('error', 'Veuillez remplir vos informations personnelles avant de consulter les programmes suggérés.');
        }

        $objectifId = $this->programmeSuggereIMC($userInfo['id']);

        return $this->renderProgrammes($objectifId, true);
    }

    private function renderProgrammes(?int $objectifId = null, bool $suggestedOnly = false)
    {
        $user = session()->get('user');

        $modelProgramme = new \App\Models\Programme();
        $modelObjectif = new \App\Models\Objectif();
        $modelProgrammeRegime = new \App\Models\ProgrammeRegime();
        $modelIngredientRegime = new \App\Models\IngredientRegime();

        $objectifs = $modelObjectif->findAll();
        $programmesQuery = $modelProgramme;

        if ($suggestedOnly && $objectifId !== null) {
            $programmesQuery = $programmesQuery->where('objId', $objectifId);
        }

        $programmes = $programmesQuery->findAll();

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
        unset($programme);

        $objectifLib = '';
        if ($objectifId === 1) {
            $objectifLib = 'Perte de poids';
        } elseif ($objectifId === 2) {
            $objectifLib = 'Prise de masse';
        } elseif ($objectifId === 3) {
            $objectifLib = 'Atteindre mon IMC idéal';
        }

        return view('program/index', [
            'programmes' => $programmes,
            'objectifs' => $objectifs,
            'isGold' => $user['roleId'] == 2,
            'estSuggereIMC' => $suggestedOnly,
            'objectifSuggerE' => $objectifLib,
        ]);
    }

    public function inscrire()
    {
        $programmeId = $this->request->getPost('programmeId');

        $modelProgramme = new \App\Models\Programme();
        $modelUser = new \App\Models\User();
        $modelInscription = new \App\Models\InscriptionProgramme();
        $modelProgrammeRegime = new \App\Models\ProgrammeRegime();
        $modelIngredientRegime = new \App\Models\IngredientRegime();

        $programme = $modelProgramme->find($programmeId);
        if (!$programme) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Programme non trouvé'
            ]);
        }

        $user = session()->get('user');
        $modelInfoUser = new InfoUser();
        $userInfo = $modelInfoUser->where('userId', $user['id'])->first();

        if (!$userInfo) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Veuillez remplir votre formulaire d\'informations personnelles avant de vous inscrire à un programme'
            ]);
        }

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
        $modelInscription = new \App\Models\InscriptionProgramme();

        $modelProgramme = new \App\Models\Programme();
        $modelProgrammeRegime = new \App\Models\ProgrammeRegime();
        $modelProgrammeSport = new \App\Models\ProgrammeSport();
        $modelIngredientRegime = new \App\Models\IngredientRegime();
        $modelObjectif = new \App\Models\Objectif();

        $programme = $modelProgramme->find($id);
        if (!$programme) {
            return redirect()->to(site_url('/program'))->with('error', 'Programme introuvable.');
        }

        $inscriptionExistante = $modelInscription
            ->where('userId', $user['id'])
            ->where('programmeId', $id)
            ->first();

        $regimes = $modelProgrammeRegime->where('programmeId', $id)->findAll();
        $sports = $modelProgrammeSport->where('programmeId', $id)->findAll();

        $vIngredientRegimes = $modelIngredientRegime->findAll();
        $prixParRegime = [];
        foreach ($vIngredientRegimes as $vir) {
            if (!isset($prixParRegime[$vir['regimeId']])) {
                $prixParRegime[$vir['regimeId']] = 0;
            }
            $prixParRegime[$vir['regimeId']] += ($vir['pourcentage'] / 100) * $vir['poidsTotalPlat'] * $vir['prixG'];
        }

        $prixTotal = 0;
        foreach ($modelProgrammeRegime->where('programmeId', $id)->findAll() as $pr) {
            $prixTotal += $prixParRegime[$pr['regimeId']] ?? 0;
        }

        if ($user['roleId'] == 2) {
            $prixTotal = floor($prixTotal * 0.85);
        }

        $programme['objectif'] = $modelObjectif->find($programme['objId']);

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
            'planning' => $planning,
            'isInscrit' => (bool) $inscriptionExistante,
            'prixProgramme' => $prixTotal,
            'isGold' => $user['roleId'] == 2,
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
