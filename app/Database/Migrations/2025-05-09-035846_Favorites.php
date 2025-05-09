<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Favorites extends Migration
{
    public function up()
    {
        $this->forge->addField([
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
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey(['user_id', 'hotel_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('favorites');

        $this->db->query("ALTER TABLE favorites 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('favorites');
    }
}