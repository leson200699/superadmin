<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEnglishToTourCategories extends Migration
{
    public function up()
    {
        $fields = [
            'name_en' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'description_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('tourcategories', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tourcategories', 'name_en');
        $this->forge->dropColumn('tourcategories', 'description_en');
    }
}