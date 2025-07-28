<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\ServiceCategoryModel;

class ServiceCategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new ServiceCategoryModel();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $userId = get_user_data('id');
        // Lấy danh sách category mà có service thuộc về user này
        $categories = $this->categoryModel->select('service_categories.*')
            ->where('service_categories.author', $userId)
            ->groupBy('service_categories.id')
            ->findAll();

        return view('B/pages/category/list', [
            'categories' => $categories,
            'title'     => lang('validation.service_manage'),
        ]);
    }


    public function create()
    {
        $userId = get_user_data('id');
        $parentCategories = $this->categoryModel->where('parent_id', null)->where('author', $userId)->findAll();
        return view('B/pages/category/create', [
            'parentCategories' => $parentCategories,
            'title' => 'Thêm danh mục dịch vụ',
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $userId = get_user_data('id');
        $data['author'] = $userId;
        $this->categoryModel->save($data);
        return redirect_with_message_url('success', 'Tạo CATEGORY thành công!', 'admin-service-category-list');
    }

    public function edit($id)
    {
        $userId = get_user_data('id');
        $category = $this->categoryModel->find($id);
        if (!$category || $category['author'] != $userId) {
            return redirect()->to('/admin/service-category-list')->with('error', 'Unauthorized access');
        }
        $parentCategories = $this->categoryModel->where('parent_id', null)->where('author', $userId)->findAll();
        return view('B/pages/category/edit', ['category' => $category, 'parentCategories' => $parentCategories]);
    }

    public function update($id)
    {
        $userId = get_user_data('id');
        $category = $this->categoryModel->find($id);
        if (!$category || $category['author'] != $userId) {
            return redirect()->to('/admin/service-category-list')->with('error', 'Unauthorized access');
        }
        $data = $this->request->getPost();
        $this->categoryModel->update($id, $data);
        return redirect()->to('/admin/service-category-list')->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $userId = get_user_data('id');
        $category = $this->categoryModel->find($id);
        if (!$category || $category['author'] != $userId) {
            return redirect()->to('/admin/service-category-list')->with('error', 'Unauthorized access');
        }
        $this->categoryModel->delete($id);
        return redirect()->to('/admin/service-category-list')->with('success', 'Xóa thành công');
    }
}