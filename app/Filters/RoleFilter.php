<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $requiredRole = $arguments[0] ?? null;
        $userRole = session()->get('userRole');

        if ($userRole !== $requiredRole) {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa
    }
}