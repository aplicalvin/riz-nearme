<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
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
                'constraint' => 50
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}