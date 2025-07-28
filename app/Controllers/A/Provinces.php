<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Models\Province_Model;
use App\Models\District_Model;
use App\Models\Ward_Model;

class Provinces extends ResourceController
{
    protected $format = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function provinces()
    {
        $cacheKey = "provinces_list";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $model = new Province_Model();
        $provinces = $model->where('status', 1)->findAll();
        $this->cache->save($cacheKey, json_encode($provinces), 600);

        return $this->respond($provinces, 200);
    }

    public function districts()
    {
        $province_id = $this->request->getGet('province_id');
        $cacheKey = "districts_list_" . ($province_id ?: 'all');

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $model = new District_Model();
        if ($province_id) {
            $districts = $model->where('status', 1)->where('province_id', $province_id)->findAll();
        } else {
            $districts = $model->where('status', 1)->findAll();
        }
        $this->cache->save($cacheKey, json_encode($districts), 600);

        return $this->respond($districts, 200);
    }

    public function wards()
    {
        $district_id = $this->request->getGet('district_id');
        $cacheKey = "wards_list_" . ($district_id ?: 'all');

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $model = new Ward_Model();
        if ($district_id) {
            $wards = $model->where('status', 1)->where('district_id', $district_id)->findAll();
        } else {
            $wards = $model->where('status', 1)->findAll();
        }
        $this->cache->save($cacheKey, json_encode($wards), 600);

        return $this->respond($wards, 200);
    }
}