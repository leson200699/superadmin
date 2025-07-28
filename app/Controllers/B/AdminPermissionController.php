<?php

namespace App\Controllers\B;

use App\Models\PermissionModel;
use App\Models\User_Group_Model;
use App\Models\User_Model;
use CodeIgniter\Controller;
use Config\Services;

class AdminPermissionController extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    // Hiển thị danh sách quyền
    public function list_permissions()
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $permModel = new PermissionModel();
        $groupModel = new User_Group_Model();
        $userModel = new User_Model();

        $permissions = $permModel->getAllPermissions(); // Lấy danh sách quyền
        $groups = $groupModel->findAll(); // Lấy danh sách nhóm
        $users = $userModel->findAll(); // Lấy danh sách user

        return view("B/pages/permissions/list_permissions", [
            'title' => 'Quản lý quyền',
            'permissions' => $permissions,
            'groups' => $groups,
            'users' => $users, // Truyền danh sách user vào view
        ]);
    }


    // Thêm quyền mới
    public function create_permission()
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        return view("B/pages/permissions/create_permission", [
            'title' => 'Thêm quyền mới'
        ]);
    }


    public function post_create_permission()
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $permModel = new PermissionModel();
        $validation = Services::validation();

        $validation->setRules([
            'perm_name' => 'required|max_length[255]|is_unique[sys_permissions.perm_name]',
            'perm_desc' => 'max_length[500]'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to('/admin/permissions/create')->with('error', 'Dữ liệu không hợp lệ!');
        }

        $permModel->insert([
            'perm_name' => $this->request->getVar('perm_name'),
            'perm_desc' => $this->request->getVar('perm_desc')
        ]);

        return redirect()->to('/admin/permissions')->with('success', 'Thêm quyền thành công!');
    }


    // Hiển thị trang gán quyền
    public function assign_permissions()
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $permModel = new PermissionModel();
        $groupModel = new User_Group_Model();
        $userModel = new User_Model();

        return view("B/pages/permissions/assign_permissions", [
            'title' => 'Gán quyền',
            'permissions' => $permModel->getAllPermissions(),
            'groups' => $groupModel->findAll(),
            'users' => $userModel->findAll(),
        ]);
    }


    // Gán quyền cho nhóm
    public function assign_role_permissions()
    {
        if (!hasPermission('manage_roles')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $roleId = $this->request->getVar('role_id');
        $permissions = $this->request->getVar('permissions');

        $permModel = new PermissionModel();
        $permModel->assignRolePermissions($roleId, $permissions);

        return redirect()->to('/admin/permissions')->with('success', 'Gán quyền cho nhóm thành công!');
    }

    // Gán quyền trực tiếp cho user
    public function assign_user_permissions()
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $userId = $this->request->getVar('user_id');
        $permissions = $this->request->getVar('permissions');

        $permModel = new PermissionModel();
        $permModel->assignUserPermissions($userId, $permissions);

        return redirect()->to('/admin/permissions')->with('success', 'Gán quyền cho user thành công!');
    }




    public function view_role_permissions($roleId)
    {
        if (!hasPermission('manage_roles')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $permModel = new PermissionModel();
        $groupModel = new User_Group_Model();

        $group = $groupModel->find($roleId);
        if (!$group) {
            return redirect()->to('/admin/assign-permissions')->with('error', 'Nhóm không tồn tại!');
        }

        $permissions = $permModel->getPermissionsByRole($roleId);

        return view("B/pages/permissions/view_role_permissions", [
            'title' => "Quyền của nhóm: " . $group['group_name'],
            'group' => $group,
            'permissions' => $permissions
        ]);
    }

    public function view_user_permissions($userId)
    {
        if (!hasPermission('manage_permissions')) {
            return redirect()->to('/dashboard')->with('error', 'Bạn không có quyền!');
        }

        $permModel = new PermissionModel();
        $userModel = new User_Model();

        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/assign-permissions')->with('error', 'Người dùng không tồn tại!');
        }

        $permissions = $permModel->getPermissionsByUser($userId);

        return view("B/pages/permissions/view_user_permissions", [
            'title' => "Quyền của user: " . $user['email'],
            'user' => $user,
            'permissions' => $permissions
        ]);
    }

}
