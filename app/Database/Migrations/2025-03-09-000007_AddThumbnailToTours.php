<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddThumbnailToTours extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tours', [
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'location'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tours', 'thumbnail');
    }
}