<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Kamar untuk Hotel 1 (Grand Luxury Hotel)
            [
                'hotel_id' => 1,
                'name' => 'Deluxe Room',
                'description' => 'Kamar luas dengan tempat tidur king size, AC, dan kamar mandi mewah',
                'base_price' => 1200000.00,
                'capacity' => 2,
                'available_rooms' => 10,
                'photo' => 'deluxe_room.jpg'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Executive Suite',
                'description' => 'Suite mewah dengan ruang tamu terpisah, mini bar, dan pemandangan kota',
                'base_price' => 2500000.00,
                'capacity' => 2,
                'available_rooms' => 5,
                'photo' => 'executive_suite.jpg'
            ],
            [
                'hotel_id' => 1,
                'name' => 'Presidential Suite',
                'description' => 'Suite terluas dengan fasilitas terbaik, butler service, dan pemandangan spektakuler',
                'base_price' => 5000000.00,
                'capacity' => 4,
                'available_rooms' => 2,
                'photo' => 'presidential_suite.jpg'
            ],
            
            // Kamar untuk Hotel 2 (Sunset Beach Resort)
            [
                'hotel_id' => 2,
                'name' => 'Beachfront Villa',
                'description' => 'Villa pribadi dengan akses langsung ke pantai dan kolam renang pribadi',
                'base_price' => 3500000.00,
                'capacity' => 4,
                'available_rooms' => 8,
                'photo' => 'beachfront_villa.jpg'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Garden View Bungalow',
                'description' => 'Bungalow nyaman dengan taman tropis dan jarak dekat ke pantai',
                'base_price' => 1800000.00,
                'capacity' => 2,
                'available_rooms' => 12,
                'photo' => 'garden_bungalow.jpg'
            ],
            [
                'hotel_id' => 2,
                'name' => 'Family Suite',
                'description' => 'Suite luas dengan 2 kamar tidur, cocok untuk keluarga',
                'base_price' => 2800000.00,
                'capacity' => 6,
                'available_rooms' => 4,
                'photo' => 'family_suite.jpg'
            ]
        ];

        // Using Query Builder
        $this->db->table('room_types')->insertBatch($data);
    }
}