<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewController extends BaseController
{
    public function index()
    {
        //
    }

    // app/Controllers/Reviews.php
    public function store($bookingId)
    {
        $reviewModel = new \App\Models\ReviewModel();

        $data = [
            'booking_id' => $bookingId,
            'user_id' => session()->get('user_id'),
            'hotel_id' => $this->request->getPost('hotel_id'),
            'rating' => $this->request->getPost('rating'),
            'comment' => $this->request->getPost('comment')
        ];

        $reviewModel->insert($data);
        return redirect()->back()->with('success', 'Review terkirim!');
    }
}
