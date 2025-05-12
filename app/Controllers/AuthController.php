<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url', 'session']);
    }

    // Login View
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->to($this->getDashboardRoute());
        }
        return view('auth/login');
    }

    // Signup View
    public function signup()
    {
        if (session('logged_in')) {
            return redirect()->to($this->getDashboardRoute());
        }
        return view('auth/signup');
    }
    
    // Registration Process
    public function registerProcess()
    {
        if (!$this->validate($this->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $userId = $this->userModel->insert($this->getUserData());
            
            // Auto-login after registration
            $this->setUserSession($this->userModel->find($userId));
            
            return redirect()->to($this->getDashboardRoute())
                ->with('success', 'Registrasi berhasil! Selamat datang '.$this->request->getPost('full_name'));
                
        } catch (\Exception $e) {
            log_message('error', 'Registration Error: '.$e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    // Login Process
    public function loginProcess()
    {
        $credentials = $this->request->getPost(['email', 'password']);
        $user = $this->userModel->where('email', $credentials['email'])->first();

        if (!$user || !password_verify($credentials['password'], $user['password'])) {
            log_message('info', 'Failed login attempt for email: '.$credentials['email']);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah');
        }

        $this->setUserSession($user);
        
        log_message('info', 'User logged in: '.$user['email']);
        return redirect()->to($this->getDashboardRoute($user['role']))
            ->with('success', 'Selamat datang kembali, '.$user['full_name']);
    }

    // Logout
    public function logout()
    {
        $username = session('username');
        session()->destroy();
        
        log_message('info', 'User logged out: '.$username);
        return redirect()->to('/login')
            ->with('success', 'Anda telah berhasil logout');
    }

    // PRIVATE HELPER METHODS

    private function getValidationRules()
    {
        return [
            'full_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'phone' => [
                'label' => 'Nomor Telepon',
                'rules' => 'permit_empty|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'numeric' => 'Hanya boleh berisi angka'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[50]|strong_password',
                'errors' => [
                    'strong_password' => 'Password harus mengandung huruf besar, kecil, angka, dan simbol'
                ]
            ],
            'pass_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]'
            ]
        ];
    }

    private function getUserData()
    {
        return [
            'full_name' => $this->request->getPost('full_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
            'photo' => 'default.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ];
    }

    private function setUserSession($user)
    {
        $sessionData = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'logged_in' => true,
            'last_activity' => time()
        ];
        session()->set($sessionData);
    }

    private function getDashboardRoute($role = null)
    {
        $role = $role ?? session('role');
        
        switch ($role) {
            case 'admin':
                return '/super/dashboard';
            case 'hotel':
                return '/admin/dashboard';
            default:
                return '/';
        }
    }
}