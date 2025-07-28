<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\SectionModel;
use App\Models\Car_Model;
use App\Models\News_Model;
use App\Models\Product_Model;
use App\Models\CustomModel;
use Config\Services;

class Section extends BaseController
{
    protected $sectionModel;
    protected $carModel;
    protected $newsModel;
    protected $productModel;
    protected $cache;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->carModel = new \App\Models\Car_Model();
        $this->newsModel = new \App\Models\News_Model();
        $this->productModel = new \App\Models\Product_Model();
        $this->cache = Services::cache();
         helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        // Tham số phân trang và tìm kiếm
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12; // Hiển thị 12 section mỗi trang
        $search = $this->request->getGet('search') ?? '';
        $entityType = $this->request->getGet('entity_type') ?? '';
        $entityId = (int)($this->request->getGet('entity_id') ?? 0);
        
        // Lấy danh sách section có phân trang
        $sectionModel = new SectionModel();
        $paginated_result = $sectionModel->get_paginated_sections($userId, $page, $perPage, $search, $entityType, $entityId);
        
        // Bổ sung thông tin về entity cho mỗi section
        foreach ($paginated_result['sections'] as &$section) {
            if (!empty($section['entity_type']) && !empty($section['entity_id'])) {
                $section['entity_name'] = $this->getEntityName($section['entity_type'], $section['entity_id']);
            } else {
                $section['entity_name'] = 'Không liên kết';
            }
        }

        return view('B/pages/section/index', [
            'title' => 'Danh sách Section',
            'sections' => $paginated_result['sections'],
            'pager' => $paginated_result['pager'],
            'search' => $search,
            'entityType' => $entityType,
            'entityId' => $entityId,
            'entityTypes' => SectionModel::ENTITY_TYPES,
        ]);
    }

    public function create()
    {
        $entityType = $this->request->getGet('entity_type') ?? '';
        $entityId = (int)($this->request->getGet('entity_id') ?? 0);
        
        $entityName = '';
        if ($entityType && $entityId) {
            $entityName = $this->getEntityName($entityType, $entityId);
        }
        
        // Lấy danh sách các thực thể để hiển thị trong dropdown
        $entities = $this->getEntitiesList();
        
        return view('B/pages/section/form', [
            'section' => null,
            'title' => 'Thêm Section',
            'entityType' => $entityType,
            'entityId' => $entityId,
            'entityName' => $entityName,
            'entities' => $entities,
            'entityTypes' => SectionModel::ENTITY_TYPES,
        ]);
    }

    public function edit($id)
    {
        $section = $this->sectionModel->find($id);
        
        if (!$section) {
            return redirect_with_message('error', 'Không tìm thấy section');
        }
        
        $entityName = '';
        if (!empty($section['entity_type']) && !empty($section['entity_id'])) {
            $entityName = $this->getEntityName($section['entity_type'], $section['entity_id']);
        }
        
        // Lấy danh sách các thực thể để hiển thị trong dropdown
        $entities = $this->getEntitiesList();
        
        return view('B/pages/section/form', [
            'section' => $section,
            'title' => 'Sửa Section',
            'entityName' => $entityName,
            'entities' => $entities,
            'entityTypes' => SectionModel::ENTITY_TYPES,
        ]);
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $user = session()->get('user');
        $data = [
            'slug'        => $this->request->getPost('slug'),
            'name'        => $this->request->getPost('name'),
            'content'     => $this->request->getPost('content'),
            'thumbnail'   => $this->request->getPost('thumbnail'),
            'position'    => $this->request->getPost('position'),
            'type'        => $this->request->getPost('type'),
            'author'      => get_user_data('id'),
            'active'      => $this->request->getPost('active') ? 1 : 0,
            'entity_type' => $this->request->getPost('entity_type') ?? 'none',
            'entity_id'   => (int)($this->request->getPost('entity_id') ?? 0),
        ];

        if ($id) {
            $this->sectionModel->update($id, $data);
        } else {
            $this->sectionModel->insert($data);
        }

        return redirect()->to('/admin/section');
    }

    /**
     * Cập nhật trạng thái section qua Ajax
     */
    public function update_status()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Người dùng chưa đăng nhập'
            ]);
        }

        // Lấy dữ liệu từ yêu cầu POST
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Kiểm tra xem yêu cầu có phải là AJAX không
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Yêu cầu không hợp lệ'
            ]);
        }

        // Kiểm tra section có tồn tại và thuộc về người dùng hiện tại không
        $section = $this->sectionModel->where('id', $id)->where('author', $userID)->first();
        
        if (!$section) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Section không tồn tại hoặc bạn không có quyền'
            ]);
        }

        // Cập nhật trạng thái (active)
        $updateData = ['active' => $status];
        $updateStatus = $this->sectionModel->update($id, $updateData);

        // Kiểm tra xem việc cập nhật có thành công không
        if ($updateStatus) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Trạng thái đã được cập nhật!'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Không thể cập nhật trạng thái'
        ]);
    }

    public function delete($id)
    {
        $this->sectionModel->delete($id);
        return redirect()->to('/admin/section');
    }
    
    /**
     * Lấy danh sách section cho một entity cụ thể
     */
    public function entity_sections($entityType, $entityId)
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        // Kiểm tra entity có tồn tại không
        $entityName = $this->getEntityName($entityType, $entityId);
        if (!$entityName) {
            return redirect_with_message('error', 'Không tìm thấy thực thể');
        }
        
        // Lấy danh sách section của entity
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12;
        $search = $this->request->getGet('search') ?? '';
        
        $paginated_result = $this->sectionModel->get_paginated_sections($userId, $page, $perPage, $search, $entityType, $entityId);
        
        return view('B/pages/section/index', [
            'title' => 'Danh sách Section của ' . $entityName,
            'sections' => $paginated_result['sections'],
            'pager' => $paginated_result['pager'],
            'search' => $search,
            'entityType' => $entityType,
            'entityId' => $entityId,
            'entityName' => $entityName,
            'entityTypes' => SectionModel::ENTITY_TYPES,
        ]);
    }
    
    /**
     * Lấy tên của entity dựa vào loại và ID
     */
    private function getEntityName($entityType, $entityId)
    {
        switch ($entityType) {
            case 'car':
                $car = $this->carModel->find($entityId);
                if (is_array($car)) {
                    return $car['name'] ?? null;
                } elseif (is_object($car)) {
                    return $car->name ?? null;
                }
                return null;
                
            case 'news':
                $news = $this->newsModel->find($entityId);
                if (is_array($news)) {
                    return $news['title'] ?? null;
                } elseif (is_object($news)) {
                    return $news->title ?? null;
                }
                return null;
                
            case 'product':
                $product = $this->productModel->find($entityId);
                if (is_array($product)) {
                    return $product['name'] ?? null;
                } elseif (is_object($product)) {
                    return $product->name ?? null;
                }
                return null;
                
            case 'custom':
                // Xử lý cho trang tùy chỉnh (nếu có model riêng)
                return "Trang tùy chỉnh #$entityId";
                
            default:
                return null;
        }
    }
    
    /**
     * Lấy danh sách các thực thể cho dropdown
     */
    private function getEntitiesList()
    {
        $userId = get_user_data('id');
        
        $entities = [
            'car' => [],
            'news' => [],
            'product' => [],
            'custom' => [],
        ];
        
        // Lấy danh sách xe
        $cars = $this->carModel->where('author', $userId)->findAll();
        foreach ($cars as $car) {
            $entities['car'][] = [
                'id' => is_array($car) ? $car['id'] : $car->id,
                'name' => is_array($car) ? $car['name'] : $car->name
            ];
        }
        
        // Lấy danh sách tin tức
        $news = $this->newsModel->where('author', $userId)->findAll();
        foreach ($news as $item) {
            $entities['news'][] = [
                'id' => is_array($item) ? $item['id'] : $item->id,
                'name' => is_array($item) ? ($item['title'] ?? $item['name']) : ($item->title ?? $item->name)
            ];
        }
        
        // Lấy danh sách sản phẩm
        $products = $this->productModel->where('author', $userId)->findAll();
        foreach ($products as $product) {
            $entities['product'][] = [
                'id' => is_array($product) ? $product['id'] : $product->id,
                'name' => is_array($product) ? $product['name'] : $product->name
            ];
        }
        
        // Có thể thêm danh sách trang tùy chỉnh nếu cần
        
        return $entities;
    }
}
