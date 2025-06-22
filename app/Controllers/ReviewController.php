<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class ReviewController extends BaseController
{
    public function create()
    {
        $reviewModel = new ReviewModel();

        $data = [
            'booking_id' => $this->request->getPost('booking_id'),
            'user_id'    => session()->get('user_id'),
            'hotel_id'   => $this->request->getPost('hotel_id'),
            'rating'     => $this->request->getPost('rating'),
            'comment'    => $this->request->getPost('comment')
        ];

        if ($reviewModel->insert($data)) {
            return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengirim ulasan.');
        }
    }

    public function update($id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel->find($id);

        if (!$review || $review['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('failed', 'Aksi tidak diizinkan.');
        }

        $data = [
            'rating'  => $this->request->getPost('rating'),
            'comment' => $this->request->getPost('comment')
        ];

        if ($reviewModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Ulasan berhasil diperbarui!');
        } else {
            return redirect()->back()->with('failed', 'Gagal memperbarui ulasan.');
        }
    }

    public function delete($id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel->find($id);

        if (!$review || $review['user_id'] != session()->get('user_id')) {
            return redirect()->back()->with('failed', 'Aksi tidak diizinkan.');
        }

        if ($reviewModel->delete($id)) {
            return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus ulasan.');
        }
    }
}