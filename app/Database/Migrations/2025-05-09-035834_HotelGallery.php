<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HotelGalleries extends Migration
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
            'hotel_id' => [
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
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id');
        $this->forge->createTable('hotel_galleries');

        $this->db->query("ALTER TABLE hotel_galleries 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('hotel_galleries');
    }
}