<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new User();

        $users = $userModel->where('roleId != 1')->findAll();

        $gold =  $userModel->where('roleId',2)->findAll();

        return view('admin/user', [
            'users' => $users,
            'gold' => $gold
        ]);
    }
}
