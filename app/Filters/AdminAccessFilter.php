<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('session_helper');

        // Use the safe user data getter
        $user = get_user_data();
        
        // Log filter execution
        log_message('debug', 'AdminAccessFilter executing');
        
        // If no user data exists in session, redirect to login
        if (empty($user)) {
            log_message('debug', 'FILTER: No user session data found, redirecting to login');
            return redirect()->route('admin-auth-login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        
        // Get user role with safe method
        $userRole = get_user_role();
        log_message('debug', 'FILTER user_role: ' . $userRole);
        
        // Check if user has valid role
        if (!in_array($userRole, [1, 2])) {
            log_message('debug', 'FILTER: User has invalid role, redirecting to login');
            return redirect()->route('admin-auth-login')->with('error', 'Tài khoản không có quyền truy cập.');
        }
        
        // Allow access if user is authenticated with valid role
        log_message('debug', 'FILTER: User authentication successful, allowing access');
        return;
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
