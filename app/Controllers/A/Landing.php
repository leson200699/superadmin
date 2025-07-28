<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Landing_Model;
use Config\Services;

class Landing extends ResourceController
{
    protected $modelName = 'App\Models\Landing_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {
        $userId = $this->request->user;
        $limit = $this->request->getGet('limit') ?? 8; // Mặc định 8 sản phẩm mỗi trang
        $offset = $this->request->getGet('offset') ?? 0; // Mặc định offset là 0
        $status = $this->request->getGet('status'); // Lấy tham số status nếu có
        $sort = $this->request->getGet('sort') ?? 'desc'; // Mặc định sắp xếp giảm dần
        $sortBy = $this->request->getGet('sort_by') ?? 'created_at'; // Mặc định sắp xếp theo created_at

        // Tạo cache key dựa trên các tham số
        $cacheKey = "landing_index_{$userId}_{$limit}_{$offset}_{$status}_{$sort}_{$sortBy}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Chuẩn bị truy vấn
        $this->model->where('author', $userId);
        
        if ($status !== null) {
            $this->model->where('status', $status);
        }

        // Sắp xếp
        $this->model->orderBy($sortBy, $sort);

        // Lấy dữ liệu với limit và offset
        $landing = $this->model->findAll($limit, $offset);
        
        // Lấy tổng số bản ghi để tính tổng số trang
        $total = $this->model->where('author', $userId)->countAllResults(false);

        // Dữ liệu trả về
        $response = [
            'data' => $landing,
            'total' => $total,
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'current_page' => (int)($offset / $limit) + 1,
            'total_pages' => ceil($total / $limit)
        ];

        // Lưu vào cache
        $this->cache->save($cacheKey, json_encode($response), 600);

        return $this->respond($response, 200);
    }

    public function detail($id)
    {
        $cacheKey = "landing_detail_{$id}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $landingModel = new Landing_Model();
        $landing = $landingModel->find($id);
        if (!$landing) {
            return $this->failNotFound('Landing không tồn tại.');
        }

        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $landing]), 600);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $landing,
        ]);
    }
}