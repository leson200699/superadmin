<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTourSchedulesTable extends Migration
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
            'day_number' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'schedule' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tour_id', 'tours', 'id');
        $this->forge->createTable('tour_schedules');
    }

    public function down()
    {
        $this->forge->dropTable('tour_schedules');
    }
}