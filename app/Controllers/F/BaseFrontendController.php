<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\User_Model;
use App\Models\Config_Model;
use App\Models\Menu_Model;
use App\Libraries\TenantResolverService;

class BaseFrontendController extends BaseController
{
    protected $cache;
    protected $user;    // dữ liệu giả lập user từ tenant
    protected $userId;  // id tenant (dùng như userId)
    protected $config;  // config dữ liệu riêng của tenant
    protected $menus;   // menu riêng
    protected $tenant;

    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);

        // 🔹 Khởi tạo cache
        $this->cache = Services::cache();

        // 🔹 Xác định tenant dựa trên domain/subdomain
        $this->tenant = TenantResolverService::resolve();

        if (!$this->tenant) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Không xác định được tenant từ domain.");
        }

        // 🔹 Gán vào giả lập user để reuse toàn bộ hệ thống hiện tại
        $this->user = [
            'id'       => $this->tenant->id ?? 0,
            'username' => $this->tenant->username ?? 'default',
        ];
        $this->userId = $this->user['id'];

        // 🔹 Gán session frontend_username để giữ luồng logic cũ
        service('session')->set('frontend_username', $this->user['username']);

        // 🔹 Load config riêng và menus như trước
        $this->loadUserConfig();
        $this->loadMenus();

        // 🔹 Inject biến vào view toàn hệ thống
        Services::renderer()->setData([
            'tenant' => $this->tenant,
            'user'   => $this->user,
            'config' => $this->config,
            'menus'  => $this->menus,
        ]);
    }

    private function loadUserConfig()
    {
        if (!$this->userId) {
            $this->config = (object) [];
        } else {
            $configModel = new Config_Model();
            $rows = $configModel->where('author', $this->userId)->findAll();
            $this->config = isset($rows[0]) ? (object) $rows[0] : (object) [];
        }
    }

    private function loadMenus()
    {
        if (!$this->userId) {
            $this->menus = [];
            return;
        }

        $menuModel = new Menu_Model();
        $flatMenus = $menuModel->getAllMenus($this->userId);
        $this->menus = $this->buildMenuTree($flatMenus);
    }

    private function buildMenuTree($menus, $parentId = 0)
    {
        $tree = [];

        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $children = $this->buildMenuTree($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $tree[] = $menu;
            }
        }

        return $tree;
    }
}
