<?php namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model
{
    protected $table = 'room_types';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'hotel_id',
        'name',
        'description',
        'base_price',
        'capacity',
        'available_rooms',
        'photo'
    ];
    // protected $useTimestamps = true;
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';

    // Get rooms by hotel ID
    public function getRoomsByHotel($hotelId)
    {
        return $this->where('hotel_id', $hotelId)->findAll();
    }

    // Get room data with hotel info
    public function getRoomWithHotel($roomId)
    {
        return $this->select('room_types.*, hotels.name as hotel_name')
                   ->join('hotels', 'hotels.id = room_types.hotel_id')
                   ->where('room_types.id', $roomId)
                   ->first();
    }
}