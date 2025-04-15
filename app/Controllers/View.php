<?php

namespace App\Controllers;

class View extends BaseController
{
    public function index(): string
    {
        return view('general/v_landing_pages.php');
    }
}
