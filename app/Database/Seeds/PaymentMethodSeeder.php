<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Bank Transfer - BCA',
                'code' => 'BCA',
                'type' => 'bank_transfer',
                'is_active' => 1,
                'icon' => 'bca.png'
            ],
            [
                'name' => 'Bank Transfer - Mandiri',
                'code' => 'MANDIRI',
                'type' => 'bank_transfer',
                'is_active' => 1,
                'icon' => 'mandiri.png'
            ],
            [
                'name' => 'Gopay',
                'code' => 'GOPAY',
                'type' => 'e_wallet',
                'is_active' => 1,
                'icon' => 'gopay.png'
            ],
            [
                'name' => 'OVO',
                'code' => 'OVO',
                'type' => 'e_wallet',
                'is_active' => 1,
                'icon' => 'ovo.png'
            ],
            [
                'name' => 'Credit Card - Visa/Mastercard',
                'code' => 'CC',
                'type' => 'credit_card',
                'is_active' => 1,
                'icon' => 'credit_card.png'
            ],
            [
                'name' => 'Cash on Arrival',
                'code' => 'CASH',
                'type' => 'cash',
                'is_active' => 1,
                'icon' => 'cash.png'
            ]
        ];

        // Using Query Builder
        $this->db->table('payment_methods')->insertBatch($data);
    }
}