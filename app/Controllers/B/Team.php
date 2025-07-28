<?php

namespace App\Controllers\B;

use App\Models\Team_Member_Model;
use CodeIgniter\Controller;

class Team extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);

    }


    public function index()
    {
        $userId = get_user_data('id'); // Lấy id user từ session an toàn
        $model = new Team_Member_Model();
        $data['team_members'] = $model->where('author', $userId)->findAll(); // Lọc theo user_id
        $data['title'] = lang('validation.user_manage');
        return view('B/pages/team/team_list', $data);
    }

    public function create()
    {
        $data['title'] = 'Danh sách bài đăng';
        return view('B/pages/team/team_create', $data);
    }

    public function store()
    {
        $model = new Team_Member_Model();
        $userId = get_user_data('id'); // Lấy id user từ session an toàn
        $data = [
            'fullname'    => $this->request->getPost('fullname'),
            'image'       => $this->request->getPost('thumbnail'),
            'description' => $this->request->getPost('description'),
            'author' => $userId,
        ];

        $model->insert($data);
        return redirect()->to('/admin/team');
    }

    public function edit($id)
    {
        $model               = new Team_Member_Model();
        $data['team_member'] = $model->find($id);
        $data['title']       = 'Danh sách bài đăng';

        return view('B/pages/team/team_edit', $data);
    }

    public function update($id)
    {
        $model = new Team_Member_Model();

        $data = [
            'fullname'    => $this->request->getPost('fullname'),
            'description' => $this->request->getPost('description'),
            'image'  => $this->request->getPost('thumbnail'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/team');
    }

    public function delete($id)
    {
        $model = new Team_Member_Model();
        $model->delete($id);

        return redirect()->to('/admin/team');
    }
}
