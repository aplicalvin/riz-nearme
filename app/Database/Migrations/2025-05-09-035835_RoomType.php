<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomTypes extends Migration
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
            'hotel_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'base_price' => [
                'type' => 'DECIMAL',
                'constraint' => [12,2]
            ],
            'capacity' => [
                'type' => 'INT',
                'default' => 2
            ],
            'available_rooms' => [
                'type' => 'INT',
                'default' => 0
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('room_types');
    }

    public function down()
    {
        $this->forge->dropTable('room_types');
    }
}