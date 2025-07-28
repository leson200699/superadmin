<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use Config\Services;

class ClearCache extends BaseController
{
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function user($userId)
    {
        if (empty($userId) || !is_numeric($userId)) {
            return redirect()->back()->with('error', 'User ID không hợp lệ.');
        }

        // Các key cache bạn đã lưu
        $keys = [
            "frontend_settings_{$userId}",
            "frontend_menu_{$userId}",
        ];

        foreach ($keys as $key) {
            $this->cache->delete($key);
        }

        return redirect()->back()->with('success', "Đã clear cache thành công cho user ID: {$userId}");
    }
}
