<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuperController extends BaseController
{
    public function index()
    {
        //

        return view('super/v_dashboard');
    }
}
