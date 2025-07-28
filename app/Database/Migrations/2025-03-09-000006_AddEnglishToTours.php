<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEnglishToTours extends Migration
{
    public function up()
    {
        $fields = [
            'name_en' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'description_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'itinerary_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'notes_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('tours', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tours', 'name_en');
        $this->forge->dropColumn('tours', 'description_en');
        $this->forge->dropColumn('tours', 'itinerary_en');
        $this->forge->dropColumn('tours', 'notes_en');
    }
}