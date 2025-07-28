<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserPermissions extends Migration
{
    public function up()
    {
        // Bảng sys_permissions
        $this->forge->addField([
            'perm_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'perm_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'perm_desc' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('perm_id');
        $this->forge->createTable('sys_permissions');

        // Bảng sys_role_permissions
        $this->forge->addField([
            'role_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'perm_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addForeignKey('role_id', 'user_groups', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('perm_id', 'sys_permissions', 'perm_id', 'CASCADE', 'CASCADE');
        $this->forge->addPrimaryKey(['role_id', 'perm_id']);
        $this->forge->createTable('sys_role_permissions');

        // Bảng sys_user_permissions
        $this->forge->addField([
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'perm_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('perm_id', 'sys_permissions', 'perm_id', 'CASCADE', 'CASCADE');
        $this->forge->addPrimaryKey(['user_id', 'perm_id']);
        $this->forge->createTable('sys_user_permissions');
    }


    public function down()
    {
        $this->forge->dropTable('sys_user_permissions');
        $this->forge->dropTable('sys_role_permissions');
        $this->forge->dropTable('sys_permissions');
    }
}
