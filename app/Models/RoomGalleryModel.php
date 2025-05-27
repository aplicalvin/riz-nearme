<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomGalleryModel extends Model
{
    protected $table = 'room_galleries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['photo', 'room_type_id', 'created_at'];
    protected $useTimestamps = false; // Ubah menjadi false jika tidak ingin sama sekali
    protected $updatedField = null; // Tambahkan ini untuk menonaktifkan updated_at
    public function getPhotosByRoom($roomTypeId)
    {
        return $this->where('room_type_id', $roomTypeId)->findAll();
    }
}
