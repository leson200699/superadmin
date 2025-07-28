<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LanguageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Lấy ngôn ngữ từ Session
        $locale = session()->get('locale');

        // Nếu không có trong session, sử dụng ngôn ngữ mặc định
        if (!$locale || !in_array($locale, ['en', 'vi'])) {
            $locale = 'vi'; // Ngôn ngữ mặc định
        }

        // Đặt ngôn ngữ cho ứng dụng
        service('request')->setLocale($locale);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Không cần xử lý gì thêm sau
    }
}
