<?php namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'city_id', 'admin_id', 'star_rating', 'cover_photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Ambil hotel beserta data kota
    public function getHotelsWithCities()
    {
        return $this->select('hotels.*, cities.name as city_name')
                   ->join('cities', 'cities.id = hotels.city_id')
                   ->findAll();
    }

    // get Hotel ID by Admin ID
    public function getHotelID($admin_id) {
        // gimana cara agar saya cuma return atribut "id" pada tabel hotel?
        return $this->select('id')
                    ->where(['admin_id' => $admin_id])
                    ->first();
    }

    // Get Full Data Hotel
    public function getHotelData($id) 
    {
        return $this->where(['id' => $id])->first();
    }


    // UPDATE HOTEL DATA
    public function updateHotelData($id, array $data)
    {
        // Validasi ID
        if (empty($id)) {
            throw new \InvalidArgumentException('Hotel ID tidak boleh kosong');
        }

        // Filter data hanya untuk field yang diizinkan
        $filteredData = array_intersect_key($data, array_flip($this->allowedFields));

        if (empty($filteredData)) {
            throw new \RuntimeException('Tidak ada data yang valid untuk diupdate');
        }

        // Tambahkan updated_at manual jika perlu
        if ($this->useTimestamps) {
            $filteredData[$this->updatedField] = date('Y-m-d H:i:s');
        }

        return $this->update($id, $filteredData);
    }

}