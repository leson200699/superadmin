<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEnglishToTourSchedules extends Migration
{
    public function up()
    {
        $fields = [
            'schedule_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];
        $this->forge->addColumn('tour_schedules', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tour_schedules', 'schedule_en');
    }
}