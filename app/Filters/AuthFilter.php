<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeader("Authorization");

        if (!$header) {
            return response()->setStatusCode(401)->setJSON(['error' => 'Token missing']);
        }

        try {
            $token = explode(' ', $header->getValue())[1];
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
        } catch (\Exception $e) {
            return response()->setStatusCode(401)->setJSON(['error' => 'Invalid token']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
