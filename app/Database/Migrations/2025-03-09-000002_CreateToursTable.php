<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateToursTable extends Migration
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
            'author_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tourcategory_id' => [  // Đổi từ category_id thành tourcategory_id
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'itinerary' => [
                'type' => 'TEXT',
            ],
            'transport' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('author_id', 'users', 'id');
        $this->forge->addForeignKey('tourcategory_id', 'tourcategories', 'id');  // Cập nhật foreign key
        $this->forge->createTable('tours');
    }

    public function down()
    {
        $this->forge->dropTable('tours');
    }
}