<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\News_Model;
use CodeIgniter\Controller;

class Gallery extends BaseFrontendController
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

        return view('F/' . $username . '/gallery', [
            'title' =>  'Danh sách tin tức',
        ]);
    }
}
