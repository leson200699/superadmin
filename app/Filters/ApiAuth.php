<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\ApiKeyModel;

class ApiAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $apiKey = $request->getHeaderLine('AMX-API-KEY');

        if (!$apiKey) {
            return response()->setJSON(["message" => "Thiếu API Key"])->setStatusCode(401);
        }

        $apiKeyModel = new ApiKeyModel();
        $key = $apiKeyModel->where('api_key', $apiKey)->where('status', 1)->first();

        if (!$key) {
            return response()->setJSON(["message" => "API Key không hợp lệ"])->setStatusCode(403);
        }

        // Kiểm tra và lấy giá trị user_id đúng cách
        // Nếu $key là mảng, lấy user_id bằng cách truy cập trực tiếp vào mảng.
        if (is_array($key)) {
            $userId = $key['user_id'];
        } else {
            // Nếu $key là đối tượng, lấy user_id thông qua thuộc tính đối tượng.
            $userId = $key->user_id;
        }

        // Lưu user_id vào request để sử dụng trong controller
        $request->user = $userId;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
