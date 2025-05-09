<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Complaints extends Migration
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
            'message' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['open','resolved'],
                'default' => 'open'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('complaints');

        $this->db->query("ALTER TABLE complaints 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('complaints');
    }
}