<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class HotelsSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // Get hotel manager users (role=hotel)
        $hotelManagers = $this->db->table('users')
            ->where('role', 'hotel')
            ->get()
            ->getResultArray();

        if (count($hotelManagers) < 2) {
            throw new \RuntimeException('Need at least 2 hotel manager users to seed hotels');
        }

        $hotels = [
            [
                'name' => 'Grand Luxury Hotel',
                'description' => 'Hotel bintang 5 dengan fasilitas mewah dan pelayanan terbaik di jantung kota',
                'address' => $faker->address(),
                'city_id' => 1, // Assuming Jakarta is city_id 1
                'admin_id' => $hotelManagers[0]['id'],
                'star_rating' => 5,
                'cover_photo' => 'grand_hotel.jpg'
            ],
            [
                'name' => 'Sunset Beach Resort',
                'description' => 'Resort tepi pantai dengan pemandangan matahari terbenam yang menakjubkan',
                'address' => $faker->address(),
                'city_id' => 3, // Assuming Bali is city_id 3
                'admin_id' => $hotelManagers[1]['id'],
                'star_rating' => 4,
                'cover_photo' => 'sunset_resort.jpg'
            ]
        ];

        $this->db->table('hotels')->insertBatch($hotels);
    }
}