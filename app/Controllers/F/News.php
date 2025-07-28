<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\News_Model;
use CodeIgniter\Controller;

class News extends BaseFrontendController
{
    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new News_Model();
    }

    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè
        $newsList = $this->newsModel->get_news_by_user($userId);

        return view('F/' . $username . '/news/index', [
            'newsList' => $newsList,
            'title' =>  'Danh sách tin tức',
        ]);
    }

    /**
     * Hiển thị chi tiết tin tức theo ID hoặc alias
     */
    public function detail($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $newsDetail = $this->newsModel->get_news_detail($identifier);

        if (!$newsDetail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tin tức không tồn tại");
        }

        // Lấy thêm tin liên quan nếu muốn
        $relatedNews = $this->newsModel->get_related_news($newsDetail['category_id'], $newsDetail['id']);

        return view('F/' . $username . '/news/detail', [
            'title' =>  $newsDetail['name'],
            'newsDetail' => $newsDetail,
            'relatedNews' => $relatedNews
        ]);
    }

    /**
     * Hiển thị danh sách tin tức theo danh mục (ID hoặc alias)
     */
    public function category($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $newsByCategory = $this->newsModel->get_news_by_category($identifier);

        if (empty($newsByCategory)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Không tìm thấy tin tức trong danh mục này");
        }

        return view('F/' . $username . '/news/category', [
            'newsByCategory' => $newsByCategory
        ]);
    }
}
