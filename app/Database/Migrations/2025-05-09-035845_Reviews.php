<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reviews extends Migration
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
            'booking_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
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
            'rating' => [
                'type' => 'TINYINT'
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('booking_id', 'bookings', 'id');
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('hotel_id', 'hotels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reviews');

        $this->db->query("ALTER TABLE reviews 
            MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ADD CONSTRAINT chk_rating_range CHECK (rating BETWEEN 1 AND 5)");
    }

    public function down()
    {
        $this->forge->dropTable('reviews');
    }
}