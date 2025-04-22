<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Ini adalah Title'
        ];
        return view('general/v_landing_pages.php');
    }

    public function landing(): string {
        return view('general/v_landing_pages');
    }

    // app/Controllers/Users.php
    public function toggleFavorite($hotelId)
    {
        $favoriteModel = new \App\Models\FavoriteModel();
        $userId = session()->get('user_id');

        $existing = $favoriteModel->where([
            'user_id' => $userId,
            'hotel_id' => $hotelId
        ])->first();

        if($existing){
            $favoriteModel->delete($existing['id']);
        } else {
            $favoriteModel->insert([
                'user_id' => $userId,
                'hotel_id' => $hotelId
            ]);
        }

        return redirect()->back();
    }

        // app/Controllers/Users.php
    public function bookings()
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookings = $bookingModel->where('user_id', session()->get('user_id'))
                            ->join('hotels', 'hotels.id = bookings.hotel_id')
                            ->join('room_types', 'room_types.id = bookings.room_type_id')
                            ->select('bookings.*, hotels.name as hotel_name, room_types.name as room_type')
                            ->findAll();

        return view('user/bookings', ['bookings' => $bookings]);
    }
}
