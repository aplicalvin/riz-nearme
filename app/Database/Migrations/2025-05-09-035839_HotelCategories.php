<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HotelCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hotel_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ]
        ]);
        $this->forge->addPrimaryKey(['hotel_id', 'category_id']);
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hotel_categories');
    }

    public function down()
    {
        $this->forge->dropTable('hotel_categories');
    }
}