<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class PermissionModel extends Model
{
    protected $table = 'sys_permissions';
    protected $primaryKey = 'perm_id';
    protected $allowedFields = ['perm_name', 'perm_desc'];

    // Lấy tất cả quyền
    public function getAllPermissions()
    {
        return $this->findAll();
    }

    // Lấy quyền theo nhóm
        public function getPermissionsByRole($roleId)
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT p.perm_name FROM sys_permissions p
            JOIN sys_role_permissions rp ON rp.perm_id = p.perm_id
            WHERE rp.role_id = ?", [$roleId]);

        return array_column($query->getResultArray(), 'perm_name');
    }


    // Lấy quyền theo user
   public function getPermissionsByUser($userId)
{
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT p.perm_name FROM sys_permissions p
        JOIN sys_user_permissions up ON up.perm_id = p.perm_id
        WHERE up.user_id = ?", [$userId]);

    return array_column($query->getResultArray(), 'perm_name');
}


    // Gán quyền cho nhóm
    public function assignRolePermissions($roleId, $permissions)
    {
        $db = Database::connect();
        $db->table('sys_role_permissions')->where('role_id', $roleId)->delete(); // Xóa quyền cũ

        foreach ($permissions as $perm) {
            $permId = $this->where('perm_name', $perm)->first()['perm_id'];
            $db->table('sys_role_permissions')->insert([
                'role_id' => $roleId,
                'perm_id' => $permId
            ]);
        }

        return true;
    }

    // Gán quyền trực tiếp cho user
    public function assignUserPermissions($userId, $permissions)
    {
        $db = Database::connect();
        $db->table('sys_user_permissions')->where('user_id', $userId)->delete(); // Xóa quyền cũ

        foreach ($permissions as $perm) {
            $permId = $this->where('perm_name', $perm)->first()['perm_id'];
            $db->table('sys_user_permissions')->insert([
                'user_id' => $userId,
                'perm_id' => $permId
            ]);
        }

        return true;
    }
}
