<?php

namespace App\Controllers;

class BookingController extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Selamat Datang!'
        ];
        return view('auth/v_login.php');
    }

    public function signup(): string {
        return view('auth/v_signup');
    }

    public function forgotPassword(): string {
        return view('auth/v_forgot_password');
    }
}
