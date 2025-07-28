<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Project_Model;
use App\Models\Province_Model;
use App\Models\District_Model;
use App\Models\Ward_Model;
use Config\Services; // Import Services để dùng Redis cache

class Project extends ResourceController
{
    protected $modelName = 'App\Models\Project_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "project_index_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $news = $this->model->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($news), 600);

        return $this->respond($news, 200);
    }

    public function index2()
    {   
        $userId = $this->request->user;
        $cacheKey = "project_index2_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $projectModel  = new Project_Model();
        $provinceModel = new Province_Model();
        $districtModel = new District_Model();
        $wardModel     = new Ward_Model();

        $type        = $this->request->getGet('type');
        $province_id = $this->request->getGet('province_id');
        $district_id = $this->request->getGet('district_id');
        $ward_id     = $this->request->getGet('ward_id');
        $price_range = $this->request->getGet('price_range');

        $query = $projectModel->where('author', $userId);

        if ($type) $query = $query->where('type', $type);
        if ($province_id) $query = $query->where('province_id', $province_id);
        if ($district_id) $query = $query->where('district_id', $district_id);
        if ($ward_id) $query = $query->where('ward_id', $ward_id);
        if ($price_range) {
            $priceBounds = explode('-', $price_range);
            if (count($priceBounds) == 2) {
                $query = $query->where('price >=', $priceBounds[0])->where('price <=', $priceBounds[1]);
            } elseif (!empty($priceBounds[0])) {
                $query = $query->where('price >=', $priceBounds[0]);
            }
        }

        $projects = $query->findAll();

        foreach ($projects as &$project) {
            $project['province'] = $provinceModel->find($project['province_id'])['name'] ?? 'Không xác định';
            $project['district'] = $districtModel->find($project['district_id'])['name'] ?? 'Không xác định';
            $project['ward']     = $wardModel->find($project['ward_id'])['name'] ?? 'Không xác định';
        }

        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $projects]), 600);

        return $this->response->setJSON([
            'status'  => 'success',
            'data'    => $projects,
        ]);
    }

    public function detail($id)
    {
        $cacheKey = "project_detail_{$id}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $projectModel  = new Project_Model();
        $provinceModel = new Province_Model();
        $districtModel = new District_Model();
        $wardModel     = new Ward_Model();

        $project = $projectModel->find($id);
        if (!$project) {
            return $this->failNotFound('Dự án không tồn tại.');
        }

        $project['province'] = $provinceModel->find($project['province_id'])['name'] ?? 'Không xác định';
        $project['district'] = $districtModel->find($project['district_id'])['name'] ?? 'Không xác định';
        $project['ward']     = $wardModel->find($project['ward_id'])['name'] ?? 'Không xác định';

        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $project]), 600);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $project,
        ]);
    }

    public function detailByAlias($alias)
    {
        $cacheKey = "project_detail_alias_{$alias}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $projectModel  = new Project_Model();
        $provinceModel = new Province_Model();
        $districtModel = new District_Model();
        $wardModel     = new Ward_Model();

        $project = $projectModel->where('alias', $alias)->first();
        if (!$project) {
            return $this->failNotFound('Dự án không tồn tại.');
        }

        $project['province'] = $provinceModel->find($project['province_id'])['name'] ?? 'Không xác định';
        $project['district'] = $districtModel->find($project['district_id'])['name'] ?? 'Không xác định';
        $project['ward']     = $wardModel->find($project['ward_id'])['name'] ?? 'Không xác định';

        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $project]), 600);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $project,
        ]);
    }
}
