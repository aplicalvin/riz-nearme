<?php namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';

    public function getHotelRating($hotelId)
    {
        return $this->selectAvg('rating')
                   ->where('hotel_id', $hotelId)
                   ->first();
    }
}