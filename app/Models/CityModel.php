<?php namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class CityModel extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id'; // Tambahkan ini
    protected $allowedFields = ['name', 'province'];
    protected $validationRules = []; // Bisa diisi jika ingin validasi di model
    protected $validationMessages = [];
    protected $skipValidation = false;
    public function __construct()
    {
        parent::__construct();
        $this->validation = Services::validation(); // Inisialisasi validation service
    }

    // Validasi input
    public function validateCity($data, $isUpdate = false)
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'province' => 'required|min_length[3]|max_length[100]'
        ];

        return $rules;
    }

    // Ambil semua kota dengan jumlah hotel
    public function getCitiesWithHotels()
    {
        return $this->select('cities.*, COUNT(hotels.id) as hotel_count')
                   ->join('hotels', 'hotels.city_id = cities.id', 'left')
                   ->groupBy('cities.id')
                   ->orderBy('cities.name', 'ASC')
                   ->findAll();
    }

    // Cari kota berdasarkan nama atau provinsi
    public function searchCities($keyword)
    {
        return $this->select('cities.*, COUNT(hotels.id) as hotel_count')
                   ->join('hotels', 'hotels.city_id = cities.id', 'left')
                   ->groupStart()
                       ->like('cities.name', $keyword)
                       ->orLike('cities.province', $keyword)
                   ->groupEnd()
                   ->groupBy('cities.id')
                   ->findAll();
    }

    // Dapatkan daftar provinsi unik
    public function getUniqueProvinces()
    {
        return $this->select('province')
                   ->distinct()
                   ->orderBy('province', 'ASC')
                   ->findAll();
    }
}