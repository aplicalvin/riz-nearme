<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'payment_methods';

    public function getActiveMethods()
    {
        return $this->where('is_active', true)
                   ->findAll();
    }
}