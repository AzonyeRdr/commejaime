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
    public function calculIMC($id){
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
    public function calculPoidsIdeal($id){
        $infoUserModel=new InfoUser();
        $infoUser=$infoUserModel->find($id);
        $taille=$infoUser['taille']/100;
        $poidsIdeal=21.5*($taille*$taille);
        return round($poidsIdeal,2);
    }

}
