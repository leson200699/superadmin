<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHotAndDiscountToTours extends Migration
{
    public function up()
    {
        $fields = [
            'is_hot' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0, // 1: tour hot, 0: không phải tour hot
            ],
            'discount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00, // Phần trăm giảm giá, ví dụ: 10.00 = 10%
            ],
        ];
        $this->forge->addColumn('tours', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tours', 'is_hot');
        $this->forge->dropColumn('tours', 'discount');
    }
}