<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!session()->has('user')) {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Không cần thực hiện gì sau khi request
    }
}
