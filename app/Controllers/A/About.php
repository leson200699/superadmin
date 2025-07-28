<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AboutModel;
use Config\Services; // Import Services để dùng Redis cache

class About extends ResourceController
{
    protected $modelName = 'App\Models\AboutModel';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {
        // Lấy user_id từ request (có thể cần điều chỉnh tùy theo cách xác thực của bạn)
        $userId = $this->request->user ?? session()->get('user')->id ?? null;
        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        $cacheKey = "about_index_{$userId}";

        // Kiểm tra dữ liệu trong cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database
        $aboutPages = $this->model->where('author', $userId)->findAll();

        // Kiểm tra nếu không có dữ liệu
        if (empty($aboutPages)) {
            return $this->respond(['message' => 'No about pages found'], 200);
        }

        // Lưu vào cache trong 600 giây (10 phút)
        $this->cache->save($cacheKey, json_encode($aboutPages), 600);

        return $this->respond($aboutPages, 200);
    }

    public function show($id = null)
    {
        // Lấy user_id từ request
        $userId = $this->request->user ?? session()->get('user')->id ?? null;
        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        if (!$id) {
            return $this->failNotFound('About ID is required');
        }

        $cacheKey = "about_show_{$id}_{$userId}";

        // Kiểm tra dữ liệu trong cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database với điều kiện author trùng user_id
        $aboutPage = $this->model->where('author', $userId)
                                ->where('id', $id)
                                ->first();

        // Kiểm tra nếu không tìm thấy
        if (!$aboutPage) {
            return $this->failNotFound('About page not found or you do not have permission');
        }

        // Lưu vào cache trong 600 giây (10 phút)
        $this->cache->save($cacheKey, json_encode($aboutPage), 600);

        return $this->respond($aboutPage, 200);
    }
}