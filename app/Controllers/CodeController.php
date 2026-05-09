<?php

namespace App\Controllers;

use App\Models\Code;

class CodeController extends BaseController
{
    
    public function demanderCode()
    {
        $codePost = $this->request->getPost('code');
        $codeModel = new Code();

        $codeStr = $codeModel->where('lib', $codePost)->first();

        if ($codeStr) {
            $userId = session()->get('user')['id'];
            $codeModel->update($codeStr['id'] ?? $codeStr->id, ['userId' => $userId]);
            
            return redirect()->back()->with('CodeSuccess', 'Votre demande a été envoyé à l\'administrateur.');
        }

        return redirect()->back()->with('error', 'Code inexistant.');
    }
}
