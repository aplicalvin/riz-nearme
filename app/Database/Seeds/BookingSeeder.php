<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Pastikan seeder lain sudah dijalankan
        $roomTypes = $this->db->table('room_types')->get()->getResultArray();
        $paymentMethods = $this->db->table('payment_methods')->get()->getResultArray();
        
        $data = [
            // Booking untuk user 1 - Hotel 1
            [
                'user_id' => 1,
                'hotel_id' => 1,
                'room_type_id' => $roomTypes[0]['id'],
                'payment_method_id' => $paymentMethods[0]['id'],
                'check_in_date' => '2025-06-15',
                'check_out_date' => '2025-06-18',
                'adults' => 2,
                'children' => 0,
                'total_price' => 3600000.00,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_proof' => 'proof1.jpg',
                'special_requests' => 'Mohon kamar di lantai tinggi dengan pemandangan kota'
            ],
            // Booking untuk user 1 - Hotel 2
            [
                'user_id' => 1,
                'hotel_id' => 2,
                'room_type_id' => $roomTypes[3]['id'],
                'payment_method_id' => $paymentMethods[2]['id'],
                'check_in_date' => '2025-07-20',
                'check_out_date' => '2025-07-25',
                'adults' => 2,
                'children' => 1,
                'total_price' => 17500000.00,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_proof' => null,
                'special_requests' => 'Membutuhkan baby cot untuk anak kami'
            ],
            // Booking untuk user 2 - Hotel 1
            [
                'user_id' => 2,
                'hotel_id' => 1,
                'room_type_id' => $roomTypes[1]['id'],
                'payment_method_id' => $paymentMethods[4]['id'],
                'check_in_date' => '2025-06-01',
                'check_out_date' => '2025-06-03',
                'adults' => 2,
                'children' => 0,
                'total_price' => 5000000.00,
                'status' => 'completed',
                'payment_status' => 'paid',
                'payment_proof' => 'proof2.jpg',
                'special_requests' => 'Perayaan anniversary, mohon dekorasi kamar'
            ],
            // Booking untuk user 3 - Hotel 2
            [
                'user_id' => 3,
                'hotel_id' => 2,
                'room_type_id' => $roomTypes[4]['id'],
                'payment_method_id' => $paymentMethods[5]['id'],
                'check_in_date' => '2025-08-10',
                'check_out_date' => '2025-08-15',
                'adults' => 1,
                'children' => 0,
                'total_price' => 9000000.00,
                'status' => 'confirmed',
                'payment_status' => 'pending',
                'payment_proof' => null,
                'special_requests' => 'Vegetarian, mohon tidak ada produk hewani di kamar'
            ]
        ];

        // Gunakan insertBatch tanpa created_at dan updated_at
        $this->db->table('bookings')->insertBatch($data);
    }
}