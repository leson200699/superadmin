<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Quản lý người dùng
            ['perm_name' => 'view_users', 'perm_desc' => 'Xem danh sách người dùng'],
            ['perm_name' => 'create_users', 'perm_desc' => 'Tạo người dùng mới'],
            ['perm_name' => 'edit_users', 'perm_desc' => 'Chỉnh sửa thông tin người dùng'],
            ['perm_name' => 'delete_users', 'perm_desc' => 'Xóa người dùng'],
            
            // Quản lý quyền
            ['perm_name' => 'manage_permissions', 'perm_desc' => 'Quản lý quyền hệ thống'],
            ['perm_name' => 'manage_roles', 'perm_desc' => 'Quản lý vai trò'],
            ['perm_name' => 'assign_permissions', 'perm_desc' => 'Gán quyền cho người dùng/nhóm'],
            
            // Quản lý nội dung
            ['perm_name' => 'manage_content', 'perm_desc' => 'Quản lý nội dung website'],
            ['perm_name' => 'manage_news', 'perm_desc' => 'Quản lý tin tức'],
            ['perm_name' => 'manage_products', 'perm_desc' => 'Quản lý sản phẩm'],
            ['perm_name' => 'manage_services', 'perm_desc' => 'Quản lý dịch vụ'],
            ['perm_name' => 'manage_tours', 'perm_desc' => 'Quản lý tour du lịch'],
            ['perm_name' => 'manage_cars', 'perm_desc' => 'Quản lý xe'],
            
            // Quản lý hệ thống
            ['perm_name' => 'manage_system', 'perm_desc' => 'Quản lý cấu hình hệ thống'],
            ['perm_name' => 'manage_backup', 'perm_desc' => 'Quản lý sao lưu'],
            ['perm_name' => 'view_logs', 'perm_desc' => 'Xem log hệ thống'],
            
            // Quản lý đặt hàng/booking
            ['perm_name' => 'manage_bookings', 'perm_desc' => 'Quản lý đặt hàng'],
            ['perm_name' => 'view_bookings', 'perm_desc' => 'Xem đặt hàng'],
            
            // Quản lý khách hàng
            ['perm_name' => 'manage_customers', 'perm_desc' => 'Quản lý khách hàng'],
            ['perm_name' => 'view_customer_messages', 'perm_desc' => 'Xem tin nhắn khách hàng'],
            
            // Quản lý file
            ['perm_name' => 'manage_files', 'perm_desc' => 'Quản lý file'],
            ['perm_name' => 'upload_files', 'perm_desc' => 'Upload file'],
            ['perm_name' => 'delete_files', 'perm_desc' => 'Xóa file'],
        ];

        // Thêm permissions vào bảng sys_permissions
        $this->db->table('sys_permissions')->insertBatch($permissions);

        // Gán tất cả quyền cho Super Admin (role = 1)
        $superAdminPermissions = array_column($permissions, 'perm_name');
        $permModel = new \App\Models\PermissionModel();
        $permModel->assignRolePermissions(1, $superAdminPermissions);

        // Gán một số quyền cơ bản cho User thường (role = 2)
        $regularUserPermissions = [
            'view_users',
            'manage_content',
            'manage_news',
            'manage_products',
            'manage_services',
            'manage_tours',
            'manage_cars',
            'view_bookings',
            'manage_customers',
            'view_customer_messages',
            'manage_files',
            'upload_files'
        ];
        $permModel->assignRolePermissions(2, $regularUserPermissions);
    }
} 