<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PartnerModel;
use Config\Services; // Import Services để dùng Redis cache

class Partner extends ResourceController
{
    protected $modelName = 'App\Models\PartnerModel';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {

        $userId = $this->request->user ?? session()->get('user')->id ?? null;
        
        if (!$userId) {
            return $this->failUnauthorized('User ID is required');
        }

        $cacheKey = "partner_index_{$userId}";

        // Kiểm tra dữ liệu trong cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database
        $partners = $this->model->get_partner_by_user($userId);
        // Kiểm tra nếu không có dữ liệu
        if (empty($partners)) {
            return $this->respond(['message' => 'No partners found'], 200);
        }

        // Lưu vào cache trong 600 giây (10 phút)
        $this->cache->save($cacheKey, json_encode($partners), 600);

        return $this->respond($partners, 200);
    }

    public function show($id = null)
    {
        // Lấy user_id từ request hoặc session
        $userId = $this->request->user ?? session()->get('user')->id ?? null;
        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        if (!$id) {
            return $this->failNotFound('Partner ID is required');
        }

        $cacheKey = "partner_show_{$id}_{$userId}";

        // Kiểm tra dữ liệu trong cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database với điều kiện author trùng user_id
        $partner = $this->model->where('author', $userId)
                              ->where('id', $id)
                              ->first();

        // Kiểm tra nếu không tìm thấy
        if (!$partner) {
            return $this->failNotFound('Partner not found or you do not have permission');
        }

        // Lưu vào cache trong 600 giây (10 phút)
        $this->cache->save($cacheKey, json_encode($partner), 600);

        return $this->respond($partner, 200);
    }
}