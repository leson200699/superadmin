<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('session_helper');

        $user = get_session_data('user');
        log_message('debug', 'USER FILTER user: ' . print_r($user, true));
        
        // Kiểm tra nếu user chưa đăng nhập
        if (empty($user)) {
            log_message('debug', 'USER FILTER: user is empty, redirect login');
            return redirect()->route('admin-auth-login');
        }
        
        // Kiểm tra nếu user có role hợp lệ (1 = superadmin, 2 = user thường)
        $userRole = is_array($user) ? ($user['role'] ?? 0) : ($user->role ?? 0);
        log_message('debug', 'USER FILTER user_role: ' . $userRole);
        
        if (!in_array($userRole, [1, 2])) {
            log_message('debug', 'USER FILTER: user has invalid role, redirect login');
            return redirect()->route('admin-auth-login')->with('error', 'Tài khoản không hợp lệ.');
        }
        
        // Nếu đã đăng nhập và có role hợp lệ thì cho phép truy cập
        log_message('debug', 'USER FILTER: user has valid role, allow access');
        return;
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
} 