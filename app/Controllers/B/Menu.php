<?php

namespace App\Controllers\B;

use App\Models\Menu_Model;
use CodeIgniter\Controller;
use Config\Services;

class Menu extends Controller
{
    protected $menuModel;

    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->cache = Services::cache(); // Khởi tạo Redis cache
        $this->menuModel = new Menu_Model();
    }

    // Trang chính hiển thị danh sách menu

    public function index()
    {
        $user = session()->get('user');
        $locale = service('request')->getLocale();

        // Lấy các menu của user hiện tại
        $menus = $this->menuModel->getAllMenus(get_user_data('id'));


        if (empty($menus)) {
            log_message('error', 'No menus found for user ID: ' . get_user_data('id'));
        }

        // Thêm trường 'display_name' vào mỗi menu
        foreach ($menus as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
        }

        // Lọc danh sách menu cha (parent_id == 0)
        $parentMenus = array_filter($menus, function ($menu) {
            return $menu['parent_id'] == 0;
        });

        // Xây dựng cây menu
        $menuTree = $this->buildMenuTree($menus);

        // Thêm 'display_name' vào mỗi menu trong cây
        foreach ($menuTree as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
            if (isset($menu['children']) && is_array($menu['children'])) {
                foreach ($menu['children'] as &$submenu) {
                    $submenu['display_name'] = $locale === 'en' ? ($submenu['name_en'] ?? $submenu['name']) : $submenu['name'];
                }
            }
        }

        // Truyền dữ liệu sang view
        return view('B/pages/menu/menu_list', [
            'title' => 'Menu',
            'parentMenus' => $parentMenus,
            'menuTree' => $menuTree,
        ]);
    }



    public function create()
    {
        // Lấy locale hiện tại
        $locale = service('request')->getLocale();

        // Lấy user ID từ session
        $userID = session()->has('user') ? session()->get('user')->id : null;

        // Lấy tất cả các menu của user hiện tại
        $menus = $this->menuModel->where('author', $userID)
                                 ->orderBy('position', 'ASC')
                                 ->findAll();

        // Thêm trường 'display_name' vào mỗi menu
        foreach ($menus as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
        }

        // Lọc danh sách menu cha (parent_id == 0)
        $parentMenus = array_filter($menus, function ($menu) {
            return $menu['parent_id'] == 0;
        });

        // Truyền dữ liệu sang view
        return view('B/pages/menu/menu_create', [
            'title' => 'Menu',
            'menus' => $menus,
            'parentMenus' => $parentMenus,
        ]);
    }

    private function buildMenuTree($menus, $parentId = 0)
    {
        $tree = [];
        $menuMap = [];

        // Tạo mảng ánh xạ theo ID
        foreach ($menus as $menu) {
            $menuMap[$menu['id']] = $menu;
            $menuMap[$menu['id']]['children'] = [];
        }

        // Xây dựng cây
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $tree[] = &$menuMap[$menu['id']];
            } elseif (isset($menuMap[$menu['parent_id']])) {
                $menuMap[$menu['parent_id']]['children'][] = &$menuMap[$menu['id']];
            }
        }

        return $tree;
    }

    public function saveMenu()
    {
        $data            = $this->request->getPost();
        $menuId          = $data['id']               ?? null;
        $parentId        = $data['parent_id']        ?? null;
        $displayLocation = $data['display_location'] ?? 'header';
        $position        = $data['position']         ?? 'end'; // Giá trị mặc định là cuối danh sách
        $userID = session()->has('user') ? session()->get('user')->id : null;
        $locale = service('request')->getLocale();
        if (!$userID) {
            return redirect()->to('admin/menu')->with('error', 'User không được xác thực!');
        }

        // Xác định vị trí
        if ($position === 'start') {
            $newPosition = 1;
            $this->menuModel->incrementPositions($parentId, $newPosition);
        } elseif (str_starts_with($position, 'before:')) {
            $referenceId   = explode(':', $position)[1];
            $referenceMenu = $this->menuModel->where('id', $referenceId)
                                            ->where('author', $userID)
                                            ->first(); // Chỉ lấy menu của author hiện tại
            if ($referenceMenu) {
                $newPosition = $referenceMenu['position'];
                $this->menuModel->incrementPositions($referenceMenu['parent_id'], $newPosition);
            } else {
                // Nếu không tìm thấy hoặc không thuộc author, mặc định cuối danh sách
                $newPosition = $this->menuModel->getMaxPosition($parentId) + 1;
            }
        } elseif (str_starts_with($position, 'after:')) {
            $referenceId   = explode(':', $position)[1];
            $referenceMenu = $this->menuModel->where('id', $referenceId)
                                            ->where('author', $userID)
                                            ->first(); // Chỉ lấy menu của author hiện tại
            if ($referenceMenu) {
                $newPosition = $referenceMenu['position'] + 1;
                $this->menuModel->incrementPositions($referenceMenu['parent_id'], $newPosition);
            } else {
                // Nếu không tìm thấy hoặc không thuộc author, mặc định cuối danh sách
                $newPosition = $this->menuModel->getMaxPosition($parentId) + 1;
            }
        } else {
            $newPosition = $this->menuModel->getMaxPosition($parentId) + 1;
        }

        $data['position']         = $newPosition;
        $data['parent_id']        = $parentId ?? null;
        $data['display_location'] = $displayLocation;
        $data['author'] = $userID;

        // Lưu menu
        $this->menuModel->saveMenu($data);
        $this->cache->delete("menu_index_{$userID}_{$locale}");

        return redirect()->to('admin/menu');
    }

    public function getSubMenus($parent_id)
    {
        $locale = service('request')->getLocale();
        $userID = session()->has('user') ? session()->get('user')->id : null;

        if (!$userID) {
            return $this->response->setJSON([])->setStatusCode(403); // Trả về rỗng nếu không có user
        }

        // Lấy danh sách menu dựa trên parent_id và author
        $menus = $this->menuModel
            ->where('parent_id', $parent_id)
            ->where('author', $userID) // Thêm điều kiện lọc theo author
            ->orderBy('position', 'ASC')
            ->findAll();

        // Thêm trường 'display_name' để hỗ trợ đa ngôn ngữ
        foreach ($menus as &$menu) {
            $menu['display_name'] = $locale === 'en' ? ($menu['name_en'] ?? $menu['name']) : $menu['name'];
        }

        return $this->response->setJSON($menus);
    }



    public function delete($menuId)
    {
        // Gọi phương thức xóa trong model
        if ($this->menuModel->deleteMenuAndChildren($menuId)) {

            $locale = service('request')->getLocale();
            $userID = session()->has('user') ? session()->get('user')->id : null;
            $this->cache->delete("menu_index_{$userID}_{$locale}");

            return redirect()->to('/admin/menu')->with('message', 'Menu đã được xóa thành công!');
        } else {
            return redirect()->to('/admin/menu')->with('error', 'Xóa menu thất bại!');
        }
    }

    public function edit($menuId)
    {
        // Lấy thông tin menu theo ID
        $menu = $this->menuModel->find($menuId);

        if (!$menu) {
            return redirect()->to('/admin/menu')->with('error', 'Menu không tồn tại!');
        }

        // Lấy locale hiện tại
        $locale = service('request')->getLocale();

        // Lấy user ID từ session
        $userID = session()->has('user') ? session()->get('user')->id : null;

        // Lấy danh sách menu cha, chỉ lấy của user hiện tại
        $menus = $this->menuModel->where('parent_id', 0)
                                 ->where('author', $userID)
                                 ->findAll();

        foreach ($menus as &$menuItem) {
            $menuItem['display_name'] = $locale === 'en' ? ($menuItem['name_en'] ?? $menuItem['name']) : $menuItem['name'];
        }

        // Truyền dữ liệu sang view
        return view('B/pages/menu/menu_edit', [
            'title' => 'Chỉnh sửa Menu',
            'menu'  => $menu,
            'menus' => $menus, // Tất cả menu cha của user hiện tại
        ]);
    }

    public function updateMenu()
    {
        $data            = $this->request->getPost();
        $menuId          = $data['id']               ?? null;
        $parentId        = $data['parent_id']        ?? null;
        $displayLocation = $data['display_location'] ?? 'header';
        $position        = $data['position']         ?? 'end';
        $userID = session()->has('user') ? session()->get('user')->id : null;
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        // Kiểm tra menu có tồn tại
        $existingMenu = $this->menuModel->find($menuId);
        if (!$existingMenu) {
            return redirect()->to('/admin/menu')->with('error', 'Menu không tồn tại!');
        }

        // Xử lý vị trí giống như khi thêm mới
        if ($position === 'start') {
            $newPosition = 1;
            $this->menuModel->incrementPositions($parentId, $newPosition);
        } elseif (str_starts_with($position, 'before:')) {
            $referenceId   = explode(':', $position)[1];
            $referenceMenu = $this->menuModel->find($referenceId);
            if ($referenceMenu) {
                $newPosition = $referenceMenu['position'];
                $this->menuModel->incrementPositions($referenceMenu['parent_id'], $newPosition);
            }
        } elseif (str_starts_with($position, 'after:')) {
            $referenceId   = explode(':', $position)[1];
            $referenceMenu = $this->menuModel->find($referenceId);
            if ($referenceMenu) {
                $newPosition = $referenceMenu['position'] + 1;
                $this->menuModel->incrementPositions($referenceMenu['parent_id'], $newPosition);
            }
        } else {

            $newPosition = $position ;
            // $newPosition = $this->menuModel->getMaxPosition($parentId) + 0;
        }

        // Cập nhật thông tin menu
        $data['position']         = $newPosition;
        $data['parent_id']        = $parentId ?? null;
        $data['display_location'] = $displayLocation;


        $this->menuModel->saveMenu($data);
        $locale = service('request')->getLocale();
        $this->cache->delete("menu_index_{$userID}_{$locale}");

        return redirect()->to('/admin/menu')->with('message', 'Menu đã được cập nhật thành công!');
    }

}
