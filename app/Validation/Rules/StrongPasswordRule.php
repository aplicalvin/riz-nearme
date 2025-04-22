<?php

namespace App\Validation\Rules;

use CodeIgniter\Validation\Rules;

class StrongPasswordRule
{
    public function strong_password(string $str, string &$error = null): bool
    {
        // Minimal 8 karakter
        if (strlen($str) < 8) {
            $error = 'Password minimal 8 karakter';
            return false;
        }

        // Harus mengandung huruf besar
        if (!preg_match('/[A-Z]/', $str)) {
            $error = 'Password harus mengandung huruf besar';
            return false;
        }

        // Harus mengandung huruf kecil
        if (!preg_match('/[a-z]/', $str)) {
            $error = 'Password harus mengandung huruf kecil';
            return false;
        }

        // Harus mengandung angka
        if (!preg_match('/[0-9]/', $str)) {
            $error = 'Password harus mengandung angka';
            return false;
        }

        // Harus mengandung simbol
        if (!preg_match('/[^a-zA-Z0-9]/', $str)) {
            $error = 'Password harus mengandung simbol';
            return false;
        }

        return true;
    }
}