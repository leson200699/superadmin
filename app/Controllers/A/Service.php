<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Models\ServiceModel;
use App\Models\ServiceCategoryModel;

class Service extends ResourceController
{
    protected $modelName = 'App\Models\ServiceModel';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "service_list_" . $userId;

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $news = $this->model->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($news), 600);

        return $this->respond($news, 200);
    }

    public function service()
    {
        $serviceModel = new ServiceModel();
        $userId = $this->request->user;
        $cacheKey = "service_list_" . $userId;

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $service = $serviceModel->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($service), 600);

        return $this->respond($service, 200);
    }



public function byCategory($categoryId = null)
    {
        if (!$categoryId || !is_numeric($categoryId)) {
            return $this->fail('Valid Category ID is required', 400);
        }

        $locale = $this->request->getGet('locale') ?? 'vi';
        $userId = $this->request->user;
        $cacheKey = "services_by_cat_{$categoryId}_{$locale}_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        // Truyền cả $userId vào model
        $services = $this->model->getServicesByCategory($categoryId, $userId, $locale);

        if (empty($services)) {
            return $this->failNotFound('No services found for this category');
        }

        $this->cache->save($cacheKey, json_encode($services), 600);
        return $this->respond($services);
    }

    public function byCategoryAlias($alias = null)
    {
        if (!$alias) {
            return $this->fail('Category alias is required', 400);
        }

        $locale = $this->request->getGet('locale') ?? 'vi';
        $userId = $this->request->user;
        $cacheKey = "services_by_alias_{$alias}_{$locale}_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        // Truyền cả $userId vào model
        $services = $this->model->getServicesByCategoryAlias($alias, $userId, $locale);

        if (empty($services)) {
            return $this->failNotFound('No services found for this category alias');
        }

        $this->cache->save($cacheKey, json_encode($services), 600);
        return $this->respond($services);
    }


    public function show($identifier = null)
    {
        if (!$identifier) {
            return $this->fail('Service ID or alias is required', 400);
        }

        $locale = $this->request->getGet('locale') ?? 'vi';
        $userId = $this->request->user;
        $cacheKey = "service_detail_{$identifier}_{$locale}_{$userId}";

        // Kiểm tra cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        // Lấy chi tiết service từ model, hỗ trợ cả id và alias
        $service = $this->model->getServiceDetail($identifier, $userId, $locale);

        if (!$service) {
            return $this->failNotFound('Service not found');
        }

        // Lưu vào cache với TTL 600 giây
        $this->cache->save($cacheKey, json_encode($service), 600);
        return $this->respond($service, 200);
    }


    public function categories()
    {
        $locale = $this->request->getGet('locale') ?? 'vi';
        $userId = $this->request->user;
        $cacheKey = "service_categories_{$locale}_{$userId}";

        // Kiểm tra cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        // Khởi tạo ServiceCategoryModel
        $categoryModel = new ServiceCategoryModel();

        // Lấy danh sách danh mục theo userId và locale
        $categories = $categoryModel->getAllCategories($userId, $locale);

        if (empty($categories)) {
            return $this->failNotFound('No service categories found');
        }

        // Lưu vào cache với TTL 600 giây
        $this->cache->save($cacheKey, json_encode($categories), 600);
        return $this->respond($categories, 200);
    }

    
}
