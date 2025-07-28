<?php

namespace App\Controllers\B;

use App\Models\Province_Model;
use App\Models\District_Model;
use App\Models\Ward_Model;
use CodeIgniter\Controller;

class Ward extends Controller
{
    protected $wardModel;

    public function __construct()
    {
        $this->wardModel     = new Ward_Model();
        $this->provinceModel = new Province_Model();
        $this->districtModel = new District_Model();
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {

        $data = [
            'provinces' => $this->provinceModel->findAll(),
            'title'     => 'Add New WARD',
            'wards'     => $this->wardModel->getAllWards(),
        ];

        return view('B/pages/ward/ward_list', $data);
    }

    // Thêm quận/huyện mới
    public function create()
    {
        $data = [
            'provinces' => $this->provinceModel->findAll(),
            'title'     => 'Add New WARD'
        ];

        return view('B/pages/ward/ward_create', $data);
    }

    public function store()
    {

        $data = [
            'name'        => $this->request->getPost('name'),
            'district_id' => $this->request->getPost('district_id'),
        ];
        $this->wardModel->insert($data);
        return redirect()->to('/admin/ward');

    }

    // Sửa dữ liệu quận/huyện
    public function edit($id)
    {
        $data['ward'] = $this->wardModel->find($id);
        if ($this->request->getMethod() === 'post') {
            $updateData = [
                'name'        => $this->request->getPost('name'),
                'district_id' => $this->request->getPost('district_id'),
            ];
            $this->wardModel->update($id, $updateData);
            return redirect()->to('/ward');
        }
        return view('B/pages/ward/ward_edit', $data);
    }

    // Xoá dữ liệu quận/huyện
    public function delete($id)
    {
        $this->wardModel->delete($id);
        return redirect()->to('/admin/ward');
    }
}
