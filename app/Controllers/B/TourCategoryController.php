<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\TourCategoryModel;
use Config\Services;

class TourCategoryController extends BaseController
{
    protected $tourCategoryModel;
    protected $cache;

    public function __construct()
    {
        $this->tourCategoryModel = new TourCategoryModel();
        $this->cache = Services::cache();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $data['tourcategories'] = $this->tourCategoryModel->findAll();
        $data['lang'] = session()->get('lang') ?? 'vi';
        $data['title'] = 'Tour category';
        return view('B/pages/tourcategory/index', $data);
    }

    public function create()
    {   
        $data['title'] = 'Tour category create';
        return view('B/pages/tourcategory/create',  $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'description' => $this->request->getPost('description'),
            'name_en' => $this->request->getPost('name_en'),
            'description_en' => $this->request->getPost('description_en'),
            'is_domestic' => $this->request->getPost('is_domestic'),
        ];

        $this->tourCategoryModel->insert($data);
        $user = session()->get('user');
        $cacheKeyIndex = "tourcategories_{$user->id}";
        $this->cache->delete($cacheKeyIndex);
        return redirect()->to('/admin/tourcategories')->with('success', 'Danh mục tour đã được tạo.');
    }

    public function edit($id)
    {
        $data['tourcategory'] = $this->tourCategoryModel->find($id);
        $data['title'] = 'Tour category edit';
        return view('B/pages/tourcategory/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'description' => $this->request->getPost('description'),
            'name_en' => $this->request->getPost('name_en'),
            'description_en' => $this->request->getPost('description_en'),
            'is_domestic' => $this->request->getPost('is_domestic'),
        ];

        $this->tourCategoryModel->update($id, $data);
        return redirect()->to('/admin/tourcategories')->with('success', 'Danh mục tour đã được cập nhật.');
    }

    public function delete($id)
{

    $user = session()->get('user');
    $cacheKeyIndex = "tourcategories_{$user->id}";

    $category = $this->tourCategoryModel->find($id);
    if (!$category) {
        return redirect()->to('/admin/tourcategories')->with('error', 'Danh mục tour không tồn tại.');
    }

    if ($this->tourCategoryModel->delete($id)) {
        $this->cache->delete($cacheKeyIndex);
        return redirect()->to('/admin/tourcategories')->with('success', 'Danh mục tour đã được xóa thành công!');
    } else {
        return redirect()->to('/admin/tourcategories')->with('error', 'Không thể xóa danh mục tour.');
    }
}


}