<?php

namespace App\Controllers\B;

use App\Models\Slideshow_Model;
use CodeIgniter\Controller;
use Config\Services;

class Slideshow extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->cache = Services::cache();
        $this->user = session()->get('user');
    }

    public function get_slideshow_list()
    {
        $user = session()->get('user');
        $model = new Slideshow_Model();

        $view_data = [
            'title'          => 'Danh sách slideshow',
            'slideshow_list' => $model->getSlideshows(get_user_data('id'))
        ];

        echo view("B/pages/slideshow/slideshow_list", $view_data);
    }

    public function create_slideshow()
    {
        $view_data = [
            'title' => 'Thêm mới slideshow',
        ];

        echo view("B/pages/slideshow/slideshow_create", $view_data);
    }

    public function post_create_slideshow()
    {
        $user = session()->get('user');
        $validation = Services::validation();

        $validation_rules = [
            'name'   => 'required|max_length[255]|is_unique[slideshow.name]',
            'status' => 'required|is_natural|less_than_equal_to[1]'
        ];
        if ($this->request->getVar('caption')) {
            $validation_rules['caption'] = 'max_length[255]';
        }

        $form_input_data = array_filter([
            'name'       => $this->request->getVar('name'),
            'name_en'    => $this->request->getVar('name_en'),
            'caption'    => $this->request->getVar('caption'),
            'caption_en' => $this->request->getVar('caption_en'),
            'thumbnail'  => $this->request->getVar('thumbnail'),
            'link'       => $this->request->getVar('link'),
            'video'      => $this->request->getVar('video'),
            'status'     => $this->request->getVar('status'),
            'author'     => get_user_data('id')
        ]);

        $validation->setRules($validation_rules);
        if (!$validation->run($form_input_data)) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', 'admin-slideshow-list');
        }

        if (!$this->request->getVar('thumbnail')) {
            return redirect_with_message_url('error', 'Vui lòng chọn ảnh!','admin-slideshow-list');
        }

        $slideshow_model = new Slideshow_Model();
        $insert_id = $slideshow_model->insert_slideshow_get_id($form_input_data);

        if ($insert_id) {
            return redirect_with_message_url('success', 'Tạo slideshow thành công!', 'admin-slideshow-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-slideshow-list');
    }

    public function edit_slideshow($id)
    {
        $slideshow_model = new Slideshow_Model();
        $slideshow_data = $slideshow_model->find($id);

        if (!$slideshow_data) {
            return redirect_with_message_url('error', 'Slideshow không tồn tại!', 'admin-slideshow-list');
        }

        $view_data = [
            'title'          => 'Chỉnh sửa slideshow',
            'slideshow_data' => $slideshow_data
        ];

        echo view("B/pages/slideshow/slideshow_edit", $view_data);
    }

    public function post_edit_slideshow()
    {
        $slideshow_id = $this->request->getVar('id');
        $slideshow_model = new Slideshow_Model();
  
        $validation = Services::validation();
        $validation_rules = [
            'name'   => 'required|max_length[255]',
            'status' => 'required|is_natural|less_than_equal_to[1]'
        ];
        if ($this->request->getVar('caption')) {
            $validation_rules['caption'] = 'max_length[255]';
        }

        $form_input_data = array_filter([
            'name'       => $this->request->getVar('name'),
            'name_en'    => $this->request->getVar('name_en'),
            'caption'    => $this->request->getVar('caption'),
            'caption_en' => $this->request->getVar('caption_en'),
            'thumbnail'  => $this->request->getVar('thumbnail'),
            'link'       => $this->request->getVar('link'),
            'video'      => $this->request->getVar('video'),
            'status'     => $this->request->getVar('status')
        ]);

        $validation->setRules($validation_rules);
        if (!$validation->run($form_input_data)) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', 'admin-slideshow-list');
        }

        $update_status = $slideshow_model->update_slideshow($slideshow_id, $form_input_data);
        if ($update_status) {
            $this->cache->delete("slider_list_{$this->user->id}");
            return redirect_with_message_url('success', 'Sửa slideshow thành công!', 'admin-slideshow-list');
        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }

    public function delete_slideshow($id)
    {
        $slideshow_model = new Slideshow_Model();
        $delete_status = $slideshow_model->delete_slideshow($id);

        if ($delete_status) {
            return redirect_with_message_url('success', 'Xóa slideshow thành công!', 'admin-slideshow-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-slideshow-list');
    }
}