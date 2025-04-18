<?php

namespace App\Controllers;

use App\Services\HotelDataService;

class Hotels extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Browse Hotels - NearMe',
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

    public function detail($id): string
    {
        $hotel = HotelDataService::getHotelById($id);
        
        if (!$hotel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $hotel['name'] . ' - NearMe',
            'hotel' => $hotel,
            'similar_hotels' => HotelDataService::getHotelsByCity($hotel['city'], $id),
            // 'message' => '' // Initialize empty message

        ];

        return view('hotel/v_hotel_detail', $data);
    }
}