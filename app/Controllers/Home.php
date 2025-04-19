<?php

namespace App\Controllers;

use App\Services\HotelDataService;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'NearMe - Find Your Perfect Stay',
            'meta_description' => 'Book the best hotels in Indonesia with NearMe',
            'featured_hotels' => HotelDataService::getFeaturedHotels(3),
            'hotels' => $this->getPopularHotels(6), // New method
            'popular_destinations' => $this->getPopularDestinations(),
            'message' => ''
        ];

        return view('general/v_landing_pages', $data);
    }

    /**
     * Get static data for popular destinations
     */
    private function getPopularDestinations(): array
    {
        // Get all unique cities from our centralized hotel data
        $cities = array_unique(array_column(HotelDataService::getAllHotels(), 'city'));
        
        // Create destination data
        $destinations = [];
        foreach ($cities as $city) {
            $destinations[] = [
                'name' => $city,
                'image' => 'https://source.unsplash.com/random/300x200/?' . urlencode($city),
                'hotel_count' => count(HotelDataService::getHotelsByCity($city))
            ];
            
            // Limit to 6 popular destinations
            if (count($destinations) >= 6) {
                break;
            }
        }

        return $destinations;
    }

    private function getPopularHotels(int $limit = 6): array
    {
        $hotels = HotelDataService::getAllHotels();
        
        // Calculate popularity score (weighted average)
        foreach ($hotels as &$hotel) {
            $hotel['popularity_score'] = ($hotel['rating'] * 0.7) + (log($hotel['review_count']) * 0.3);
        }
        
        // Sort by popularity score
        usort($hotels, function($a, $b) {
            return $b['popularity_score'] <=> $a['popularity_score'];
        });
        
        return array_slice($hotels, 0, $limit);
    }

    public function landing(): string 
    {
        return $this->index(); // Reuse the index method
    }
}