<?php namespace App\Models;

use CodeIgniter\Model;

class ComplaintModel extends Model
{
    protected $table = 'complaints';

    public function getUnresolvedComplaints()
    {
        return $this->where('status', 'open')
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}