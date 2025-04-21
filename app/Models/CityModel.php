<?php namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'cities';
    protected $allowedFields = ['name', 'province'];

    public function getCitiesWithHotels()
    {
        return $this->select('cities.*, COUNT(hotels.id) as hotel_count')
                   ->join('hotels', 'hotels.city_id = cities.id', 'left')
                   ->groupBy('cities.id')
                   ->findAll();
    }
}