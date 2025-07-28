<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use Config\Services;

class AboutController extends BaseController
{
    protected $aboutModel;
    protected $cache;

    public function __construct()
    {
        $this->aboutModel = new AboutModel();
        $this->cache = Services::cache();
         helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        // Lấy user_id từ session
        $userID = get_user_data('id');

        // Chỉ lấy các trang About có author trùng với user_id
        $aboutPages = $this->aboutModel->where('author', $userID)->findAll();

        $view_data = [
            'title'      => lang('validation.about_us_manage'),
            'tab'        => 'tin tuc, tin tuc l',
            'aboutPages' => $aboutPages,
        ];

        return view('B/pages/about/index', $view_data);
    }

    public function create()
    {
        $view_data  = [
            'title'     => lang('validation.about_us_manage'),
        ];
        return view('B/pages/about/create', $view_data);
    }

    public function store()
    {
        // Lấy dữ liệu từ request và thêm user_id
        $data = $this->request->getPost();
        $userID = get_user_data('id');
        $data['author'] = $userID;

        $this->aboutModel->save($data);

        $cacheKeyIndex = "about_index_{$userID}"; // Key cho danh sách landing
        $this->cache->delete($cacheKeyIndex);  // Xóa cache danh sách
        return redirect()->to('/admin/abouts');
    }

    public function edit($id)
    {
        $data = [
            'aboutPage' => $this->aboutModel->find($id),
            'title' => 'Chỉnh sửa thông tin About Us'
        ];
        return view('B/pages/about/edit', $data);
    }

    public function update($id)
    {
        // Lấy dữ liệu từ request và thêm user_id
        $data = $this->request->getPost();
        $userID = get_user_data('id');
        $data['author'] = $userID;

        $this->aboutModel->update($id, $data);

        $cacheKeyIndex = "about_index_{$userID}"; // Key cho danh sách landing
        $cacheKeyDetail = "about_show_{$id}_{$userID}";     // Key cho chi tiết landing
        $this->cache->delete($cacheKeyIndex);  // Xóa cache danh sách
        $this->cache->delete($cacheKeyDetail); // Xóa cache chi tiết



        return redirect()->to('/admin/abouts');
    }

    public function delete($id)
    {
        $this->aboutModel->delete($id);
        return redirect()->to('/admin/abouts');
    }
}
