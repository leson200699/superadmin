<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\Landing_Model;
use Config\Services;

class LandingController extends BaseController
{
    protected $landingModel;
    protected $cache;

    public function __construct()
    {
        $this->landingModel = new Landing_Model();
        $this->cache = Services::cache();
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    // Hiển thị danh sách landing
    public function index()
    {
        $user = session()->get('user');
        $data['landings'] = $this->landingModel->where('author', get_user_data('id'))->findAll();
        $data['title'] = "landing";
        return view('B/pages/custom/index', $data);
    }

    // Hiển thị form tạo landing mới
    public function create()
    {
        $data['title'] = "created";
        return view('B/pages/custom/create', $data);
    }

    // Xử lý lưu landing mới
    public function store()
    {
        // Validate dữ liệu chính
        $this->validate([
            'name'        => 'required|max_length[255]',
            'name_en'     => 'required|max_length[255]',
            'alias'       => 'required|max_length[255]',
            'content'     => 'required',
            'content_en'  => 'required|max_length[255]',
            'status'      => 'required|integer',
        ]);

        $data = $this->request->getPost();
        $user = session()->get('user');
        $data['author'] = get_user_data('id');

        // Lưu landing chính
        $this->landingModel->save($data);
        $landingId = $this->landingModel->getInsertID(); // Lấy ID vừa tạo

        // Xử lý sections (nếu có)
        $sections = $this->request->getPost('sections');
        if ($sections && is_array($sections)) {
            $sectionModel = new \App\Models\LandingSection_Model();
            foreach ($sections as $section) {
                $sectionModel->insert([
                    'landing_id' => $landingId,
                    'type'       => $section['type'] ?? 'text',
                    'image'      => $section['image'] ?? '',
                    'content'    => $section['content'] ?? ''
                ]);
            }
        }

        // Xóa cache
        $this->cache->delete("landing_index_" . get_user_data('id'));

        return redirect()->to('/admin/custom')->with('success', 'Landing created successfully!');
    }


    // Hiển thị chi tiết landing
    public function show($id)
    {
        $data['landing'] = $this->landingModel->find($id);
        return view('B/pages/custom/show', $data);
    }

    // Hiển thị form chỉnh sửa landing
    public function edit($id)
    {
        

        $landingModel = new Landing_Model();
        $landing = $this->landingModel->find($id);
        if (!$landing) {
            return redirect()->to('/B/pages/project')->with('error', 'Dự án không tồn tại.');
        }

        if ($landing) {
            $landing['images'] = !empty($landing['multiple_image']) ? explode(',', $landing['multiple_image']) : [];
        }
        $sectionModel = new \App\Models\LandingSection_Model();
        $landing['sections'] = $sectionModel->where('landing_id', $id)->findAll();
        return view('B/pages/custom/edit', [
            'title'      => "landing",
            'landing'    => $landing,
            'images'     => $landing['images'],
            'sections'   => $landing['sections'],
        ]);


    }

    // Xử lý cập nhật landing
    public function update($id)
    {
        // Validation rules
        $this->validate([
            'name'        => 'required|max_length[255]',
            'name_en'     => 'required|max_length[255]',
            'alias'       => 'required|max_length[255]',
            'content'     => 'required',
            'content_en'  => 'required|max_length[255]',
            'status'      => 'required|integer',
        ]);

        // Lấy dữ liệu từ form
        $data = [
            'name' => $this->request->getPost('name'),
            'name_en' => $this->request->getPost('name_en'),
            'alias' => $this->request->getPost('alias'),
            'caption' => $this->request->getPost('caption'),
            'caption_en' => $this->request->getPost('caption_en'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'content' => $this->request->getPost('content'),
            'content_en' => $this->request->getPost('content_en'),
            'status' => $this->request->getPost('status'),
            'multiple_image' => $this->request->getVar('post_images'),
        ];

        // Cập nhật dữ liệu trong database
        $this->landingModel->update($id, $data);

        // Xóa cache liên quan
        $user = session()->get('user');
        $cacheKeyIndex = "landing_index_" . get_user_data('id'); // Key cho danh sách landing
        $cacheKeyDetail = "landing_detail_{$id}";     // Key cho chi tiết landing

        $this->cache->delete($cacheKeyIndex);  // Xóa cache danh sách
        $this->cache->delete($cacheKeyDetail); // Xóa cache chi tiết

        return redirect()->to('/admin/custom')->with('success', 'Landing updated successfully!');
    }

    public function delete($id)
    {
        $this->landingModel->delete($id);

        // Xóa cache liên quan
        $user = session()->get('user');
        $this->cache->delete("landing_index_" . get_user_data('id'));
        $this->cache->delete("landing_detail_{$id}");

        return redirect()->to('/admin/custom')->with('success', 'Landing deleted successfully!');
    }
}
