<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'phone', 'photo', 'role'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

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
}