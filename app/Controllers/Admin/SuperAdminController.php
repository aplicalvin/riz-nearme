<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CityModel;
use App\Models\CategoryModel;

class SuperAdminController extends BaseController
{
    protected $userModel;
    protected $cityModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cityModel = new CityModel();
        $this->categoryModel = new CategoryModel();
    }

    // Kelola admin hotel
    public function manageHotelAdmins()
    {
        $data = [
            'title' => 'Kelola Admin Hotel',
            'admins' => $this->userModel->where('role', 'hotel')->findAll(),
            'hotels' => $this->hotelModel->findAll()
        ];

        return view('admin/super/manage_admins', $data);
    }

    // Tambah admin baru
    public function createAdmin()
    {
        $rules = [
            'hotel_id' => 'required|numeric',
            'email' => 'required|valid_email|is_unique[users.email]',
            'full_name' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash('password123', PASSWORD_DEFAULT), // Password default
            'role' => 'hotel'
        ]);

        // Assign hotel ke admin
        $adminId = $this->userModel->getInsertID();
        $this->hotelModel->update($this->request->getPost('hotel_id'), ['admin_id' => $adminId]);

        return redirect()->back()->with('message', 'Admin berhasil ditambahkan');
    }

    // Kelola kota
    public function manageCities()
    {
        $data = [
            'title' => 'Kelola Kota',
            'cities' => $this->cityModel->findAll()
        ];

        return view('admin/super/manage_cities', $data);
    }
}