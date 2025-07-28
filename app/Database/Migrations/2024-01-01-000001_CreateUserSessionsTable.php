<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserSessionsTable extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'access_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'mobile_no' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'sex' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'role' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => true,
            ],
            'is_verify' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'is_admin' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'is_visible' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => true,
            ],
            'is_deletable' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'null' => true,
            ],
            'last_ip' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'expires' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('access_token', false, true); // Unique key
        $this->forge->addKey('user_id', false, false);
        $this->forge->addKey('expires', false, false);

        $this->forge->createTable('user_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('user_sessions');
    }
} 