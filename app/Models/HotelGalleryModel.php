<?php namespace App\Models;

use CodeIgniter\Model;

class HotelGalleryModel extends Model
{
    protected $table = 'Hotel_Galleries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['photo', 'hotel_id'];
    protected $useTimestamps = false; // Ubah menjadi false jika tidak ingin sama sekali
    protected $updatedField = null; // Tambahkan ini untuk menonaktifkan updated_at
    protected $createdField = 'created_at';
    
    /**
     * Get all photos for a hotel
     */
    public function getPhotosByHotel($hotelId)
    {
        return $this->where('hotel_id', $hotelId)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
    
    /**
     * Add new photo to gallery
     */
    public function addPhoto($hotelId, $photoName)
    {
        return $this->insert([
            'hotel_id' => $hotelId,
            'photo' => $photoName,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    
    /**
     * Delete photo from gallery
     */
    public function deletePhoto($id)
    {
        $photo = $this->find($id);
        if (!$photo) {
            return false;
        }
        
        // Delete file from server
        $filePath = ROOTPATH . 'public/uploads/galleries/' . $photo['photo'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        return $this->delete($id);
    }
}