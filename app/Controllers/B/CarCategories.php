<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\CarCategory_Model;

class CarCategories extends BaseController
{
    public function __construct()
    {
        helper(['sidebar_helper', 'session_helper', 'permission_helper']);
    }

    public function index()
    {
        $categories = (new CarCategory_Model())->findAll();
        return view('B/pages/category/list', [
            'categories' => $categories,
            'title' => 'Danh mục xe',
        ]);
    }

    public function create()
    {
        return view('B/pages/category/create', [
            'title' => 'Thêm danh mục xe',
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $data['slug'] = url_title($data['name'], '-', true);

        (new CarCategory_Model())->insert($data);
        return redirect()->to('/admin/car/car-category');
    }

    public function edit($id)
    {
        $categoryModel = new CarCategory_Model();
        $category = $categoryModel->find($id);
        $parentCategories = $categoryModel->where('id !=', $id)->findAll();
        return view('B/pages/category/edit', [
            'category' => $category,
            'parentCategories' => $parentCategories,
            'title' => 'Sửa danh mục xe',
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['slug'] = url_title($data['name'], '-', true);

        (new CarCategory_Model())->update($id, $data);
        return redirect()->to('/admin/car/car-category');
    }

    public function delete($id)
    {
        (new CarCategory_Model())->delete($id);
        return redirect()->to('/admin/car/car-category');
    }
}
