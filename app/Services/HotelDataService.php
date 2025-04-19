<?php

namespace App\Services;

class HotelDataService
{
    private static $hotels = [
        [
            'id' => 101,
            'name' => 'Louise Kiene Pemuda',
            'city' => 'Semarang',
            'province' => 'Central Java',
            'stars' => 5,
            'rating' => 4.3,
            'review_count' => 50,
            'price_range' => 'Rp 800.000 - Rp 1.500.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Swimming Pool', 'Restaurant', 'Spa'],
            'description' => 'Luxury hotel in the heart of Semarang with colonial architecture.'
        ],
        [
            'id' => 102,
            'name' => 'The Jayakarta Suites',
            'city' => 'Bandung',
            'province' => 'West Java',
            'stars' => 4,
            'rating' => 4.1,
            'review_count' => 42,
            'price_range' => 'Rp 600.000 - Rp 1.200.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Spa', 'Fitness Center'],
            'description' => 'Modern suites with excellent city views.'
        ],
        [
            'id' => 103,
            'name' => 'Grand Mercure Malang',
            'city' => 'Malang',
            'province' => 'East Java',
            'stars' => 5,
            'rating' => 4.7,
            'review_count' => 68,
            'price_range' => 'Rp 900.000 - Rp 2.000.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Swimming Pool', 'Business Center'],
            'description' => 'Elegant hotel with modern amenities in downtown Malang.'
        ],
        [
            'id' => 104,
            'name' => 'Aston Inn Surabaya',
            'city' => 'Surabaya',
            'province' => 'East Java',
            'stars' => 3,
            'rating' => 3.9,
            'review_count' => 35,
            'price_range' => 'Rp 500.000 - Rp 900.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Restaurant', 'Parking'],
            'description' => 'Comfortable budget accommodation in Surabaya business district.'
        ],
        [
            'id' => 105,
            'name' => 'Plataran Heritage Jakarta',
            'city' => 'Jakarta',
            'province' => 'Jakarta',
            'stars' => 5,
            'rating' => 4.8,
            'review_count' => 72,
            'price_range' => 'Rp 1.200.000 - Rp 3.000.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Swimming Pool', 'Spa', 'Concierge'],
            'description' => 'Luxurious heritage hotel in central Jakarta.'
        ],
        [
            'id' => 106,
            'name' => 'The Alana Yogyakarta',
            'city' => 'Yogyakarta',
            'province' => 'Yogyakarta',
            'stars' => 4,
            'rating' => 4.2,
            'review_count' => 55,
            'price_range' => 'Rp 700.000 - Rp 1.400.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Cultural Tours', 'Restaurant'],
            'description' => 'Boutique hotel with Javanese cultural experiences.'
        ],
        [
            'id' => 107,
            'name' => 'Harris Hotel Batam',
            'city' => 'Batam',
            'province' => 'Riau Islands',
            'stars' => 3,
            'rating' => 3.8,
            'review_count' => 30,
            'price_range' => 'Rp 550.000 - Rp 950.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Swimming Pool', 'Shuttle Service'],
            'description' => 'Convenient hotel near Batam ferry terminal.'
        ],
        [
            'id' => 108,
            'name' => 'Padma Resort Ubud',
            'city' => 'Bali',
            'province' => 'Bali',
            'stars' => 5,
            'rating' => 4.9,
            'review_count' => 85,
            'price_range' => 'Rp 1.500.000 - Rp 4.000.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Infinity Pool', 'Spa', 'Yoga Classes'],
            'description' => 'Luxury resort with stunning jungle views in Ubud.'
        ],
        [
            'id' => 109,
            'name' => 'Favehotel Pekanbaru',
            'city' => 'Pekanbaru',
            'province' => 'Riau',
            'stars' => 2,
            'rating' => 3.5,
            'review_count' => 25,
            'price_range' => 'Rp 400.000 - Rp 700.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', '24-Hour Front Desk'],
            'description' => 'Basic accommodation for business travelers.'
        ],
        [
            'id' => 110,
            'name' => 'Swiss-Belinn Medan',
            'city' => 'Medan',
            'province' => 'North Sumatra',
            'stars' => 4,
            'rating' => 4.0,
            'review_count' => 48,
            'price_range' => 'Rp 650.000 - Rp 1.300.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Restaurant', 'Meeting Rooms'],
            'description' => 'Modern hotel in Medan city center.'
        ],
        [
            'id' => 111,
            'name' => 'Amaris Hotel Bogor',
            'city' => 'Bogor',
            'province' => 'West Java',
            'stars' => 3,
            'rating' => 3.7,
            'review_count' => 38,
            'price_range' => 'Rp 450.000 - Rp 800.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Breakfast Included'],
            'description' => 'Affordable hotel near Bogor Botanical Gardens.'
        ],
        [
            'id' => 112,
            'name' => 'Santika Premiere Beach Resort',
            'city' => 'Banyuwangi',
            'province' => 'East Java',
            'stars' => 4,
            'rating' => 4.3,
            'review_count' => 52,
            'price_range' => 'Rp 750.000 - Rp 1.600.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Beach Access', 'Swimming Pool', 'Restaurant'],
            'description' => 'Beachfront resort near Ijen Crater.'
        ],
        [
            'id' => 113,
            'name' => 'Ibis Styles Makassar',
            'city' => 'Makassar',
            'province' => 'South Sulawesi',
            'stars' => 3,
            'rating' => 3.9,
            'review_count' => 41,
            'price_range' => 'Rp 500.000 - Rp 900.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Rooftop Bar', 'City Views'],
            'description' => 'Stylish budget hotel in downtown Makassar.'
        ],
        [
            'id' => 114,
            'name' => 'Grand Dafam Rohan',
            'city' => 'Palembang',
            'province' => 'South Sumatra',
            'stars' => 4,
            'rating' => 4.1,
            'review_count' => 47,
            'price_range' => 'Rp 700.000 - Rp 1.500.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Swimming Pool', 'Restaurant'],
            'description' => 'Modern hotel near Palembang city center.'
        ],
        [
            'id' => 115,
            'name' => 'Quest Hotel Denpasar',
            'city' => 'Denpasar',
            'province' => 'Bali',
            'stars' => 3,
            'rating' => 3.8,
            'review_count' => 39,
            'price_range' => 'Rp 600.000 - Rp 1.100.000',
            'image' => 'https://picsum.photos/600/400',
            'facilities' => ['Free WiFi', 'Shuttle Service', 'Tour Desk'],
            'description' => 'Convenient base for exploring Bali.'
        ]
    ];

    public static function getAllHotels(): array
    {
        return self::$hotels;
    }

    public static function getHotelById(int $id): ?array
    {
        foreach (self::$hotels as $hotel) {
            if ($hotel['id'] == $id) {
                return $hotel;
            }
        }
        return null;
    }

    public static function getFeaturedHotels(int $limit = 3): array
    {
        $hotels = self::$hotels;
        usort($hotels, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        return array_slice($hotels, 0, $limit);
    }

    public static function getHotelsByCity(string $city, int $excludeId = null): array
    {
        return array_filter(self::$hotels, function($hotel) use ($city, $excludeId) {
            return $hotel['city'] === $city && $hotel['id'] !== $excludeId;
        });
    }

    public static function getFilterOptions(): array
    {
        $cities = array_unique(array_column(self::$hotels, 'city'));
        sort($cities);

        return [
            'cities' => $cities,
            'star_ratings' => [5, 4, 3, 2],
            'price_ranges' => [
                '0-500000' => 'Under Rp 500.000',
                '500000-1000000' => 'Rp 500.000 - 1.000.000',
                '1000000-2000000' => 'Rp 1.000.000 - 2.000.000',
                '2000000-' => 'Over Rp 2.000.000'
            ]
        ];
    }
}