<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        $session = session();

        $user = $session->get('user');

        if (!$user || !in_array($user['roleId'], $arguments ?? [])) {
            return redirect()->to(site_url('/index'));
        }
    }
}
