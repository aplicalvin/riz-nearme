<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $requiredRole = $arguments[0] ?? null;
        
        // Ambil role langsung dari session root
        $userRole = session()->get('role'); // Sesuai struktur Anda
        
        if (!$userRole || $userRole !== $requiredRole) {
            return redirect()->to('/404')->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa
    }
}