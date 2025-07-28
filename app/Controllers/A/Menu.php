<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Menu_Model;
use App\Models\Landing_Model;
use Config\Services; // Import Services để dùng Redis cache

class Menu extends ResourceController
{
    protected $format = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function index()
    {
        $menuModel = new Menu_Model();
        $landingModel = new Landing_Model();

        $locale = service('request')->getLocale();
        $letgo = $landingModel->getLandingLocaleById(15, $locale);

        // Lấy userId từ request (hoặc session nếu cần)
        $userId = $this->request->user;
        
        if (!$userId) {
            return $this->failUnauthorized('User ID is required');
        }

        $cacheKey = "menu_index_{$userId}_{$locale}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true));
        }

        // Lấy menu theo user_id
        $menus = $menuModel->getAllMenus($userId);
        
 
        // Thêm 'display_name' theo ngôn ngữ
        foreach ($menus as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
        }

        // Lọc menu theo display_location
        $headerMenus = array_filter($menus, fn($menu) => $menu['display_location'] === 'header');
        $footerMenus = array_filter($menus, fn($menu) => $menu['display_location'] === 'footer');

        // Xây dựng cây menu
        helper('menu');
        $headerMenuTree = buildMenuTree($headerMenus);
        $footerMenuTree = buildMenuTree($footerMenus);

        $response = [
            'headerMenuTree' => $headerMenuTree,
            'footerMenuTree' => $footerMenuTree,
            'letgo' => $letgo,
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);

        return $this->respond($response);
    }
}
