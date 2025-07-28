<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\PartnerModel;
use Config\Services; // Thêm để sử dụng Redis cache

class PartnerController extends BaseController
{
    protected $partnerModel;
    protected $cache;

    public function __construct()
    {
        $this->partnerModel = new PartnerModel();
        $this->cache = Services::cache(); // Khởi tạo Redis cache
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        // Lấy user_id từ session
        $user = session()->get('user');
        $userID = get_user_data('id');

        $data = [
            'title' => 'Danh sách Partners',
            'partners' => $this->partnerModel->where('author', $userID)->findAll(),
        ];

        return view('B/pages/partner/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Danh sách Partners',
        ];
        return view('B/pages/partner/create', $data);
    }

    public function store()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        $data = $this->request->getPost();
        $data['author'] = $userID;

        // Sử dụng URL logo từ fileManager thay vì upload file
        $data['logo'] = $this->request->getPost('logo');

        $this->partnerModel->insert($data);

        // Xóa cache liên quan
        $this->cache->delete("partner_index_{$userID}");

        return redirect()->to('/admin/partners');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Danh sách Partners',
            'partner' => $this->partnerModel->find($id),
        ];
       
        return view('B/pages/partner/edit', $data);
    }

    public function update($id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        $data = $this->request->getPost();
        $data['author'] = $userID;

        // Sử dụng URL logo từ fileManager thay vì upload file
        $data['logo'] = $this->request->getPost('logo');

        $this->partnerModel->update($id, $data);

        // Xóa cache liên quan
        $this->cache->delete("partner_index_{$userID}");
        $this->cache->delete("partner_show_{$id}_{$userID}");

        return redirect()->to('/admin/partners');
    }

    public function delete($id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        $this->partnerModel->delete($id);

        // Xóa cache liên quan
        $this->cache->delete("partner_index_{$userID}");
        $this->cache->delete("partner_show_{$id}_{$userID}");

        return redirect()->to('/admin/partners');
    }
}