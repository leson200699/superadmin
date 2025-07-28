<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tour_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'booking_date' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'cancelled'],
                'default' => 'pending',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tour_id', 'tours', 'id');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}