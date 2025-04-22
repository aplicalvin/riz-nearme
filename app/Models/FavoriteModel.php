<?php namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorites';

    public function getUserFavorites($userId)
{
    return $this->select('favorites.*, hotels.name, hotels.cover_photo, hotels.star_rating')
              ->join('hotels', 'hotels.id = favorites.hotel_id')
              ->where('favorites.user_id', $userId)
              ->findAll();
}
}