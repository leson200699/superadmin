<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Project_Model;
use CodeIgniter\Controller;

class Project extends BaseFrontendController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new Project_Model();
    }

    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {   
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè
        $projectList = $this->projectModel->getAllProjectsByUser($userId);

        return view('F/' . $username . '/projects/index', [
            'projectList' => $projectList,
            'title' =>  'Danh sách tin tức',
        ]);
    }

    /**
     * Hiển thị chi tiết tin tức theo ID hoặc alias
     */
    public function detail($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $projectDetail = $this->projectModel->get_project_detail($identifier);

        if (!$projectDetail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tin tức không tồn tại");
        }

        // Lấy thêm tin liên quan nếu muốn
        //$relatedNews = $this->serviceModel->get_related_news($newsDetail['category_id'], $newsDetail['id']);

        return view('F/' . $username . '/projects/detail', [
            'title' =>  $projectDetail->name,
            'projectDetail' => $projectDetail,
        ]);
    }

    /**
     * Hiển thị danh sách tin tức theo danh mục (ID hoặc alias)
     */
    public function category($identifier)
    {
        $newsByCategory = $this->serviceModel->get_news_by_category($identifier);

        if (empty($newsByCategory)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Không tìm thấy tin tức trong danh mục này");
        }

        return view('F/' . $username . '/news/category', [
            'newsByCategory' => $newsByCategory
        ]);
    }
}
