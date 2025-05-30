<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class TestController extends BaseController
{   

    protected $usermodel; 
    protected $userId;
    protected $session;

    public function __construct() {
        // $this->var = $var;
        $this->usermodel = new UserModel();
        $this->session = session();
        $this->userId = $this->session->get('user_id');

    }
    public function index()
    {
        //
    }

    public function testUser() 
    {
        $user = $this->usermodel->find($this->userId);

        $session = $this->session;
        

        dd( $user['photo']);
        // dd( empty($user['photo']));
    }
}
