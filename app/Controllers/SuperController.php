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


    // CRUD USERS
    // Method untuk menampilkan daftar user biasa
    public function users()
    {
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort') ?? 'created_at';
        $order = $this->request->getGet('order') ?? 'DESC';
        
        $data = [
            'judul' => 'Manajemen User Biasa',
            'users' => $this->datauser->getFilteredUsers($search, $sort, $order)->paginate(10),
            'pager' => $this->datauser->pager,
            'search' => $search,
            'sort' => $sort,
            'order' => $order
        ];
        
        return view('super/v_users', $data);
    }

    // Method untuk menampilkan form tambah user
    public function usersCreate()
    {
        $data = [
            'judul' => 'Tambah User Baru'
        ];
        
        return view('super/v_users_form', $data);
    }

    // Method untuk menyimpan user baru
    public function usersStore()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|numeric',
            'password' => 'required|min_length[4]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $data['role'] = 'user'; // Set role sebagai user biasa
        
        // Handle file upload (foto profil)
        $photo = $this->request->getFile('photo');
        if ($photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/profiles', $newName);
            $data['photo'] = $newName;
        }

        if ($this->datauser->save($data)) {
            return redirect()->to('/super/users')->with('message', 'User berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->datauser->errors());
        }
    }

    // Method untuk menghapus user
    public function usersDelete($id)
    {
        $user = $this->datauser->find($id);
        
        if (!$user || $user['role'] != 'user') {
            return redirect()->to('/super/users')->with('error', 'User tidak ditemukan');
        }
        
        // Hapus foto profil jika ada
        if ($user['photo'] && file_exists(ROOTPATH . 'public/uploads/profiles/' . $user['photo'])) {
            unlink(ROOTPATH . 'public/uploads/profiles/' . $user['photo']);
        }
        
        if ($this->datauser->delete($id)) {
            return redirect()->to('/super/users')->with('message', 'User berhasil dihapus');
        } else {
            return redirect()->to('/super/users')->with('error', 'Gagal menghapus user');
        }
    }

    // Method untuk menampilkan form edit user
    public function usersEdit($id)
    {
        $user = $this->datauser->find($id);
        
        if (!$user || $user['role'] != 'user') {
            return redirect()->to('/super/users')->with('error', 'User tidak ditemukan');
        }
        
        $data = [
            'judul' => 'Edit User',
            'user' => $user
        ];
        
        return view('super/v_users_form', $data);
    }

    // Method untuk update user
    public function usersUpdate($id)
    {
        $user = $this->datauser->find($id);
        
        if (!$user || $user['role'] != 'user') {
            return redirect()->to('/super/users')->with('error', 'User tidak ditemukan');
        }
        
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username,id,'.$id.']',
            'email' => 'required|valid_email|is_unique[users.email,id,'.$id.']',
            'phone' => 'required|numeric',
            'password' => 'permit_empty|min_length[4]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        
        // Jika password kosong, hapus dari data
        if (empty($data['password'])) {
            unset($data['password']);
        }
        
        // Handle file upload (foto profil)
        $photo = $this->request->getFile('photo');
        if ($photo->isValid() && !$photo->hasMoved()) {
            // Hapus foto lama jika ada
            if ($user['photo'] && file_exists(ROOTPATH . 'public/uploads/profiles/' . $user['photo'])) {
                unlink(ROOTPATH . 'public/uploads/profiles/' . $user['photo']);
            }
            
            $newName = $photo->getRandomName();
            $photo->move(ROOTPATH . 'public/uploads/profiles', $newName);
            $data['photo'] = $newName;
        }

        if ($this->datauser->update($id, $data)) {
            return redirect()->to('/super/users')->with('message', 'User berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->datauser->errors());
        }
    }

    public function usersExport()
    {
        $users = $this->datauser->where('role', 'user')->findAll();
        
        $filename = 'users_export_' . date('Ymd_His') . '.csv';
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv;");
        
        $file = fopen('php://output', 'w');
        
        // Header
        fputcsv($file, ['No', 'Nama Lengkap', 'Username', 'Email', 'No. Telepon', 'Tanggal Daftar']);
        
        // Data
        $no = 1;
        foreach ($users as $user) {
            fputcsv($file, [
                $no++,
                $user['full_name'],
                $user['username'],
                $user['email'],
                $user['phone'],
                date('d/m/Y H:i', strtotime($user['created_at']))
            ]);
        }
        
        fclose($file);
        exit;
    }


    // SuperController.php
    public function usersResetPassword($id)
    {
        $user = $this->datauser->find($id);
        
        if (!$user || $user['role'] != 'user') {
            return redirect()->to('/super/users')->with('error', 'User tidak ditemukan');
        }
        
        if ($this->datauser->resetPassword($id)) {
            return redirect()->to('/super/users')->with('message', 'Password user berhasil direset ke default');
        } else {
            return redirect()->to('/super/users')->with('error', 'Gagal mereset password');
        }
    }
}