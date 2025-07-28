<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Testimonial_Model;
use Config\Services;

class Testimonial extends ResourceController
{
    protected $modelName = 'App\Models\Testimonial_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Sử dụng Redis cache
    }

    // Lấy danh sách testimonials của user
    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "testimonial_index_{$userId}";

        // Kiểm tra cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database nếu không có cache
        $testimonials = $this->model->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($testimonials), 600);

        return $this->respond($testimonials, 200);
    }

    // Lấy chi tiết testimonial theo ID
    public function detail($id)
    {
        $cacheKey = "testimonial_detail_{$id}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $testimonial = $this->model->find($id);
        if (!$testimonial) {
            return $this->failNotFound('Testimonial không tồn tại.');
        }

        $this->cache->save($cacheKey, json_encode($testimonial), 600);
        return $this->respond($testimonial, 200);
    }
}
