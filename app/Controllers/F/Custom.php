<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Landing_Model;
use App\Models\News_Model;
use CodeIgniter\Controller;

class Custom extends BaseFrontendController
{
    protected $landingModel;
    protected $cache;

    public function __construct()
    {
        $this->landingModel = new Landing_Model();
        $this->cache = Services::cache();
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    // Hiển thị danh sách landing
    public function index()
    {
    	$data['landing'] = $this->landingModel->find($id);
        return view('B/pages/custom/show', $data);
    }

    // Hiển thị chi tiết landing
    public function detail($identifier)
    {
        $userId = $this->user['id'];
        $news_model = new News_Model();
        $username = $this->user['username'];
        $news = $news_model->get_news_by_user($userId);
        $customDetail = $this->landingModel->getLandingLocaleByAlias($identifier);
        $id = $customDetail['id'];
        $sectionModel = new \App\Models\LandingSection_Model();
        $customDetail['sections'] = $sectionModel->where('landing_id', $id)->findAll();

        if (!$customDetail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tin tức không tồn tại");
        }

        if ($customDetail) {
            $customDetail['images'] = !empty($customDetail['multiple_image']) ? explode(',', $customDetail['multiple_image']) : [];
        }

        return view('F/' . $username . '/custom/'.$identifier, [
            'title' =>  $customDetail['name'],
            'customDetail' => $customDetail,
            'images'     => $customDetail['images'],
            'username' => $username,
            'news' => $news,
        ]);
    }

  
}
