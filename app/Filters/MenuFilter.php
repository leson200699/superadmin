<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Menu_Model;
use App\Models\Landing_Model;

class MenuFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $menuModel = new Menu_Model();
        $landing = new Landing_Model();

        $locale = service('request')->getLocale();
        $letgo = $landing->getLandingLocaleById( 15, $locale);

        // Lấy tất cả menu
        $menus = $menuModel->orderBy('position', 'ASC')->findAll();

        // Thêm 'display_name' dựa trên ngôn ngữ
        foreach ($menus as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
        }

        // Lọc menu theo display_location
        $headerMenus = array_filter($menus, function ($menu) {
            return $menu['display_location'] === 'header';
        });

        $footerMenus = array_filter($menus, function ($menu) {
            return $menu['display_location'] === 'footer';
        });

        // Xây dựng cây menu cho header và footer
        helper('menu'); // Đảm bảo helper đã được tạo
        $headerMenuTree = buildMenuTree($headerMenus);
        $footerMenuTree = buildMenuTree($footerMenus);

        // Gắn các cây menu vào renderer
        service('renderer')->setData([
            'headerMenuTree' => $headerMenuTree,
            'footerMenuTree' => $footerMenuTree,
            'letgo' => $letgo,
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Không cần xử lý gì sau khi response
    }
}