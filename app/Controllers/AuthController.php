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

        $newUser = [
            'email' => $this->request->getPost('email'),
            'mdp' => password_hash($this->request->getPost('mdp'), PASSWORD_DEFAULT),
            'roleId' => $roleUser['id'] ?? 3,
            'montant' => 0,
        ];

        if (!$modelUser->insert($newUser)) {

            return redirect()
                ->back()
                ->with('errors', $modelUser->errors())
                ->withInput();
        }

        return redirect()
            ->to(site_url('/'))
            ->with('success', 'Votre inscription a réussi.');
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new User();
        

        $email = $this->request->getPost('email');
        $mdp   = $this->request->getPost('mdp');

        $user = $model->where('email', $email)->first();

        if (!$user || !password_verify($mdp, $user['mdp'])) {

            return redirect()
                ->back()
                ->with('error', 'Email ou mot de passe incorrect')
                ->withInput();
        }

        session()->set('user', [
            'id'      => $user['id'],
            'email'   => $user['email'],
            'roleId'  => $user['roleId'],
            'montant' => $user['montant'],
        ]);

        return redirect()->to(site_url('/admin'));
    }

    public function logout() {
        session_destroy();
        return redirect()->to(site_url('/login'));
    }
}
