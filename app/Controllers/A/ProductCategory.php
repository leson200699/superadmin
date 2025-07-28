<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Product_Category_Model;
use Config\Services;

class ProductCategory extends ResourceController
{
    protected $modelName = 'App\Models\Product_Category_Model';
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
            return $this->failUnauthorized('User not authenticated');
        }

        $cacheKey = "product_category_index_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $categories = $this->model->where('author', $userId)->findAll();

        if (empty($categories)) {
            return $this->respond(['message' => 'No product categories found'], 200);
        }

        $this->cache->save($cacheKey, json_encode($categories), 600);

        return $this->respond($categories, 200);
    }

    public function show($id = null)
    {
        $userId = $this->request->user ?? session()->get('user')->id ?? null;
        if (!$userId) {
            return $this->failUnauthorized('User not authenticated');
        }

        if (!$id) {
            return $this->failNotFound('Category ID is required');
        }

        $cacheKey = "product_category_show_{$id}_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Lấy thông tin danh mục chính
        $category = $this->model->where('author', $userId)
                               ->where('id', $id)
                               ->first();

        if (!$category) {
            return $this->failNotFound('Product category not found or you do not have permission');
        }

        // Lấy danh sách danh mục con
        $subcategories = $this->model->where('author', $userId)
                                    ->where('parent_id', $id)
                                    ->findAll();

        // Gộp danh mục con vào dữ liệu danh mục chính
        $category->subcategories = $subcategories ?: []; // Nếu không có danh mục con, trả về mảng rỗng

        // Lưu vào cache
        $this->cache->save($cacheKey, json_encode($category), 600);

        return $this->respond($category, 200);
    }
}