<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hotels extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'address' => [
                'type' => 'TEXT'
            ],
            'city_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'star_rating' => [
                'type' => 'TINYINT',
                'null' => true
            ],
            'cover_photo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->addForeignKey('city_id', 'cities', 'id');
        $this->forge->addForeignKey('admin_id', 'users', 'id');
        $this->forge->createTable('hotels');

        $this->db->query("ALTER TABLE hotels 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            MODIFY updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('hotels');
    }
}