<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\User_Model;

class SubdomainUserFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $mainDomains = ['localhost', 'admin.amx.vn', 'www.admin.amx.vn'];

        if (in_array($host, $mainDomains) || strpos($host, '.') === false) {
            return; // domain chính, không phải subdomain user
        }

        $parts = explode('.', $host);
        if (count($parts) < 3) {
            return; // domain không hợp lệ
        }

        $subdomain = $parts[0];

        // Check user
        $userModel = new User_Model();
        $user = $userModel->getRowData('username', $subdomain);

        if (!$user) {
            return redirect()->to('/user-not-found');
        }

        // Nếu muốn gán luôn user info vào session hoặc Services, có thể làm thêm ở đây
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // không cần xử lý sau response
    }
}
