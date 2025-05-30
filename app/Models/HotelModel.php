<?php namespace App\Models;

use CodeIgniter\Model;
use Config\Services; // Ini yang benar


class HotelModel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'city_id', 'admin_id', 'star_rating', 'cover_photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    protected $validation;

    public function __construct()
    {
        parent::__construct();
        $this->validation = Services::validation(); // Inisialisasi validation service
    }

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



    /**
     * Hitung jumlah hotel dengan kondisi tertentu (opsional)
     * 
     * @param array $conditions Kondisi where (contoh: ['city_id' => 1])
     * @return int Jumlah hotel yang memenuhi kondisi
     */
    public function countHotels($conditions = [])
    {
        if (!empty($conditions)) {
            return $this->where($conditions)->countAllResults();
        }
        return $this->countAll();
    }


    // Ambil semua hotel dengan data kota terkait
    public function getAllHotelsWithCities()
    {
        return $this->select('hotels.*, cities.name as city_name, users.full_name as admin_name')
                   ->join('cities', 'cities.id = hotels.city_id', 'left')
                   ->join('users', 'users.id = hotels.admin_id', 'left')
                   ->orderBy('hotels.created_at', 'DESC')
                   ->findAll();
    }

    // Ambil detail hotel lengkap dengan join
    public function getHotelDetails($id)
    {
        return $this->select('hotels.*, cities.name as city_name, users.full_name as admin_name')
                   ->join('cities', 'cities.id = hotels.city_id', 'left')
                   ->join('users', 'users.id = hotels.admin_id', 'left')
                   ->where('hotels.id', $id)
                   ->first();
    }

    // Validasi sebelum menyimpan
    public function validateHotel($data, $isUpdate = false)
    {
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'description' => 'required|min_length[10]',
            'address' => 'required',
            'city_id' => 'required|numeric',
            'star_rating' => 'permit_empty|numeric|less_than_equal_to[5]',
            'admin_id' => 'permit_empty|numeric' // Tambahkan validasi untuk admin_id

        ];

        if ($isUpdate) {
            $validationRules['id'] = 'required|numeric';
        }

        $this->validation->setRules($validationRules);

        if (!$this->validation->run($data)) {
            return $this->validation->getErrors();
        }

        return true;
    }

    // HotelModel.php

    public function deleteHotelWithDependencies($hotelId)
    {
        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaction

        try {
            // 1. Dapatkan data hotel beserta admin_id
            $hotel = $this->find($hotelId);
            if (!$hotel) {
                throw new \RuntimeException('Hotel tidak ditemukan');
            }

            // 2. Hapus semua room_types terkait hotel ini
            $roomTypeModel = new \App\Models\RoomTypeModel();
            $roomTypes = $roomTypeModel->where('hotel_id', $hotelId)->findAll();
            
            // Hapus gambar-gambar kamar jika ada
            foreach ($roomTypes as $room) {
                if ($room['photo'] && file_exists(ROOTPATH . 'public/uploads/rooms/' . $room['photo'])) {
                    unlink(ROOTPATH . 'public/uploads/rooms/' . $room['photo']);
                }
            }
            
            // Hapus semua room_types
            $roomTypeModel->where('hotel_id', $hotelId)->delete();

            // 3. Hapus cover photo hotel jika ada
            if ($hotel['cover_photo'] && file_exists(ROOTPATH . 'public/uploads/hotels/' . $hotel['cover_photo'])) {
                unlink(ROOTPATH . 'public/uploads/hotels/' . $hotel['cover_photo']);
            }

            // 4. Hapus hotel
            $this->delete($hotelId);

            // 5. Hapus user admin jika ada
            if ($hotel['admin_id']) {
                $userModel = new \App\Models\UserModel();
                
                // Hapus foto profil admin jika ada
                $admin = $userModel->find($hotel['admin_id']);
                if ($admin && $admin['photo'] && file_exists(ROOTPATH . 'public/uploads/profiles/' . $admin['photo'])) {
                    unlink(ROOTPATH . 'public/uploads/profiles/' . $admin['photo']);
                }
                
                $userModel->delete($hotel['admin_id']);
            }

            $db->transComplete(); // Commit transaction

            return true;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback jika ada error
            log_message('error', 'Gagal menghapus hotel: ' . $e->getMessage());
            return false;
        }
    }

    public function getFilteredHotels($filters = [])
    {
        $builder = $this->select('hotels.*, cities.name as city_name')
                        ->join('cities', 'cities.id = hotels.city_id');
        // Filter berdasarkan kota
        if (!empty($filters['city'])) {
            $builder->where('cities.name', $filters['city']);
        }
        
        // Filter berdasarkan rating bintang
        if (!empty($filters['stars'])) {
            $builder->where('hotels.star_rating', $filters['stars']);
        }

        return $builder->findAll();
    }


   public function getFilterOptions()
    {
        // Ambil semua kota unik
     $cities = $this->db->table('cities')
                    ->select('name')
                    ->distinct()
                    ->orderBy('name', 'ASC')
                    ->get()
                    ->getResultArray();

        return [
            'cities' => array_column($cities, 'name'),
            'star_ratings' => [1, 2, 3, 4, 5],
        ];
    }




    public function getPaginatedHotels($filters = [], $perPage = 12, $page = 1)
    {
        $builder = $this->select('hotels.*, cities.name as city_name')
                    ->join('cities', 'cities.id = hotels.city_id');
        
        // Terapkan filter
        $this->applyFilters($builder, $filters);
        
        return [
            'hotels' => $builder->paginate($perPage, 'default', $page),
            'pager' => $builder->pager
        ];
    }

    public function countFilteredHotels($filters = [])
    {
        $builder = $this->select('hotels.id')
                    ->join('cities', 'cities.id = hotels.city_id');
        
        // Terapkan filter yang sama
        $this->applyFilters($builder, $filters);
        
        return $builder->countAllResults();
    }

    // protected function applyFilters(&$builder, $filters)
    // {
    //     // Filter berdasarkan kota
    //     if (!empty($filters['city'])) {
    //         $builder->where('cities.name', $filters['city']);
    //     }
        
    //     // Filter berdasarkan rating bintang
    //     if (!empty($filters['stars'])) {
    //         $builder->where('hotels.star_rating', $filters['stars']);
    //     }
    // }

     protected function applyFilters(&$builder, $filters)
    {
        // Filter berdasarkan kota
        if (!empty($filters['city'])) {
            $builder->where('cities.name', $filters['city']);
        }

        // Filter berdasarkan rating bintang
        if (!empty($filters['stars'])) {
            $builder->where('hotels.star_rating', $filters['stars']);
        }

        // 🔍 Filter berdasarkan input keyword lokasi/nama hotel
        if (!empty($filters['location'])) {
            $builder->groupStart()
                    ->like('hotels.name', $filters['location'])
                    ->orLike('cities.name', $filters['location'])
                    ->groupEnd();
        }
    }
}