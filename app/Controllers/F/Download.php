<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\News_Model;
use CodeIgniter\Controller;

class Download extends BaseFrontendController
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

        return view('F/' . $username . '/download', [
            'title' =>  'Download',
        ]);
    }
}
