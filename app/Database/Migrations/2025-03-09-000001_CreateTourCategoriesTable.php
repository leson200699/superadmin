<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTourCategoriesTable extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'name_en' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'description_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_domestic' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1, // 1: trong nước, 0: quốc tế
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tourcategories');
    }

    public function down()
    {
        $this->forge->dropTable('tourcategories');
    }
}