<?php

namespace App\Controllers;

use App\Models\Code;
use App\Models\User;
use \Config\Database;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin/admin');
    }


    public function liste()
    {
        $codeModel = new Code();

        $data['codeDisponible'] = $codeModel->select('code.*')
            ->join('user', 'user.id = code.userId')
            ->join('role', 'role.id = user.roleId')
            ->where('code.status', false)
            ->where('role.lib', 'admin')
            ->findAll();

        $data['codeEnCoursDeValidation'] = $codeModel->select('code.*')
            ->join('user', 'user.id = code.userId')
            ->join('role', 'role.id = user.roleId')
            ->where('code.status', false)
            ->where('code.userId IS NOT NULL')
            ->where('role.lib !=', 'admin')
            ->orderBy('code.userId')
            ->findAll();

        $data['codeUtilise'] = $codeModel->select('code.*')
            ->join('user', 'user.id = code.userId')
            ->where('code.status', true)
            ->orderBy('code.userId')
            ->findAll();

        return view('admin/codes', $data);
    }

    public function validerCode($id = null)
    {
        $codeModel = new Code();
        $userModel = new User();

        $code = $codeModel->find($id);

        $error = '';
        if (! $code) {
            $error = 'Code inextistant.';
        } else {
            $db = Database::connect();
            $db->transStart();

            $codeModel->update($id, ['status' => true]);

            $userData = $userModel->find($code['userId']);

            $currentMontant = $userData['montant'];
            $codeMontant = $code['montant'];
            $userId = $code['userId'];

            $userModel->update($userId, ['montant' => $currentMontant + $codeMontant]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                $error = 'La validation du code a échoué.';
            }
        }

        if ($error !== '') {
            return redirect()->back()->with('error', $error);
        }

        return redirect()->back()->with('ValidationSuccess', 'Le code a été validé avec succès.');
    }

    public function refuserCode($id = null)
    {
        $codeModel = new Code();
        $code = $codeModel->find($id);

        if ($code) {
            $userId = session()->get('user')['id'];
            $codeModel->update($id, ['userId' => $userId]);

            return redirect()->back()->with('RefusSuccess', 'Le code a été refusé.');
        }

        return redirect()->back()->with('error', 'Code inexistant.');
    }
}
