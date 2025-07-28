<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\ServiceModel;
use CodeIgniter\Controller;

class Service extends BaseFrontendController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {   
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè
        $serviceList = $this->serviceModel->get_services_by_user($userId);

        return view('F/' . $username . '/services/index', [
            'serviceList' => $serviceList,
            'title' =>  'Danh sách tin tức',
        ]);
    }

    /**
     * Hiển thị chi tiết tin tức theo ID hoặc alias
     */
    public function detail($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $userId = $this->user['id'];
        $servicesDetail = $this->serviceModel->getServiceDetail($identifier, $userId);

        if (!$servicesDetail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tin tức không tồn tại");
        }

        // Lấy thêm tin liên quan nếu muốn
        //$relatedNews = $this->serviceModel->get_related_news($newsDetail['category_id'], $newsDetail['id']);

        return view('F/' . $username . '/services/services_detail', [
            'title' =>  $servicesDetail['name'],
            'servicesDetail' => $servicesDetail,
            //'relatedServices' => $relatedNews
        ]);
    }

    /**
     * Hiển thị danh sách tin tức theo danh mục (ID hoặc alias)
     */
    public function category($identifier)
    {   
        $username = $this->user['username']; // <- lấy username nè
        $userId = $this->user['id'];
        $servicesByCategory = $this->serviceModel->getServicesByCategory($identifier, $userId);

        if (empty($servicesByCategory)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Không tìm thấy tin tức trong danh mục này");
        }

        return view('F/' . $username . '/services/category', [
            'servicesByCategory' => $servicesByCategory,
            'title' => 'Services',
        ]);
    }
}
