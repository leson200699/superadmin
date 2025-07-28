<?php
namespace App\Controllers\A;

use App\Controllers\BaseController;
use App\Models\VideoModel;
use CodeIgniter\API\ResponseTrait;

class VideoApi extends BaseController
{
    use ResponseTrait;

    protected $videoModel;
    protected $cache;

    public function __construct()
    {
        $this->videoModel = new VideoModel();
        $this->cache = \Config\Services::cache();
    }

    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = $this->request->getGet('per_page') ?? 10;
        $cacheKey = "videos_list_page_{$page}_perpage_{$perPage}";

        $videos = $this->cache->get($cacheKey);
        if (!$videos) {
            $videos = $this->videoModel->getVideos($perPage, $page);
            $this->cache->save($cacheKey, $videos, 3600);
        }

        return $this->respond([
            'status' => 'success',
            'data' => $videos,
            'pager' => $this->videoModel->pager->getDetails()
        ]);
    }

    public function show($id)
    {
        $cacheKey = "video_{$id}";
        $video = $this->cache->get($cacheKey);

        if (!$video) {
            $video = $this->videoModel->getVideoById($id);
            if (!$video) {
                return $this->failNotFound('Video not found');
            }
            $this->cache->save($cacheKey, $video, 3600);
        }

        return $this->respond([
            'status' => 'success',
            'data' => $video
        ]);
    }
}