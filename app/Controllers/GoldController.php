<?php

namespace App\Controllers;

use App\Models\User;

class GoldController extends BaseController
{
    public function activate()
    {
        $user = session()->get('user');
        $modelUser = new User();
        $userData = $modelUser->find($user['id']);

        if ($userData['roleId'] == 2) {
            return redirect()->to(site_url('/index'))->with('success', 'Votre abonnement GOLD est déjà actif.');
        }

        $modelUser->update($user['id'], ['roleId' => 2]);

        $user['roleId'] = 2;
        session()->set('user', $user);

        return redirect()->to(site_url('/index'))->with('success', 'Votre abonnement GOLD a été activé avec succès.');
    }
}
