<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;

class Validation extends ResourceController
{
    public function index()
    {
        $locale = $this->request->getGet('locale') ?? service('request')->getLocale(); // Lấy locale từ request hoặc dùng mặc định
        $messages = include APPPATH . "Language/{$locale}/validation.php"; // Load trực tiếp file ngôn ngữ

        return $this->respond([
            'status'   => 'success',
            'language' => $locale,
            'messages' => $messages,
        ]);
    }
}
