<?php

namespace App\Controllers\B;
use App\Controllers\BaseController;
use App\Models\Project_Model;
use App\Models\Province_Model;
use App\Models\District_Model;
use App\Models\Ward_Model;

class Project_Controller extends BaseController
{
    protected $projectModel;
    protected $provinceModel;
    protected $districtModel;
    protected $wardModel;

    public function __construct()
    {
        $this->projectModel = new Project_Model();
        $this->provinceModel = new Province_Model();
        $this->districtModel = new District_Model();
        $this->wardModel = new Ward_Model();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

      public function index()
    {   

        $userId = get_user_data('id'); // Lấy user_id từ session
        //dd(session()->get('user'));
        $data = [
            'title' => "Danh sách dự án",
            'projects' => $this->projectModel->getAllProjectsByUser($userId),
        ];

        return view('B/pages/project/project_list', $data);
    }


    public function create()
    {
        $data = [
            'title' => "Danh sách dự án",
            'provinces' =>  $this->provinceModel->findAll(),
        ];
        return view('B/pages/project/project_create', $data);
    }

    public function store()
    {
        $this->projectModel->save([
            'multiple_image' => $this->request->getPost('multiple_image'),
            'name'           => $this->request->getPost('name'),
            'author'         => get_user_data('id'),
            'attributes'     => json_encode($this->request->getPost('attributes')),
            'alias'          => $this->request->getPost('slug'),
            'type'           => $this->request->getPost('type'),
            'province_id'    => $this->nullIfEmpty($this->request->getPost('province_id')),
            'district_id'    => $this->nullIfEmpty($this->request->getPost('district_id')),
            'ward_id'        => $this->nullIfEmpty($this->request->getPost('ward_id')),
            'price'          => $this->request->getPost('price'),
            'thumbnail'      => $this->request->getPost('thumbnail'),
            'description'    => $this->request->getPost('description'),
            'content'        => $this->request->getPost('content'),
            'status'         => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/project');
    }

    private function nullIfEmpty($value)
    {
        return ($value === '' || $value === null) ? null : $value;
    }






    public function edit($id)
    {
        $projectModel = new Project_Model();
        $provinceModel = new Province_Model();
        $districtModel = new District_Model();
        $wardModel = new Ward_Model();
        // Lấy thông tin dự án
        $project = $this->projectModel->getProjectWithID($id);
        if (!$project) {
            return redirect()->to('/B/pages/project')->with('error', 'Dự án không tồn tại.');
        }

        // Lấy danh sách tỉnh, quận, phường
        $provinces = $provinceModel->where('status', 1)->findAll();
        $districts = $districtModel->where('province_id', $project->province_id)->findAll();
        $wards = $wardModel->where('district_id', $project->district_id)->findAll();

        return view('B/pages/project/project_edit', [
            'title'      => "Danh sách dự án",
            'project'    => $project,
            'provinces'  => $provinces,
            'districts'  => $districts,
            'wards'      => $wards,
            'images'     => $project->images,
        ]);
    }




    public function update($id)
    {
        $projectModel = new Project_Model();

        // Xác nhận dự án tồn tại
        $project = $projectModel->find($id);
        if (!$project) {
            return redirect()->to('/B/pages/project')->with('error', 'Dự án không tồn tại.');
        }

        // Lấy dữ liệu từ form
        $data = [
            'name' => $this->request->getPost('name'),
            'alias' => $this->request->getPost('slug'),
            'type' => $this->request->getPost('type'),
            'province_id' => $this->request->getPost('province_id'),
            'district_id' => $this->request->getPost('district_id'),
            'price' => $this->request->getPost('price'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'description' => $this->request->getPost('description'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
            'multiple_image'   => $this->request->getVar('post_images'),
        ];

        // Cập nhật dự án
        $projectModel->update($id, $data);

        return redirect()->to('/admin/project')->with('success', 'Cập nhật dự án thành công.');
    }
        public function getByProvince($provinceId)
    {
        $districtModel = new District_Model();
        $districts = $districtModel->where('province_id', $provinceId)->findAll();

        return $this->response->setJSON($districts);
    }


        public function getByDistrict($districtId)
    {
        $wardModel = new Ward_Model();
        $wards = $wardModel->where('district_id', $districtId)->findAll();

        return $this->response->setJSON($wards);
    }




       public function delete($id)
    {

        $projectModel  = new Project_Model();
        $delete_project = $projectModel->find($id);
        if (!$delete_project) {
            return redirect_with_message_url('error', 'Bài viết không tồn tại!', 'project-list');
        }
        $delete_status = $projectModel->delete_project($id);
        if ($delete_status) {
            return redirect_with_message_url('success', 'Xóa bài viết thành công!','project-list');

        }
        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR,'project-list');
    }


}
