<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HotelModel;
use App\Models\RoomTypeModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    
    protected $hotel_id;
    protected $admin_id;
    
    public function __construct() {
        $this->datahotel = new HotelModel();
        $this->datakamar = new RoomTypeModel();
        $this->admin_id = session()->get('user_id'); 
        $this->hotel_id =  $this->datahotel->getHotelID($this->admin_id);
        
    }
    public function index()
    {
        
        // Validate if admin is logged in
        if (!$this->admin_id) {
            return redirect()->to('/login'); // Redirect to login if not authenticated
        }

        $data = [
            'judul' => 'Dashboard Admin',
            'hotels' => $this->datahotel->getHotelData($this->hotel_id) 
        ];

        // $admin_id->

        return view('admin/v_dashboard', $data);
    }
    
    public function room()
    {
        //
        $data = [
            'rooms' => $this->datakamar->getRoomData($this->hotel_id)
        ];

        dd($data);
        return view('admin/v_room', $data);
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
