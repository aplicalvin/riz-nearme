<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Ini adalah Title'
        ];
        return view('general/v_landing_pages.php');
    }

    public function landing(): string {
        return view('general/v_landing_pages');
    }
}
