<?php namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\CityModel;

class Home extends BaseController
{
    protected $hotelModel;
    protected $cityModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->cityModel = new CityModel();
    }

    /**
     * Tampilan halaman utama
     */
    public function index()
    {
        $data = [
            'title' => 'Sewa Hotel Terbaik di Indonesia',
            'featuredHotels' => $this->hotelModel->getFeaturedHotels(),
            'popularCities' => $this->cityModel->getPopularCities(),
            'promoBanners' => $this->getPromoBanners()
        ];

        return view('home/index', $data);
    }

    /**
     * Tentang Kami
     */
    public function about()
    {
        return view('home/about', [
            'title' => 'Tentang Kami'
        ]);
    }

    /**
     * Hubungi Kami
     */
    public function contact()
    {
        return view('home/contact', [
            'title' => 'Hubungi Kami'
        ]);
    }

    /**
     * FAQ
     */
    public function faq()
    {
        return view('home/faq', [
            'title' => 'Pertanyaan Umum'
        ]);
    }

    // =============== METHOD PRIVATE ===============

    /**
     * Ambil hotel rekomendasi
     */
    private function getFeaturedHotels()
    {
        return $this->hotelModel
            ->select('hotels.*, cities.name as city_name')
            ->join('cities', 'cities.id = hotels.city_id')
            ->orderBy('hotels.star_rating', 'DESC')
            ->limit(4)
            ->find();
    }

    /**
     * Ambil kota populer
     */
    private function getPopularCities()
    {
        return $this->cityModel
            ->select('cities.*, COUNT(hotels.id) as hotel_count')
            ->join('hotels', 'hotels.city_id = cities.id', 'left')
            ->groupBy('cities.id')
            ->orderBy('hotel_count', 'DESC')
            ->limit(6)
            ->find();
    }

    /**
     * Data dummy promo banner
     */
    private function getPromoBanners()
    {
        return [
            [
                'image' => 'promo1.jpg',
                'title' => 'Diskon 30% Akhir Tahun',
                'subtitle' => 'Hanya sampai 31 Desember'
            ],
            [
                'image' => 'promo2.jpg',
                'title' => 'Paket Liburan Keluarga',
                'subtitle' => 'Free 1 Kamar Tambahan'
            ]
        ];
    }
}