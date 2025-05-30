<?php namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class FavoriteModel extends Model
{
    protected $table = 'favorites';
    protected $useTimestamps    = false;

    protected $allowedFields = ['user_id', 'hotel_id', 'created_at'];

    public function getUserFavorites($userId)
    {
        return $this->select('favorites.*, hotels.name, hotels.cover_photo, hotels.star_rating')
                ->join('hotels', 'hotels.id = favorites.hotel_id')
                ->where('favorites.user_id', $userId)
                ->findAll();
    }

    // isFavorite?
    public function checkFavorite($userId, $hotelId)
    {
        $favorite = $this->where('user_id', $userId)
                         ->where('hotel_id', $hotelId)
                         ->first();
        return $favorite !== null;
    }

    // For add favorite
    public function addFavorites($userId, $hotelId) 
    {
        $data = [
            'user_id'    => $userId,
            'hotel_id'   => $hotelId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        
            $result = $this->insert($data);
            return true; 
    }


    // For delete favorite
    public function deleteFavorite($userId, $hotelId)
    {
        try {
            $result = $this->where('user_id', $userId)
                        ->where('hotel_id', $hotelId)
                        ->delete();
            return $result;
        } catch (\Exception $e) {
            log_message('error', '[FavoriteModel] Gagal menghapus favorit: ' . $e->getMessage() . ' - Data: user_id=' . $userId . ', hotel_id=' . $hotelId);
            return false;
        }
    }
}