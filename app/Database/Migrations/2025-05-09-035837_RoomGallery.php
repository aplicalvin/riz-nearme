<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomGalleries extends Migration
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
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'room_type_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('room_type_id', 'room_types', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('room_galleries');

        $this->db->query("ALTER TABLE room_galleries 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('room_galleries');
    }
}