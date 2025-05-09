<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // 3 Regular Users (role=user)
        $users = [
            [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'full_name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'role' => 'user'
            ],
            [
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'full_name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'role' => 'user'
            ],
            [
                'username' => 'user3',
                'email' => 'user3@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'full_name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'role' => 'user'
            ]
        ];

        // 2 Hotel Managers (role=hotel)
        $hotelManagers = [
            [
                'username' => 'hotel_manager1',
                'email' => 'manager1@hotel.com',
                'password' => password_hash('hotel', PASSWORD_DEFAULT),
                'full_name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'role' => 'hotel'
            ],
            [
                'username' => 'hotel_manager2',
                'email' => 'manager2@hotel.com',
                'password' => password_hash('hotel', PASSWORD_DEFAULT),
                'full_name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'role' => 'hotel'
            ]
        ];

        // 1 Admin (role=admin)
        $admin = [
            'username' => 'admin',
            'email' => 'admin@hotelbooking.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'full_name' => 'System Administrator',
            'phone' => $faker->phoneNumber(),
            'role' => 'admin'
        ];

        // Insert all users
        $this->db->table('users')->insertBatch($users);
        $this->db->table('users')->insertBatch($hotelManagers);
        $this->db->table('users')->insert($admin);
    }
}