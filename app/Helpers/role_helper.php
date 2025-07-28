<?php

if (!function_exists('getUserRole')) {
    function getUserRole()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return 0;

        return is_array($user) ? ($user['role'] ?? 0) : ($user->role ?? 0);
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        return getUserRole() == 1;
    }
}

if (!function_exists('isRegularUser')) {
    function isRegularUser()
    {
        return getUserRole() == 2;
    }
}

if (!function_exists('hasRole')) {
    function hasRole($role)
    {
        return getUserRole() == $role;
    }
}

if (!function_exists('hasAnyRole')) {
    function hasAnyRole($roles)
    {
        $userRole = getUserRole();
        return in_array($userRole, (array) $roles);
    }
}

if (!function_exists('getRoleName')) {
    function getRoleName($role = null)
    {
        if ($role === null) {
            $role = getUserRole();
        }

        $roleNames = [
            0 => 'Không xác định',
            1 => 'Super Admin',
            2 => 'User thường'
        ];

        return $roleNames[$role] ?? 'Không xác định';
    }
}

if (!function_exists('getCurrentUserRoleName')) {
    function getCurrentUserRoleName()
    {
        return getRoleName(getUserRole());
    }
} 