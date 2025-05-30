<?php namespace App\Controllers;

use App\Models\FavoriteModel;

class FavoriteController extends BaseController
{
    protected $favoriteModel;

    public function __construct()
    {
        $this->favoriteModel = new FavoriteModel();
    }

    // Menambahkan hotel ke favorit
    public function addFavorite()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        $userId = $this->request->getPost('user_id');
        $hotelId = $this->request->getPost('hotel_id');

        // dd(empty($userId) || empty($hotelId));
        if (empty($userId) || empty($hotelId)) {
            return redirect()->back()->with('error', 'User ID dan Hotel ID diperlukan');
        }

        // Langsung proses tanpa validasi CSRF
        $result = $this->favoriteModel->addFavorites($userId, $hotelId);

        // dd($result);

        if ($result) {
            return redirect()->back()->with('success', 'Berhasil menambahkan ke favorit');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan ke favorit');
        }
    }

    // Menghapus hotel dari favorit
    public function deleteFavorite()
    {
        // Validasi request harus POST
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        $userId = $this->request->getPost('user_id');
        $hotelId = $this->request->getPost('hotel_id');

        // Validasi input
        if (empty($userId) || empty($hotelId)) {
            return redirect()->back()->with('error', 'User ID dan Hotel ID diperlukan');
        }

        // Hapus dari favorit
        $result = $this->favoriteModel->where('user_id', $userId)
                                     ->where('hotel_id', $hotelId)
                                     ->delete();

        if ($result) {
            return redirect()->back()->with('success', 'Berhasil menghapus dari favorit');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus dari favorit');
        }
    }
}