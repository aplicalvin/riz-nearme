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
        helper(['form', 'url']);
    }

    // Tampilan Login
    public function index()
    {
        // Jika user sudah login, redirect ke home
        if(session()->get('logged_in')){
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function signup()
    {
        return view('auth/signup');
    }
    
    public function registerProcess()
    {
        $rules = [
            'full_name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];
    
        if(!$this->validate($rules)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $model = new UserModel();
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user' // Default role
        ];
    
        $model->insert($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login');
    }

public function loginProcess()
{
    $model = new UserModel();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if(!$user){
        return redirect()->back()->with('error', 'Email tidak ditemukan')->withInput();
    }

    if(!password_verify($password, $user['password'])){
        return redirect()->back()->with('error', 'Password salah')->withInput();
    }

    // Set session data
    $sessionData = [
        'user_id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'role' => $user['role'],
        'logged_in' => TRUE
    ];
    session()->set($sessionData);

    // Redirect berdasarkan role
    if($user['role'] == 'admin'){
        return redirect()->to('/admin/dashboard');
    }
    return redirect()->to('/');
}
    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}