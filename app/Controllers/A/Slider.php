<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Models\Slideshow_Model;

class Slider extends ResourceController
{
    protected $modelName = 'App\\Models\\Slideshow_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "slider_list_" . $userId;

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        $slider = $this->model->getSlideshows($userId);
        $this->cache->save($cacheKey, json_encode($slider), 600);

        return $this->respond($slider, 200);
    }
}
