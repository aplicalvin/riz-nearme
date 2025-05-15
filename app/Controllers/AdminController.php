<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        //
        return view('admin/v_dashboard');
    }
    
    public function room()
    {
        //
        return view('admin/v_room');
    }
    
    public function booking()
    {
        //
        return view('admin/v_booking');
    }
    
    public function setting()
    {
        //
        return view('admin/v_setting');
    }
    
}
