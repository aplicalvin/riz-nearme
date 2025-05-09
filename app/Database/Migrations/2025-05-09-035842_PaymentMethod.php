<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentMethods extends Migration
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
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['bank_transfer','e_wallet','credit_card','cash']
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'default' => 1
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('code');
        $this->forge->createTable('payment_methods');
    }

    public function down()
    {
        $this->forge->dropTable('payment_methods');
    }
}