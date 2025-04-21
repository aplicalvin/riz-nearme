<?php

namespace App\Controllers;

use App\Services\HotelDataService;

class Hotels extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Cari Hotels - NearMe',
            'hotels' => HotelDataService::getAllHotels(),
            'filter_options' => HotelDataService::getFilterOptions(),
            'message' => ''
        ];

        return view('hotel/v_hotel_listing', $data);
    }

    public function popular(): string
    {
        $data = [
            'title' => 'Popular Hotels - NearMe',
            'hotels' => HotelDataService::getFeaturedHotels(6), // Get 6 popular hotels
            'filter_options' => HotelDataService::getFilterOptions()
        ];

        return view('hotel/v_popular_hotels', $data);
    }

    public function detail($id)
    {
        $hotel = HotelDataService::getHotelById($id);
        
        if (!$hotel) {
            // Optional: Set a not found message if you want to redirect
            // return redirect()->to('/hotels')->with('message', 'Hotel not found');
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $hotel['name'] . ' - NearMe',
            'hotel' => $hotel,
            'similar_hotels' => HotelDataService::getHotelsByCity($hotel['city'], $id),
            'message' => session()->getFlashdata('message') ?? ''
        ];

        return view('hotel/v_hotel_detail', $data);
    }
}