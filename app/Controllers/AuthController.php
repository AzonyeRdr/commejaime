<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;

class AuthController extends BaseController
{
    public function inscriptionForm()
    {
        return view('auth/signUp');
    }

    public function inscrire()
    {
        $modelUser = new User();
        $modelRole = new Role();

        $roleUser = $modelRole->find(3);

        $email = $this->request->getPost('email');
        $mdp = $this->request->getPost('mdp');

        $newUser = [
            'email' => $email,
            'mdp' => $mdp,
            'roleId' => $roleUser,
            'montant' => 0,
        ];

        $errors = [];

        if (isset($newUser)) {
            $modelUser->insert($newUser);
            $errors = $modelUser->errors();
        }

        if ($errors !== []) {
            redirect()->to(site_url('inscriptionForm'))->with('errors', $errors);
        } else {
            session()->set('user', [
                'id' => $newUser['id'],
                'email' => $newUser['email'],
                'role' => $newUser['role'],
                'montant' => $newUser['montant'],
            ]);
            redirect()->to(site_url('inscriptionForm'))->with('success', 'Votre inscription a réussi.');
        }
    }
}
