<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Facilities extends Migration
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
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('facilities');
    }

    public function down()
    {
        $this->forge->dropTable('facilities');
    }
}