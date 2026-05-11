<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\InfoUser;

class ProfilController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        $userId = $user['id'];

        $infoUserModel = new InfoUser();
        $infoUser = $infoUserModel->where('userId', $userId)->first();

        $imc = null;
        $poidsIdeal = null;
        $variationPoids = null;

        if ($infoUser) {
            $tailleMetres = $infoUser['taille'] / 100;
            if ($tailleMetres > 0) {
                $imc = round($infoUser['poids'] / ($tailleMetres * $tailleMetres), 2);
                $poidsIdeal = round(21.5 * ($tailleMetres * $tailleMetres), 2);
                $variationPoids = round($infoUser['poids'] - $poidsIdeal, 2);
            }
        }

        $db = \Config\Database::connect();

        $program = $db->table('inscriptionProgramme ip')
            ->select('p.id, p.nom, p.nombreJour, p.poids, p.objId')
            ->join('programme p', 'p.id = ip.programmeId')
            ->where('ip.userId', $userId)
            ->get()
            ->getResultArray();

        return view('profil/index', [
            'infoUser' => $infoUser,
            'user' => $user,
            'program' => $program,
            'imc' => $imc,
            'poidsIdeal' => $poidsIdeal,
            'variationPoids' => $variationPoids,
        ]);
    }

    public function chargerCompte()
    {
        $user = session()->get('user');

        $montant = $this->request->getPost('montant');

        if (!$montant || $montant <= 0) {
            return redirect()->back()->with('error', 'Le montant ne peut pas être négatif.')->withInput();
        }

        $modelUser = new User();
        $userData = $modelUser->find($user['id']);

        $nouveauMontant = $userData['montant'] + $montant;
        $modelUser->update($user['id'], ['montant' => $nouveauMontant]);

        session()->set('user', array_merge($user, ['montant' => $nouveauMontant]));

        return redirect()->back()->with('succes', 'Votre compte a été crédité.');
    }
}
