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
            redirect()->back();
        }

        $modelUser->update($user['id'], ['roleId' => 2]);

        $user['roleId'] = 2;
        session()->set('user', $user);

        return redirect()->back();
    }
}
