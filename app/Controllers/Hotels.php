<?php

namespace App\Controllers;

use App\Models\FavoriteModel;
use App\Models\HotelModel;
use App\Models\CityModel; // You'll need to create this
use App\Models\ReviewModel;
use App\Models\RoomTypeModel;
use App\Models\FacilityModel;
use App\Models\UserModel;

class Hotels extends BaseController
{
    protected $hotelModel;
    protected $cityModel;
    protected $favoriteModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->cityModel = new CityModel(); // Initialize CityModel
        $this->userModel = new UserModel();
        $this->favoriteModel = new FavoriteModel();
    }

    public function index(): string
    {
        // Ambil filter dari GET parameters
        $request = service('request');
        $filters = [
            'city' => $request->getGet('city'),
            'stars' => $request->getGet('stars'),
            // 'price_range' => $request->getGet('price_range')
        ];
        
        // Konfigurasi pagination
        $perPage = 12; // Jumlah item per halaman
        $currentPage = $request->getGet('page') ?? 1; // Ambil current page dari URL
        
        // Dapatkan hotel paginated berdasarkan filter
        $hotelData = $this->hotelModel->getPaginatedHotels($filters, $perPage, $currentPage);
        
        // Siapkan pesan jika filter aktif
        $message = '';
        if (!empty(array_filter($filters))) {
            $activeFilters = array_filter($filters);
            $filterMessages = [];
            
            if (!empty($filters['city'])) {
                $filterMessages[] = 'Kota: ' . $filters['city'];
            }
            if (!empty($filters['stars'])) {
                $filterMessages[] = 'Bintang: ' . str_repeat('★', $filters['stars']);
            }
            
            $message = 'Menampilkan hasil filter: ' . implode(', ', $filterMessages);
        }
        
        // Hitung total hotel (untuk info pagination)
        $totalHotels = $this->hotelModel->countFilteredHotels($filters);
        
        $data = [
            'title' => 'Cari Hotels - NearMe',
            'hotels' => $hotelData['hotels'],
            'pager' => $hotelData['pager'],
            'filter_options' => $this->hotelModel->getFilterOptions(),
            'message' => $message,
            'total_results' => $totalHotels,
            'current_page' => $currentPage,
            'per_page' => $perPage
        ];

        return view('hotel/v_hotel_listing', $data);
    }

    public function popular(): string
    {
        // Get popular hotels (highest rated first)
        $hotels = $this->hotelModel->select('hotels.*, cities.name as city_name')
                                  ->join('cities', 'cities.id = hotels.city_id')
                                  ->orderBy('star_rating', 'DESC')
                                  ->limit(6)
                                  ->findAll();

        $data = [
            'title' => 'Popular Hotels - NearMe',
            'hotels' => $hotels,
            'filter_options' => $this->getFilterOptions($hotels)
        ];

        return view('hotel/v_popular_hotels', $data);
    }

    // ======== DETAIL ========
    public function detail($id)
    {
        helper('number'); // Tambahkan ini


        $galleryModel = new \App\Models\HotelGalleryModel();
        $roomGalleryModel = new \App\Models\RoomGalleryModel();
        $galleryPhotos = $galleryModel->getPhotosByHotel($id);
        $roomGalleryPhotos = $roomGalleryModel->getPhotosByRoom($id);
        // $roomGalleryPhotos = $roomGalleryModel->where('room_type_id', $roomId)->findAll();
        $hotelModel = new HotelModel();
        $reviewModel = new ReviewModel();
        $roomTypeModel = new RoomTypeModel();
        $facilityModel = new FacilityModel();
        $cityModel = new CityModel();
    
        // Data utama hotel
        $hotel = $hotelModel->select('hotels.*, cities.name as city_name')
                           ->join('cities', 'cities.id = hotels.city_id')
                           ->find($id);
    
        if (!$hotel) {
            throw new PageNotFoundException('Hotel tidak ditemukan');
        }
    
        // Data rating dan review
        $reviews = $reviewModel->select('reviews.*, users.full_name, users.photo')
                              ->join('users', 'users.id = reviews.user_id')
                              ->where('hotel_id', $id)
                              ->orderBy('created_at', 'DESC')
                              ->findAll();
    
        $ratingSummary = $reviewModel->select('rating, COUNT(*) as count')
                                    ->where('hotel_id', $id)
                                    ->groupBy('rating')
                                    ->findAll();
    
        // Hitung persentase rating
        $totalReviews = array_sum(array_column($ratingSummary, 'count'));
        $ratingPercent = [];
        foreach ([5,4,3,2,1] as $stars) {
            $found = false;
            foreach ($ratingSummary as $rating) {
                if ($rating['rating'] == $stars) {
                    $ratingPercent["rating_$stars"] = round(($rating['count'] / $totalReviews) * 100);
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $ratingPercent["rating_$stars"] = 0;
            }
        }
    
        // Data fasilitas
        $facilities = $facilityModel->where('hotel_id', $id)->findAll();
    
        // Data kamar
        // $roomTypes = $roomTypeModel->where('hotel_id', $id)->findAll();
        $roomTypes = $roomTypeModel->where('hotel_id', $id)->findAll();
        foreach ($roomTypes as &$room) {
            $room['galleries'] = $roomGalleryModel->where('room_type_id', $room['id'])->findAll();
        }

    
        // Hotel serupa (dari kota yang sama)
        $similarHotels = $hotelModel->select('hotels.*, cities.name as city_name')
                                   ->join('cities', 'cities.id = hotels.city_id')
                                   ->where('hotels.id !=', $id)
                                   ->where('hotels.city_id', $hotel['city_id'])
                                   ->orderBy('RAND()')
                                   ->findAll(3);

        $session = session();
        $userId = $session->get('user_id');

    
        $data = [
            'title' => $hotel['name'] . ' - NearMe',
            'hotel' => $hotel,
            'reviews' => $reviews,
            'room_types' => $roomTypes,
            'facilities' => $facilities,
            'similar_hotels' => $similarHotels,
            'gallery_photos' => $galleryPhotos,
            'total_reviews' => $totalReviews,
            'avg_rating' => $totalReviews > 0 ? $reviewModel->where('hotel_id', $id)->selectAvg('rating')->first()['rating'] : 0,
            'rating_percent' => $ratingPercent,
            'user_role' => $this->userModel->getUserRole($userId),
            'userId' => $userId,
            'isFavorite' => $this->favoriteModel->checkFavorite($userId, $hotel['id'])
        ];
        
        // dd($data);
        return view('hotel/v_hotel_detail', $data);
    }

    // ======== SEARCH ========
    public function search()
    {
        $cityId = $this->request->getGet('city_id');
        $hotelModel = new \App\Models\HotelModel();
        $hotels = $hotelModel->where('city_id', $cityId)->findAll();

        return view('hotel_list', ['hotels' => $hotels]);
    }


    /**
     * Format raw database data to match your view expectations
     */
    protected function formatHotelData(array $hotel): array
    {
        return [
            'id' => $hotel['id'],
            'name' => $hotel['name'],
            'city' => $hotel['city_name'], // From joined table
            'stars' => $hotel['star_rating'],
            'rating' => $hotel['rating'] ?? 4.0, // Add these fields to your DB if needed
            'review_count' => $hotel['review_count'] ?? 0,
            // 'price_range' => $this->generatePriceRange($hotel['star_rating']),
            'image' => $hotel['cover_photo'] ?? 'https://source.unsplash.com/random/600x400/?hotel',
            'facilities' => $this->getHotelFacilities($hotel['id']), // You'll need to implement this
            'description' => $hotel['description']
        ];
    }

    /**
     * Generate filter options based on available hotels
     */
    protected function getFilterOptions(array $hotels): array
    {
        $cities = array_unique(array_column($hotels, 'city_name'));
        sort($cities);

        return [
            'cities' => $cities,
            'star_ratings' => [5, 4, 3, 2],
        ];
    }

    /**
     * Generate price range based on star rating
     */
    protected function generatePriceRange(int $stars): string
    {
        $ranges = [
            5 => 'Rp 1.000.000 - Rp 3.000.000',
            4 => 'Rp 600.000 - Rp 1.500.000',
            3 => 'Rp 400.000 - Rp 900.000',
            2 => 'Rp 200.000 - Rp 500.000'
        ];
        
        return $ranges[$stars] ?? 'Rp 500.000 - Rp 1.000.000';
    }

    /**
     * Get facilities for a hotel (you'll need a facilities table)
     */
    protected function getHotelFacilities(int $hotelId): array
    {
        // Implement your facility logic here
        // Example: return $this->facilityModel->where('hotel_id', $hotelId)->findAll();
        return ['Free WiFi', 'Swimming Pool', 'Restaurant']; // Default for now
    }

    // Di dalam HotelController.php
    public function book($hotelId, $roomTypeId = null)
    {
        // Redirect ke BookingController
        return redirect()->to('/booking/new/'.$hotelId.'/'.$roomTypeId);
    }
}