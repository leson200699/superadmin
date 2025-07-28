<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Config_Model;
use Config\Services; // Import Services để dùng Redis cache

class Config extends ResourceController
{
    protected $modelName = 'App\Models\Config_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "config_index_{$userId}";

        // Kiểm tra dữ liệu trong cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database
        $config = $this->model->where('author', $userId)->findAll();

        // Lưu vào cache trong 600 giây (10 phút)
        $this->cache->save($cacheKey, json_encode($config), 600);

        return $this->respond($config, 200);
    }
}
