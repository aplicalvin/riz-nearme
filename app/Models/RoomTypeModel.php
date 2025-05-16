<?php namespace App\Models;

use CodeIgniter\Model;

class RoomTypeModel extends Model
{
    protected $table = 'room_types';
    protected $allowedFields = ['hotel_id', 'name', 'base_price', 'capacity'];

    public function getAvailableRooms($hotelId, $checkIn, $checkOut)
    {
        // Logika cek kamar yang tersedia di tanggal tertentu
        return $this->where('hotel_id', $hotelId)
                   ->findAll();
    }

    // Get Room Information via admin
    public function getRoomData($hotelId) 
    {

        return $this->where(['hotel_id' => $hotelId])->findAll();
    }
}