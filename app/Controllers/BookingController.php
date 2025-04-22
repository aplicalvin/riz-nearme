<?php

namespace App\Controllers;
use App\Models\BookingModel;


class BookingController extends BaseController
{
    // app/Controllers/Bookings.php
public function create($hotelId)
{
    $roomTypeModel = new \App\Models\RoomTypeModel();
    $roomTypes = $roomTypeModel->where('hotel_id', $hotelId)->findAll();

    return view('booking_form', [
        'roomTypes' => $roomTypes,
        'hotelId' => $hotelId
    ]);
}

public function store()
{
    $bookingModel = new \App\Models\BookingModel();
    
    $data = [
        'user_id' => session()->get('user_id'),
        'hotel_id' => $this->request->getPost('hotel_id'),
        'room_type_id' => $this->request->getPost('room_type_id'),
        'check_in_date' => $this->request->getPost('check_in'),
        'check_out_date' => $this->request->getPost('check_out'),
        'total_price' => $this->calculateTotalPrice(), // Buat method ini
        'status' => 'pending'
    ];

    if($bookingModel->insert($data)){
        return redirect()->to('/user/bookings')->with('success', 'Booking berhasil!');
    }
}
}
