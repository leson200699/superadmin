<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Team_Member_Model;
use Config\Services;

class Team extends ResourceController
{
    protected $modelName = 'App\Models\Team_Member_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Sử dụng Redis cache
    }

    // Lấy danh sách team members của user
    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "team_index_{$userId}";

        // Kiểm tra cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Truy vấn database nếu không có cache
        $teamMembers = $this->model->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($teamMembers), 600);

        return $this->respond($teamMembers, 200);
    }

    // Lấy chi tiết team member theo ID
    public function detail($id)
    {
        $cacheKey = "team_detail_{$id}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $teamMember = $this->model->find($id);
        if (!$teamMember) {
            return $this->failNotFound('Team member không tồn tại.');
        }

        $this->cache->save($cacheKey, json_encode($teamMember), 600);
        return $this->respond($teamMember, 200);
    }
}