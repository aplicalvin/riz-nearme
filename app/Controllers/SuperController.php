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
        helper('text'); // Tambahkan ini
        $this->datahotel = new HotelModel();
        $this->datakamar = new RoomTypeModel();
        $this->datauser = new UserModel();
        $this->cityModel = new \App\Models\CityModel();

        $this->databooking = new BookingModel();
        $this->superadmin_id = session()->get('user_id'); 
    }

    public function index()
    {
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

    // Menampilkan daftar hotel
    public function hotel() 
    {
        $data = [
            'judul' => 'Manajemen Hotel',
            'hotels' => $this->datahotel->getAllHotelsWithCities()
        ];
        
        return view('super/v_hotel', $data);
    }

    // Menampilkan form tambah hotel
    public function hotelCreate()
    {
        $userModel = new UserModel();
        
        $data = [
            'judul' => 'Tambah Hotel Baru',
            'admin_options' => $userModel->where('role', 'hotel')->findAll()
        ];
        
        return view('super/v_hotel_form', $data);
    }

    // Menyimpan data hotel baru
    public function hotelStore()
    {
        $validation = $this->datahotel->validateHotel($this->request->getPost());
        
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', $validation);
        }

        $data = $this->request->getPost();
        
        // Handle file upload (cover photo)
        $coverPhoto = $this->request->getFile('cover_photo');
        if ($coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            $newName = $coverPhoto->getRandomName();
            $coverPhoto->move(ROOTPATH . 'public/uploads/hotels', $newName);
            $data['cover_photo'] = $newName;
        }

        if ($this->datahotel->save($data)) {
            return redirect()->to('/super/hotel')->with('message', 'Hotel berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->datahotel->errors());
        }
    }

    // Menampilkan form edit hotel
    public function hotelEdit($id)
    {
        $userModel = new UserModel();
        $hotel = $this->datahotel->getHotelDetails($id);
        
        if (!$hotel) {
            return redirect()->to('/super/hotel')->with('error', 'Hotel tidak ditemukan');
        }
        
        $data = [
            'judul' => 'Edit Hotel',
            'hotel' => $hotel,
            'admin_options' => $userModel->where('role', 'hotel')->findAll()
        ];
        
        return view('super/v_hotel_form', $data);
    }

    // Mengupdate data hotel
    public function hotelUpdate($id)
    {
        $validation = $this->datahotel->validateHotel($this->request->getPost(), true);
        
        if ($validation !== true) {
            return redirect()->back()->withInput()->with('errors', $validation);
        }

        $data = $this->request->getPost();
        
        // Handle file upload (cover photo)
        $coverPhoto = $this->request->getFile('cover_photo');
        if ($coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            // Hapus foto lama jika ada
            $oldPhoto = $this->datahotel->find($id)->cover_photo;
            if ($oldPhoto && file_exists(ROOTPATH . 'public/uploads/hotels/' . $oldPhoto)) {
                unlink(ROOTPATH . 'public/uploads/hotels/' . $oldPhoto);
            }
            
            $newName = $coverPhoto->getRandomName();
            $coverPhoto->move(ROOTPATH . 'public/uploads/hotels', $newName);
            $data['cover_photo'] = $newName;
        }

        if ($this->datahotel->update($id, $data)) {
            return redirect()->to('/super/hotel')->with('message', 'Hotel berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->datahotel->errors());
        }
    }

    // Menghapus hotel
// SuperController.php

    public function hotelDelete($id)
    {
        if ($this->datahotel->deleteHotelWithDependencies($id)) {
            return redirect()->to('/super/hotel')->with('message', 'Hotel dan semua data terkait berhasil dihapus');
        } else {
            return redirect()->to('/super/hotel')->with('error', 'Gagal menghapus hotel');
        }
    }

    // SuperController.php
    public function createHotel()
    {
        return view('super/v_create_hotel_step1');
    }

    public function storeHotelAdmin()
    {
        $userModel = new UserModel();
        $result = $userModel->createHotelAdmin($this->request->getPost());
        
        if (!$result['success']) {
            return redirect()->back()->withInput()->with('errors', $result['errors']);
        }
        
        // Simpan user_id ke session untuk step berikutnya
        session()->set('temp_hotel_admin_id', $result['user_id']);
        
        return redirect()->to('/super/hotel/create-step2');
    }

    // Di SuperController.php
    public function createHotelStep2()
    {
        $admin_id = session()->get('temp_hotel_admin_id');
        
        if (!$admin_id) {
            return redirect()->to('/super/hotel/create')->with('error', 'Silakan buat admin hotel terlebih dahulu');
        }
        
        
        $data = [
            'admin_id' => $admin_id,
            'admin_name' => (new UserModel())->find($admin_id)['full_name'],
            'cities' => $this->cityModel->findAll() // Ambil semua kota
        ];
        
        return view('super/v_create_hotel_step2', $data);
    }

    public function storeHotel()
    {
        $admin_id = session()->get('temp_hotel_admin_id');
        
        if (!$admin_id) {
            return redirect()->to('/super/hotel/create')->with('error', 'Silakan buat admin hotel terlebih dahulu');
        }
        
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'city_id' => 'required|numeric|is_not_unique[cities.id]', // Validasi city_id
            'address' => 'required',
            'description' => 'required|min_length[10]',
            'star_rating' => 'permit_empty|numeric|less_than_equal_to[5]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = $this->request->getPost();
        $data['admin_id'] = $admin_id;
        
        // Handle file upload
        $coverPhoto = $this->request->getFile('cover_photo');
        if ($coverPhoto->isValid() && !$coverPhoto->hasMoved()) {
            $newName = $coverPhoto->getRandomName();
            $coverPhoto->move(ROOTPATH . 'public/uploads/hotels', $newName);
            $data['cover_photo'] = $newName;
        }
        
        if ($this->datahotel->save($data)) {
            session()->remove('temp_hotel_admin_id');
            return redirect()->to('/super/hotel')->with('message', 'Hotel berhasil dibuat');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->datahotel->errors());
        }
    }
}