<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSectionsTable extends Migration
{
    public function up()
    {
        // Thêm các cột liên kết vào bảng sections
        $this->forge->addColumn('sections', [
            'entity_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'Loại thực thể: car, news, product, custom'
            ],
            'entity_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'comment' => 'ID của thực thể liên kết'
            ],
        ]);
    }

    public function down()
    {
        // Xóa các cột khi rollback
        $this->forge->dropColumn('sections', 'entity_type');
        $this->forge->dropColumn('sections', 'entity_id');
    }
} 