<?php

namespace App\Controllers\B;

use App\Models\User_Group_Model;
use App\Models\User_Model;
use CodeIgniter\Controller;
use Config\Database;
use Config\Services;
use App\Models\ApiKeyModel;

class User extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $user_model = new User_Model();
        $user_id = get_user_data('id');
        $view_data  = [
            'title' => 'Hồ sơ cá nhân',
            'user'  => $user_model->get_user_with_api_key($user_id),
            'tab'   => 'user'
        ];
        echo view("B/pages/user/profile", $view_data);
    }

    //thay doi thong tin ca nhan
    public function update_profile()
    {
        $validation = Services::validation();
        $user_id    = get_user_data('id');

        $validation_rules = [
            'lastname'  => 'required|alpha_space|max_length[255]',
            'firstname' => 'required|alpha_space|max_length[255]',
            'email'     => 'required|valid_email|max_length[255]',
            'phone_no'  => 'required|is_natural|min_length[9]|max_length[11]'
        ];

        $form_input_data['lastname']  = $this->request->getVar('lastname');
        $form_input_data['firstname'] = $this->request->getVar('firstname');
        $form_input_data['email']     = $this->request->getVar('email');
        $form_input_data['phone_no']  = $this->request->getVar('phone_no');

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin nhập không hơp lệ');

        }

        $user_model = new User_Model();

        $check_early_exist_email = $user_model->where('id != ', $user_id)->where('email', $form_input_data['email'])->first();
        if ($check_early_exist_email) {
            return redirect_with_message('error', 'Email đã tồn tại');
        }

        $check_early_exist_mobile = $user_model->where('id !=', $user_id)->where('mobile_no', $form_input_data['phone_no'])->first();

        if ($check_early_exist_mobile) {
            return redirect_with_message('error', 'Số điện thoại đã tồn tại');
        }

        $user_update_status = $user_model->update($user_id, $form_input_data);
        if (!$user_update_status) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);

        };

        $user = $user_model->where('id', $user_id)->get()->getRow();
        set_session_data('user', $user);
        return redirect_with_message('success', 'Cập nhật thông tin thành công');
    }

    //doi mat khau
    public function update_password()
    {
        $validation = Services::validation();

        $validation_rules = [
            'current_password' => 'required|min_length[6]|max_length[255]',
            'new_password'     => 'required|min_length[6]|max_length[255]',
            're_new_password'  => 'required|min_length[6]|max_length[255]|matches[new_password]'
        ];

        $form_input_data['current_password'] = $this->request->getVar('current_password');
        $form_input_data['new_password']     = $this->request->getVar('new_password');
        $form_input_data['re_new_password']  = $this->request->getVar('re_new_password');

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Mật khẩu không hơp lệ');

        }

        $user = get_session_data('user');

        if (!password_verify($form_input_data['current_password'], get_user_data('password'))) {
            return redirect_with_message('error', 'Mật khẩu hiện tại không chính xác');
        }

        $new_password           = password_hash($form_input_data['new_password'], PASSWORD_DEFAULT);
        $user_model             = new User_Model();
        $update_password_status = $user_model->update(get_user_data('id'), ['password' => $new_password]);

        if (!$update_password_status) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
        };

        $temp = $user_model->find(get_user_data('id'));
        set_session_data('user', $user_model->find(get_user_data('id')));
        return redirect_with_message('success', 'Đổi mật khẩu thành công');
    }

    //danh sach thanh vien
    public function users_list()
    {
        $builder = Database::connect()->table('users');

        $users_list = $builder
            ->join('user_groups', 'users.role = user_groups.id')
            ->join('user_api_keys', 'users.id = user_api_keys.user_id', 'left') // Đảm bảo API Key được lấy
            ->select('users.id, users.email, users.created_at, users.is_active, users.is_admin, users.is_deletable, user_groups.group_name, user_api_keys.api_key, user_api_keys.status') // Lấy cả API Key
            ->get()
            ->getResult();


        $view_data = [
            'title'      => lang('validation.user_manage'),
            'users_list' => $users_list,
        ];
        return view('B/pages/user/user_list', $view_data);
    }


    //xoa thanh vien
    public function delete_user($id = null)
    {
        if (get_user_data('is_admin') != IS_ADMIN) {
            return redirect_with_message('success', 'Không đủ quyền thực hiện tác vụ này!');
        }

        $user_model = new User_Model();

        $deleteUser = $user_model->where('id', $id)->get()->getRow();

        if (!$deleteUser) {
            return redirect_with_message('error', 'Người dùng không tồn tại!');
        }

        if ($deleteUser->is_deletable == 1) {
            return redirect_with_message('error', 'Không thể xóa người dùng này!');
        }

        $deleteStatus = $user_model->delete_user($id);

        if ($deleteStatus) {
            return redirect_with_message('success', 'Xóa người dùng thành công!');

        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);

    }




    //them thanh vien moi
    public function add_user()
    {
        $user_group_model = new User_Group_Model();
        $view_data        = [
            'title'  => lang('validation.add_user'),
            'groups' => $user_group_model->get()->getResult(),
            'tab'    => 'users, user_create'
        ];
        return view('B/pages/user/add_new_user', $view_data);
    }

    //post add user
    public function post_add_user()
    {
        $request    = Services::request();
        $validation = Services::validation();
        $group      = new User_Group_Model();
        $user_model = new User_Model();
        $user_api_key_model = new \App\Models\UserApiKey_Model();

        $validation->setRules([
            'lastname'    => 'max_length[255]',
            'firstname'   => 'max_length[255]',
            'email'       => 'required|valid_email|is_unique[users.email]',
            'group'       => "required|is_natural",
            'address'     => 'max_length[255]',
            'password'    => 'required|min_length[6]|max_length[255]',
            're_password' => 'required|min_length[6]|max_length[255]|matches[password]',
            'phone_no'    => 'required|is_natural|min_length[9]|max_length[11]'
        ]);

        $validation->withRequest($this->request)->run();

        if ($validation->getErrors()) {
            return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'dashboard');
        }

        $form_input_data = [
            'firstname'  => $request->getVar('firstname'),
            'lastname'   => $request->getVar('lastname'),
            'email'      => $request->getVar('email'),
            'address'    => $request->getVar('address'),
            'mobile_no'  => $request->getVar('phone_no'),
            'role'       => $request->getVar('group'),
            'is_active'  => $request->getVar('status'),
            'password'   => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $form_input_data = array_filter($form_input_data);

        if (!$group->find($form_input_data['role'])) {
            return redirect_with_message_url('error', 'Nhóm không hợp lệ!', 'dashboard');
        }

        $form_input_data['is_admin'] = 1;

        // Gọi insert_user từ model
        $new_user_id = $user_model->insert_user($form_input_data);

        if ($new_user_id) {
            // Tạo API Key
            $apiKey = bin2hex(random_bytes(32));

            // Kiểm tra nếu đã tồn tại API Key cho user này, nếu có thì update thay vì insert mới
            $existingApiKey = $user_api_key_model->where('user_id', $new_user_id)->first();

            if ($existingApiKey) {
                $updateStatus = $user_api_key_model->update($existingApiKey['id'], [
                    'api_key' => $apiKey,
                    'status'  => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                if (!$updateStatus) {
                    return redirect_with_message_url('error', 'Lỗi cập nhật API Key!', 'dashboard');
                }


            } else {
                $insertStatus = $user_api_key_model->insert([
                    'user_id' => $new_user_id,
                    'api_key' => $apiKey,
                    'status'  => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                // Kiểm tra ngay sau khi insert
                $createdApiKey = $user_api_key_model->where('user_id', $new_user_id)->first();
                dd($createdApiKey); // Xem lại status


                if (!$insertStatus) {
                    return redirect_with_message_url('error', 'Không thể tạo API Key!', 'dashboard');
                }
            }

            return redirect_with_message_url('success', 'Người dùng và API Key đã được tạo và kích hoạt!', 'dashboard');
        }


        return redirect_with_message_url('error', 'Không thể tạo người dùng!', 'dashboard');
    }




    public function edit_user($id)
    {
        $user_group_model = new User_Group_Model();
        $user_model = new User_Model();

        $session_user = get_session_data('user');
        $session_user_id = $session_user->id; // Lấy ID của người dùng hiện tại từ session
        $session_user_role = $session_user->role; // Lấy role của người dùng hiện tại từ session

        // Cho phép chỉnh sửa nếu người dùng là chủ sở hữu tài khoản hoặc có role = 1
        if ($session_user_id != $id && $session_user_role != 1) {
            return redirect_with_message_url('error', 'Bạn không có quyền xem hoặc chỉnh sửa thông tin này!', 'dashboard');
        }

        $edit_user = $user_model->getUserWithApiKey($id);

        if (!$edit_user) {
            return redirect_with_message('error', 'Người dùng không tồn tại!');
        }

        $view_data = [
            'title'     => lang('validation.edit_user'),
            'groups'    => $user_group_model->get()->getResult(),
            'edit_user' => $edit_user,
            'tab'       => 'user, edit_user'
        ];
        return view('B/pages/user/edit_user', $view_data);
    }


    public function post_edit_user()
    {
        $user_model = new User_Model();
        $api_key_model = new ApiKeyModel();
        $request = Services::request();
        $validation = Services::validation();
        $group = new User_Group_Model();

        $session_user = get_session_data('user');
        $session_user_id = $session_user->id; // Lấy ID của người dùng hiện tại từ session
        $session_user_role = $session_user->role; // Lấy role của người dùng hiện tại từ session

        $user_id = $this->request->getVar('id'); // Lấy ID người dùng từ form

        // Chỉ cho phép người dùng sửa thông tin của chính họ hoặc người dùng có role = 1
        if ($session_user_id != $user_id && $session_user_role != 1) {
            return redirect()->to('/admin/user/edit/id/' . $user_id)->with('error', 'Bạn không có quyền chỉnh sửa thông tin người dùng này!');
        }

        $user = $user_model->find($user_id);
        if (!$user) {
            return redirect()->to('/admin/user/edit/id/' . $user_id)->with('error', 'Người dùng không tồn tại!');
        }

        $form_input_data = [];
        $validation_rules = [
            'firstname'  => 'max_length[255]',
            'lastname'   => 'max_length[255]',
            'email'      => 'valid_email',
            'address'    => 'max_length[255]',
        ];

        if ($request->getVar('firstname')) {
            $form_input_data['firstname'] = $request->getVar('firstname');
        }
        if ($request->getVar('lastname')) {
            $form_input_data['lastname'] = $request->getVar('lastname');
        }
        if ($request->getVar('email')) {
            $form_input_data['email'] = $request->getVar('email');
        }
        if ($request->getVar('role')) {
            $form_input_data['role'] = $request->getVar('role');
            if (!$group->find($form_input_data['role'])) {
                return redirect()->to('/admin/user/edit/id/' . $user_id)->with('error', 'Nhóm không hợp lệ!');
            }
        }
        if ($request->getVar('address')) {
            $form_input_data['address'] = $request->getVar('address');
        }
        if ($request->getVar('phone_no')) {
            $form_input_data['mobile_no'] = $request->getVar('phone_no');
        }

        $form_input_data['avatar'] = $request->getVar('thumbnail');
        $form_input_data['updated_at'] = date('Y-m-d H:i:s');

        $validation->setRules($validation_rules);
        if (!$validation->run($form_input_data)) {
            $errors = $validation->getErrors(); // Lấy ra danh sách lỗi
            return redirect()->to('/admin/user/edit/id/' . $user_id)
                             ->with('error', implode("<br>", $errors)) // Hiển thị các lỗi dưới dạng danh sách
                             ->withInput();
        }

        // Cập nhật thông tin người dùng
        $updateStatus = $user_model->update_user($user_id, $form_input_data);
        if (!$updateStatus) {
            return redirect()->to('/admin/user/edit/id/' . $user_id)
                             ->with('error', 'Lỗi hệ thống, vui lòng thử lại!');
        }

        return redirect()->to('/admin/user/edit/id/' . $user_id)->with('success', 'Sửa thông tin thành công!');
    }



        public function manage_users()
    {
        if (!hasPermission('manage_users')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền truy cập!');
        }

        return view('B/pages/user/user_list');
    }








}
