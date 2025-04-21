<?php namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'facilities';

    public function getFacilitiesByHotel($hotelId)
    {
        return $this->where('hotel_id', $hotelId)
                   ->findAll();
    }
}