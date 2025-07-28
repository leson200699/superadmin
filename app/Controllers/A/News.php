<?php
namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\News_Model;
use App\Models\News_Category_Model;
use Config\Services;

class News extends ResourceController
{
    protected $modelName = 'App\Models\News_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userId = $this->request->user;
        $limit = max(1, min(100, $this->request->getGet('limit', FILTER_SANITIZE_NUMBER_INT) ?? 1000));
        $cacheKey = "news_index_{$userId}_{$limit}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $news = $this->model->get_news_by_user($userId);
        $news = array_slice($news, 0, $limit);

        $this->cache->save($cacheKey, json_encode($news), 600);
        return $this->respond($news, 200);
    }

    public function category()
    {
        $userId = $this->request->user;
        $cacheKey = "news_category_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $categoryModel = new News_Category_Model();
        $category = $categoryModel->get_news_category_id($userId);

        $this->cache->save($cacheKey, json_encode($category), 600);
        return $this->respond($category, 200);
    }

    public function news($identifier)
    {
        log_message('debug', "Calling news with identifier: {$identifier}");
        $cacheKey = "news_detail_{$identifier}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $news = $this->model->get_news_detail($identifier);
        if (!$news) {
            return $this->failNotFound('Tin tức không tồn tại.');
        }

        $this->cache->save($cacheKey, json_encode($news), 600);
        return $this->respond($news, 200);
    }

    public function newsByCategory($identifier)
    {
        $userId = $this->request->user;
        $limit = max(1, min(100, $this->request->getGet('limit', FILTER_SANITIZE_NUMBER_INT) ?? 10));
        $excludeLatest = $this->request->getGet('exclude_latest', FILTER_VALIDATE_BOOLEAN) ?? false;
        $cacheKey = "news_by_category_{$identifier}_{$userId}_{$limit}_" . ($excludeLatest ? 'exclude' : 'include');

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Lấy thông tin danh mục
        $categoryModel = new News_Category_Model();
        $isNumeric = is_numeric($identifier);
        $category = $isNumeric 
            ? $categoryModel->find($identifier) 
            : $categoryModel->where('alias', $identifier)->first();

        if (!$category) {
            return $this->failNotFound('Danh mục không tồn tại.');
        }

        // Lấy danh sách tin tức
        $newsList = $this->model->get_news_by_category($identifier, $userId, $limit, $excludeLatest);

        $response = [
            'category' => [
                'id' => $category['id'],
                'name' => $category['name'],
                'alias' => $category['alias'],
                'description' => $category['description'] ?? null
            ],
            'news' => $newsList,
            'message' => empty($newsList) ? 'Không có tin tức trong danh mục này.' : null
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function relatedNews($identifier)
    {
        $limit = max(1, min(50, $this->request->getGet('limit', FILTER_SANITIZE_NUMBER_INT) ?? 5));
        $cacheKey = "news_related_{$identifier}_{$limit}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $news = $this->model->get_news_detail($identifier);
        if (!$news) {
            return $this->failNotFound('Tin tức không tồn tại.');
        }

        $relatedNews = $this->model->get_related_news($news['category_id'], $news['id'], $limit);

        $this->cache->save($cacheKey, json_encode($relatedNews), 600);
        return $this->respond($relatedNews, 200);
    }

    public function search()
    {
        $userId = $this->request->user;
        $query = $this->request->getGet('q');
        $limit = max(1, min(100, $this->request->getGet('limit', FILTER_SANITIZE_NUMBER_INT) ?? 10));
        
        if (empty($query)) {
            return $this->respond(['message' => 'Không có từ khóa tìm kiếm'], 200);
        }

        $queryNumbers = preg_replace('/\D/', '', $query);
        if (strlen($queryNumbers) < 3) {
            return $this->respond(['message' => 'Từ khóa quá ngắn'], 200);
        }

        $cacheKey = "news_search_{$userId}_{$queryNumbers}_{$limit}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $builder = $this->model->where('author', $userId);
        $where = [];
        for ($i = 0; $i <= strlen($queryNumbers) - 3; $i++) {
            $where[] = "name LIKE '%" . substr($queryNumbers, $i, 3) . "%'";
        }
        $builder->where('(' . implode(' OR ', $where) . ')');
        $news = $builder->findAll($limit);

        $this->cache->save($cacheKey, json_encode($news), 600);
        return $this->respond($news, 200);
    }
}