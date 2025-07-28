<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (empty($token) && $request->getCookie('jwt_token')) {
            $token = $request->getCookie('jwt_token');
        }

        if (empty($token)) {
            $redirectUrl = urlencode(current_url());  // Lấy URL hiện tại để gửi làm parameter
            return redirect()->to('http://id.amx.vn/auth/login?redirect=' . $redirectUrl);
        }

        try {
            $key = env('JWT_SECRET', 'your-secret-key');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $request->user = $decoded;

            if (in_array('super_admin', $arguments) && $decoded->role !== 'super_admin') {
                return redirect()->to('http://id.amx.vn/auth/login?redirect=' . urlencode(current_url()))->with('error', 'Access denied');
            }
        } catch (\Exception $e) {
            return redirect()->to('http://id.amx.vn/auth/login?redirect=' . urlencode(current_url()));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Không cần xử lý sau
    }
}