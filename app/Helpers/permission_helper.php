<?php

use App\Models\PermissionModel;

if (!function_exists('hasPermission')) {
    function hasPermission($permission)
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return false;

        // Nếu là Super Admin (role = 1) thì có toàn quyền
        $userRole = is_array($user) ? ($user['role'] ?? 0) : ($user->role ?? 0);
        if ($userRole == 1) return true;

        $permModel = new \App\Models\PermissionModel();

        // Lấy danh sách quyền từ nhóm (RBAC)
        $rolePermissions = $permModel->getPermissionsByRole($userRole);

        // Lấy danh sách quyền riêng của user (PBAC)
        $userId = is_array($user) ? ($user['id'] ?? 0) : ($user->id ?? 0);
        $userPermissions = $permModel->getPermissionsByUser($userId);

        // Kiểm tra quyền của nhóm và user
        return in_array($permission, array_merge($rolePermissions, $userPermissions));
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return false;

        $userRole = is_array($user) ? ($user['role'] ?? 0) : ($user->role ?? 0);
        return $userRole == 1;
    }
}

if (!function_exists('isRegularUser')) {
    function isRegularUser()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return false;

        $userRole = is_array($user) ? ($user['role'] ?? 0) : ($user->role ?? 0);
        return $userRole == 2;
    }
}
