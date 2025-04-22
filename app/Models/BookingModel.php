<?php namespace App\Models;

use CodeIgniter\Model;


class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $allowedFields = ['user_id', 'hotel_id', 'room_type_id', 'check_in_date', 'check_out_date', 'status'];

    public function getUserBookings($userId)
    {
        return $this->select('bookings.*, hotels.name as hotel_name, room_types.name as room_type')
        ->join('hotels', 'hotels.id = bookings.hotel_id')
        ->join('room_types', 'room_types.id = bookings.room_type_id')
        ->where('bookings.user_id', $userId)
        ->orderBy('bookings.created_at', 'DESC')
        ->findAll();
}

    public function createBooking(array $data)
    {
        // Validasi tanggal dll bisa ditambahkan di sini
        return $this->insert($data);
    }
}