<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table         = 'reviews';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';

    /**
     * Kolom yang diizinkan untuk diisi.
     * Ini sudah benar dan sesuai dengan kebutuhan Anda.
     */
    protected $allowedFields = [
        'booking_id',
        'user_id',
        'hotel_id',
        'rating',
        'comment'
    ];

    /**
     * Konfigurasi Timestamps yang TEPAT sesuai tabel Anda.
     * CodeIgniter akan mengelola 'created_at' secara otomatis,
     * dan mengabaikan 'updated_at' karena sudah kita nonaktifkan.
     */
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = ''; // Dikosongkan karena tidak ada kolom 'updated_at' di tabel Anda

    
    // --- Fungsi-fungsi di bawah ini tetap sama ---

    public function getHotelRating($hotelId)
    {
        return $this->selectAvg('rating')
                    ->where('hotel_id', $hotelId)
                    ->first();
    }

    public function getReview($booking_id)
    {
        return $this->where('booking_id', $booking_id)
                    ->first();
    }
}