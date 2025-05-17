<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HotelModel;
use App\Models\RoomTypeModel;
use App\Models\BookingModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class SuperController extends BaseController
{
    protected $superadmin_id;

    public function __construct() {
        $this->datahotel = new HotelModel();
        $this->datakamar = new RoomTypeModel();
        $this->datauser = new UserModel();
        $this->databooking = new BookingModel();
        $this->superadmin_id = session()->get('user_id'); 

    }
    public function index()
    {
        //
        $data = [
            'judul' => 'Dashboard keseluruhan',
            'stat' => [
                'jmlHotel' => $this->datahotel->countAll(),
                'jmluser' => $this->datauser->countUsersByRole('user'),
                'jmlhotel' => $this->datauser->countUsersByRole('hotel'),
                'jmlsuper' => $this->datauser->countUsersByRole('admin'),
            ]

        ];

        return view('super/v_dashboard', $data);
    }

    public function hotel() 
    {

    }
}
