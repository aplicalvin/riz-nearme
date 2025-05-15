<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\FavoriteModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $bookingModel;
    protected $favoriteModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->favoriteModel = new FavoriteModel();
        
        // Pastikan user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    // Halaman Profil
    public function profile()
    {
        $data = [
            'title' => 'Profil Saya',
            'judul' => 'Profil Saya - ',
            'user' => $this->userModel->find(session()->get('user_id')),
            'activeTab' => 'profile'
        ];
        return view('user/profile_content', $data);
    }

    // Form Edit Profil
    public function editProfile()
    {
        $data = [
            'title' => 'Edit Profil',
            'user' => $this->userModel->find(session()->get('user_id')),
            'activeTab' => 'profile'
        ];
        return view('user/edit_profile', $data);
    }

    // Proses Update Profil
    public function updateProfile()
    {
        $userId = session()->get('user_id');
        $rules = [
            'full_name' => 'required|min_length[3]',
            'phone' => 'permit_empty|numeric|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'phone' => $this->request->getPost('phone')
        ];

        $this->userModel->update($userId, $data);
        return redirect()->to('/user/profile')->with('success', 'Profil berhasil diperbarui');
    }

    // History Pemesanan
    public function bookings()
    {
        $bookings = $this->bookingModel->getUserBookings(session()->get('user_id'));

        $data = [
            'title' => 'History Pemesanan',
            'user' => $this->userModel->find(session()->get('user_id')), // <- Wajib ada
            'bookings' => $this->bookingModel->getUserBookings(session()->get('user_id')),
            'activeTab' => 'bookings'
        ];
        return view('user/bookings', $data);
    }

    // Hotel Favorit
    public function favorites()
    {
        $favorites = $this->favoriteModel->getUserFavorites(session()->get('user_id'));

        $data = [
            'title' => 'Hotel Favorit',
            'user' => $this->userModel->find(session()->get('user_id')), // <- Tambah ini
            'favorites' => $this->favoriteModel->getUserFavorites(session()->get('user_id')),
            'activeTab' => 'favorites'
        ];
        return view('user/favorites', $data);
    }
}