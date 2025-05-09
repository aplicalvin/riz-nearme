<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cities extends Migration
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
            'province' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'Indonesia'
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('cities');
    }

    public function down()
    {
        $this->forge->dropTable('cities');
    }
}