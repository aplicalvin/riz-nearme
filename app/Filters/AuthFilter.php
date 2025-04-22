<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Cek sudah login belum
        if (!$session->get('logged_in')) {
            return redirect()->to('/');
        }
        
        // Cek role admin hotel
        $user = $session->get('user');
        if ($user['role'] !== 'hotel') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu action setelahnya
    }
}