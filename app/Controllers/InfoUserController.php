<?php

namespace App\Controllers;

use App\Models\InfoUser;

class InfoUserController extends BaseController
{
    public function insererInfoUser()
    {

        $infoUserModel = new InfoUser();
        if ($infoUserModel->find(session()->get('user')['id'] != null)) {
            return redirect()->to(site_url('/programme/liste'));
        }
        $data = [
            'userId' => session()->get('userId'),
            'prenom' => $this->request->getPost('prenom'),
            'age' => $this->request->getPost('age'),
            'poids' => $this->request->getPost('poids'),
            'taille' => $this->request->getPost('taille'),
        ];
        $infoUserModel->insert($data);
        return redirect()->to(site_url('/programme/liste'))->with('success', "Vos informations ont été enregistrées avec succès.");
    }
    public function afficherFormulaireInfoUser()
    {
        return view('infoUser/formulaire');
    }

}
