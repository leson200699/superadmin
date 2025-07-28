<?php

namespace App\Controllers\B;

use App\Models\User_Group_Model;
use App\Models\User_Model;
use CodeIgniter\Controller;
use Config\Services;

class Group extends Controller
{
    public function __construct()
    {
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $groupModel = new User_Group_Model();
        $view_data  = [
            'title'  => 'Danh sách nhóm',
            'groups' => $groupModel->get()->getResult(),
            'tab'    => 'nhóm'
        ];
        echo view("B/pages/group/group_list", $view_data);
    }

    public function create_group()
    {

        $view_data = [
            'title' => 'Tạo nhóm',
            'tab'   => 'nhóm, tạo nhóm'
        ];
        echo view("B/pages/group/group_create", $view_data);
    }

    public function post_create_group()
    {
        //lay du lieu form submit va cai dat validate
        $validation = Services::validation();

        $validation_rules = [
            'group_name' => 'required|max_length[255]|is_unique[user_groups.group_name]',
            'status'     => 'required|is_natural|less_than_equal_to[1]'
        ];

        $form_input_data['group_name'] = $this->request->getVar('group_name');
        $form_input_data['status']     = $this->request->getVar('status');

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin nhập không hợp lệ!');
        }

        $group_model   = new User_Group_Model();
        $insert_status = $group_model->insert_group($form_input_data);

        if ($insert_status === true) {
            return redirect_with_message('success', 'Thêm nhóm thành công!');
        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }

    public function edit_group($id)
    {
        $group_model = new User_Group_Model();

        $view_data = [
            'title'      => 'Chỉnh sửa nhóm',
            'edit_group' => $group_model->select('id, group_name, status')->where('id', $id)->get()->getRow(),
            'tab'        => 'nhóm, edit'
        ];
        echo view("B/pages/group/group_edit", $view_data);
    }

    public function post_edit_group()
    {
        $validation  = Services::validation();
        $group_model = new User_Group_Model();

        $group_id = $this->request->getVar('id');

        $group_data = $group_model->where('id', $group_id)->first();

        if (!$group_data) {
            return redirect_with_message('error', 'Nhóm không tồn tại!');
        }

        if ($this->request->getVar('group_name')) {

            $form_input_data['group_name'] = $this->request->getVar('group_name');

            $check_exist_group_name = $group_model->where('id !=', $group_id)->where('group_name', $form_input_data['group_name'])->first();

            if ($check_exist_group_name) {
                return redirect_with_message('error', 'Tên nhóm đã tồn tại!');
            }

            $validation_rules['group_name'] =  "required|alpha_space|max_length[255]|is_unique[user_groups.group_name";
        }

        $form_input_data['status']  = $this->request->getVar('status');
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin nhập không chính xác');
        }

        $update_status = $group_model->update_group($group_id, $form_input_data);

        if ($update_status) {
            return redirect_with_message('success', 'Cập nhật thành công');

        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }

    public function delete_group($id)
    {
        if (get_user_data('role') != IS_ADMIN) {
            return redirect_with_message('success', 'Không đủ quyền thực hiện tác vụ này!');
        }

        $group_model = new User_Group_Model();

        $delete_group = $group_model->where('id', $id)->get()->getRow();

        if (!$delete_group) {
            return redirect_with_message('error', 'Nhóm không tồn tại!');
        }
        //chuyen nguoi dung sang nhom khach hang
        $where     = "role = 2";
        $userModel = new User_Model();

        if (!$userModel->update_user_condition(['role' => 2], $where)) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
        }

        if ($delete_group->is_deletable == 0) {
            return redirect_with_message('error', 'Không thể xóa nhóm dùng này!');
        }

        $deleteStatus = $group_model->delete_group($id);

        if ($deleteStatus) {
            return redirect_with_message('success', 'Xóa người nhóm thành công!');

        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);

    }

}
