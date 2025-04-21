<?php namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'city_id', 'admin_id', 'star_rating', 'cover_photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Ambil hotel beserta data kota
    public function getHotelsWithCities()
    {
        return $this->select('hotels.*, cities.name as city_name')
                   ->join('cities', 'cities.id = hotels.city_id')
                   ->findAll();
    }
}