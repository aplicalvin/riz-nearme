<?php namespace App\Models;

use CodeIgniter\Model;
use Config\Services; 
use function PHPUnit\Framework\returnArgument;// Tambahkan ini

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'phone', 'photo', 'role'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

     protected $validation; // Tambahkan properti ini

    public function __construct()
    {
        parent::__construct();
        $this->validation = Services::validation(); // Inisialisasi validation service
    }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Hitung total semua user
     * @return int
     */
    public function countAllUsers()
    {
        return $this->countAll();
    }

    /**
     * Hitung user berdasarkan role tertentu
     * @param string $role
     * @return int
     */
    public function countUsersByRole($role)
    {
        return $this->where('role', $role)->countAllResults();
    }

    /**
     * Hitung user dengan kondisi custom
     * @param array $conditions
     * @return int
     */
    public function countUsersWithConditions($conditions = [])
    {
        if (!empty($conditions)) {
            return $this->where($conditions)->countAllResults();
        }
        return $this->countAll();
    }

    // ADD NEW ADMIN
    public function createHotelAdmin($data)
    {
        // Validasi input
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|numeric',
            'password' => 'required|min_length[4]'
        ];

        $this->validation->setRules($rules);
        
        if (!$this->validation->run($data)) {
            return ['success' => false, 'errors' => $this->validation->getErrors()];
        }

        // Tambahkan role hotel
        $data['role'] = 'hotel';
        
        // Simpan user
        if ($this->save($data)) {
            return ['success' => true, 'user_id' => $this->insertID];
        }
        
        return ['success' => false, 'errors' => $this->errors()];
    }

    public function getFilteredUsers($search = null, $sort = 'created_at', $order = 'DESC')
    {
        $builder = $this->where('role', 'user');
        
        if (!empty($search)) {
            $builder->groupStart()
                ->like('full_name', $search)
                ->orLike('username', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }
        
        return $builder->orderBy($sort, $order);
    }

    // UserModel.php

    /**
     * Reset password user ke default
     * @param int $id User ID
     * @return bool
     */
    public function resetPassword($id)
    {
        $defaultPassword = 'password';
        // Lewati beforeUpdate dengan menggunakan skipValidation dan direct update
        return $this->where('id', $id)
                ->set('password', $defaultPassword)
                ->update();
    }

    public function getUserRole($id)
    {
        $user = $this->find($id); // Ambil user berdasarkan ID

        if ($user && isset($user['role'])) {
            return $user['role'];
        }

        return null; // Atau bisa juga return 'guest', 'unknown', dll sesuai kebutuhanmu
    }

}