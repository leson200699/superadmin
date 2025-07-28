<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarColorsTable extends Migration
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
            'car_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'hex_code' => [
                'type' => 'VARCHAR',
                'constraint' => 7, // #FFFFFF
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('car_id', 'cars', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('car_colors');
    }

    public function down()
    {
        $this->forge->dropTable('car_colors');
    }
} 