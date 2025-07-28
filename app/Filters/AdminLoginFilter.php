<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('session_helper');

        // Use safe getter method
        $user = get_user_data();
        log_message('debug', 'AdminLoginFilter executing');

        // If user is already logged in, redirect to dashboard
        if (!empty($user)) {
            // Get user role with safe method
            $userRole = get_user_role();
            log_message('debug', 'FILTER user_role in login filter: ' . $userRole);
            
            // If user has valid role, redirect to dashboard
            if (in_array($userRole, [1, 2])) {
                log_message('debug', 'FILTER: User already authenticated, redirecting to dashboard');
                return redirect()->route('dashboard');
            }
        }
        
        // Continue to login page if user is not authenticated
        return;
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
