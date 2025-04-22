<?php namespace App\Models;

use CodeIgniter\Model;


class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $allowedFields = ['user_id', 'hotel_id', 'room_type_id', 'check_in_date', 'check_out_date', 'status'];

    public function getUserBookings($userId)
    {
        return $this->where('user_id', $userId)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }

    public function createBooking(array $data)
    {
        // Validasi tanggal dll bisa ditambahkan di sini
        return $this->insert($data);
    }
}