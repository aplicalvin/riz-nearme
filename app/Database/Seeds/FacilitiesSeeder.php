<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Fasilitas untuk Hotel 1 (Grand Luxury Hotel)
            [
                'hotel_id' => 1,
                'name' => 'Kolam Renang',
                'description' => 'Kolam renang outdoor dengan pemandangan kota',
                'icon' => 'pool'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Spa & Wellness',
                'description' => 'Layanan spa lengkap dengan pijat tradisional',
                'icon' => 'spa'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Restoran',
                'description' => 'Restoran mewah dengan berbagai menu internasional',
                'icon' => 'restaurant'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Gym',
                'description' => 'Fasilitas gym lengkap dengan pelatih pribadi',
                'icon' => 'gym'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Parkir Valet',
                'description' => 'Layanan parkir valet 24 jam',
                'icon' => 'parking'
            ],
            
            // Fasilitas untuk Hotel 2 (Sunset Beach Resort)
            [
                'hotel_id' => 2,
                'name' => 'Private Beach',
                'description' => 'Pantai pribadi dengan pasir putih dan air jernih',
                'icon' => 'beach'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Water Sports',
                'description' => 'Aneka aktivitas air seperti snorkeling dan kayak',
                'icon' => 'watersports'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Beach Bar',
                'description' => 'Bar tepi pantai dengan minuman tropis',
                'icon' => 'bar'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Kids Club',
                'description' => 'Area bermain dan aktivitas khusus untuk anak-anak',
                'icon' => 'kids'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Bicycle Rental',
                'description' => 'Sewa sepeda untuk menjelajahi sekitar resort',
                'icon' => 'bicycle'
            ]
        ];

        // Using Query Builder
        $this->db->table('facilities')->insertBatch($data);
    }
}