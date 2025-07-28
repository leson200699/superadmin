<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsDomesticToTourCategories extends Migration
{
    public function up()
    {
        $fields = [
            'is_domestic' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1, // 1: trong nước, 0: quốc tế
            ],
        ];
        $this->forge->addColumn('tourcategories', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tourcategories', 'is_domestic');
    }
}