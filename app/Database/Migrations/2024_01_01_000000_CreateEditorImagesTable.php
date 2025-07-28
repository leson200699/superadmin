<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEditorImagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_url' => [
                'type'       => 'TEXT',
            ],
            'file_size' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'upload_date' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey('upload_date');
        
        $this->forge->createTable('editor_images');
    }

    public function down()
    {
        $this->forge->dropTable('editor_images');
    }
}
