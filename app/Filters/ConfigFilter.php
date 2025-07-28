<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Config_Model;

class ConfigFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Load ConfigModel
        $configModel = new Config_Model();

        // Lấy cấu hình từ database
        $configs = $configModel->getConfig();

        // Đảm bảo $configs là một mảng
        if (!$configs || !is_array($configs)) {
            $configs = [
                'logo' => '',
                'logo_footer' => '',
                'favicon' => '',
                'hotline' => '',
                'address' => ''
            ];
        }

        // Truyền toàn bộ mảng $configs vào view
        service('renderer')->setData($configs); // Không truyền 'configs' là chuỗi
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Không cần xử lý gì sau khi request
    }
}