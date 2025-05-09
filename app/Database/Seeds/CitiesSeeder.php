<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            [
                'name' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'country' => 'Indonesia'
            ],
            [
                'name' => 'Bandung',
                'province' => 'Jawa Barat',
                'country' => 'Indonesia'
            ],
            [
                'name' => 'Bali',
                'province' => 'Bali',
                'country' => 'Indonesia'
            ],
            [
                'name' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'country' => 'Indonesia'
            ],
            [
                'name' => 'Surabaya',
                'province' => 'Jawa Timur',
                'country' => 'Indonesia'
            ]
        ];

        $this->db->table('cities')->insertBatch($cities);
    }
}