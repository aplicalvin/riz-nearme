<?php namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\CityModel;
use App\Models\FacilityModel;
use App\Models\RoomTypeModel;

class HotelController extends BaseController
{
    protected $hotelModel;
    protected $cityModel;
    protected $facilityModel;
    protected $roomTypeModel;

    public function __construct()
    {
        $this->hotelModel = new HotelModel();
        $this->cityModel = new CityModel();
        $this->facilityModel = new FacilityModel();
        $this->roomTypeModel = new RoomTypeModel();
    }

    // Tampilkan semua hotel (untuk user biasa)
    public function index()
    {
        $data = [
            'title' => 'Daftar Hotel',
            'hotels' => $this->hotelModel->getHotelsWithCities(),
            'cities' => $this->cityModel->findAll()
        ];

        return view('hotel/index', $data);
    }

    // Detail hotel
    public function show($id)
    {
        $hotel = $this->hotelModel->getHotelWithDetails($id);

        if (!$hotel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $hotel['name'],
            'hotel' => $hotel,
            'facilities' => $this->facilityModel->where('hotel_id', $id)->findAll(),
            'rooms' => $this->roomTypeModel->where('hotel_id', $id)->findAll()
        ];

        return view('hotel/show', $data);
    }
}