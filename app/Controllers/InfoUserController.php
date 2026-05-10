<?php

namespace App\Controllers;

use App\Models\InfoUser;

class InfoUserController extends BaseController
{
    public function insererInfoUser()
    {
        $infoUserModel = new InfoUser();
        $userSession = session()->get('user');
        $userId = $userSession['id'] ?? null;

        $data = [
            'userId' => $userId,
            'prenom' => $this->request->getPost('prenom'),
            'age' => $this->request->getPost('age'),
            'poids' => $this->request->getPost('poids'),
            'taille' => $this->request->getPost('taille'),
        ];

        if (!$infoUserModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $infoUserModel->errors());
        }

        return redirect()->back()->with('InfoSuccess', "Vos informations ont été enregistrées avec succès.");
    }

    public function afficherFormulaireInfoUser()
    {
        return view('form/infoUser');
    }

    public function calculIMC($id = null)
    {
        $infoUserModel = new InfoUser();
        $infoUser = $infoUserModel->find($id);
        if (!$infoUser) {
            return redirect()->to(site_url('/programme/liste'))->with('error', "Informations utilisateur non trouvées.");
        }
        $poids = $infoUser['poids'];
        $taille = $infoUser['taille'] / 100; // Convertir la taille en mètres
        $imc = $poids / ($taille * $taille);
        return round($imc, 2);
    }
    public function calculPoidsIdeal($id = null)
    {
        $infoUserModel = new InfoUser();
        $infoUser = $infoUserModel->find($id);
        $taille = $infoUser['taille'] / 100;
        $poidsIdeal = 21.5 * ($taille * $taille);
        return round($poidsIdeal, 2);
    }
}
