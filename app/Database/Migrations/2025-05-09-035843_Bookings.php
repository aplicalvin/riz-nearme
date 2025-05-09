<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bookings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'hotel_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'room_type_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'payment_method_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'check_in_date' => [
                'type' => 'DATE'
            ],
            'check_out_date' => [
                'type' => 'DATE'
            ],
            'adults' => [
                'type' => 'INT',
                'default' => 1
            ],
            'children' => [
                'type' => 'INT',
                'default' => 0
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => [12,2]
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','confirmed','cancelled','completed','no_show'],
                'default' => 'pending'
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending','paid','failed','refunded'],
                'default' => 'pending'
            ],
            'payment_proof' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'special_requests' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id');
        $this->forge->addForeignKey('room_type_id', 'room_types', 'id');
        $this->forge->addForeignKey('payment_method_id', 'payment_methods', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addKey(['check_in_date', 'check_out_date']);
        $this->forge->addKey('status');
        $this->forge->createTable('bookings');

        $this->db->query("ALTER TABLE bookings 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            MODIFY updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}