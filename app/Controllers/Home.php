<?php

namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\CityModel;
use App\Models\ReviewModel;

class Home extends BaseController
{
    protected $hotelModel;
    protected $cityModel;
    protected $reviewModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->cityModel = new CityModel();
        $this->reviewModel = new ReviewModel();
    }

    public function index(): string
    {
        // $hotels = $this->getPopularHotels(6)->hotelModel->getHotelsWithCities(); // Pastikan getPopularHotels mengembalikan objek yang benar
    
        $data = [
            'title' => 'NearMe - Find Your Perfect Stay',
            'meta_description' => 'Book the best hotels in Indonesia with NearMe',
            'featured_hotels' => $this->getFeaturedHotels(3),
            'hotels' => $this->getPopularHotels(6),
            'popular_destinations' => $this->getPopularDestinations(),
            'message' => ''
        ];
    
        return view('general/v_landing_pages', $data);
    }
    
    private function getPopularDestinations(): array
    {
        $cities = $this->cityModel->select('cities.*, COUNT(hotels.id) as hotel_count')
                                 ->join('hotels', 'hotels.city_id = cities.id', 'left')
                                 ->groupBy('cities.id')
                                 ->orderBy('hotel_count', 'DESC')
                                 ->findAll(6);

        return array_map(function($city) {
            return [
                'name' => $city['name'],
                'image' => 'https://source.unsplash.com/random/300x200/?' . urlencode($city['name']),
                'hotel_count' => $city['hotel_count']
            ];
        }, $cities);
    }

    private function getPopularHotels(int $limit = 6): array
    {
        $hotels = $this->hotelModel->select('hotels.*, AVG(reviews.rating) as avg_rating, COUNT(reviews.id) as review_count')
                                  ->join('reviews', 'reviews.hotel_id = hotels.id', 'left')
                                  ->groupBy('hotels.id')
                                  ->orderBy('avg_rating', 'DESC')
                                  ->orderBy('review_count', 'DESC')
                                  ->findAll($limit);

        return array_map(function($hotel) {
            $hotel['rating'] = (float) $hotel['avg_rating'] ?? 0;
            $hotel['review_count'] = (int) $hotel['review_count'] ?? 0;
            return $hotel;
        }, $hotels);
    }

    private function getFeaturedHotels(int $limit = 3): array
    {
        return $this->hotelModel->where('star_rating >=', 4)
                               ->orderBy('star_rating', 'DESC')
                               ->findAll($limit);
    }
}