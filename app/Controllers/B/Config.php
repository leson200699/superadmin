<?php

namespace App\Controllers\B;

use App\Models\Config_Model;
use App\Models\Landing_Model;
use CodeIgniter\Controller;
use Config\Services;

class Config extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    public function contact()
    {
        // Khởi tạo model
        $config_model = new Config_Model();

        // Lấy userID từ session
        $userID = get_user_data('id');

        // Kiểm tra xem có dữ liệu của user trong bảng 'config' chưa
        $contact_info = $config_model->where('author', $userID)->first(); // Lấy dữ liệu của user hiện tại

        // Nếu chưa có thông tin liên hệ, tạo dữ liệu random
        if (!$contact_info) {
            // Tạo dữ liệu random
            $contact_info = [
                'website_name' => 'Website ' . rand(1000, 9999), // Tạo tên website random
                'slogan' => 'Slogan ' . rand(1000, 9999),
                'website_intro' => 'Giới thiệu về website ' . rand(1000, 9999),
                'hotline' => '090' . rand(1000000, 9999999), // Tạo hotline random
                'email' => 'example' . rand(1, 1000) . '@example.com',
                'address' => 'Địa chỉ ' . rand(1, 100),
                'domain' => 'http://website' . rand(1, 1000) . '.com',
                'copyright' => '© 2025 Website ' . rand(1, 1000),
                'author' => $userID,
                'logo' => 'Logo ' . rand(1000, 9999),
                'favicon' => 'Favicon ' . rand(1000, 9999),
                'logo_footer' => 'Logo footer' . rand(1000, 9999),
                'seo_title' => 'Seo title ' . rand(1000, 9999),
                'seo_keyword' => 'Seo keyword ' . rand(1000, 9999),
                'seo_description' => 'Seo description ' . rand(1000, 9999),
                'facebook' => 'facebook ' . rand(1000, 9999),
                'zalo' => 'Zalo ' . rand(1000, 9999),
                'tiktok' => 'Tiktok description ' . rand(1000, 9999),
                'youtube' => 'Youtube description ' . rand(1000, 9999),
            ];

            // Insert dữ liệu mới vào bảng
            $config_model->insert($contact_info);

            // Sau khi insert thành công, lấy lại thông tin đã insert để hiển thị
            $contact_info = $config_model->where('author', $userID)->first();
        }

        // Dữ liệu trả về view
        $view_data = [
            'title' => 'Thông tin liên hệ',
            'contact_info' => $contact_info
        ];

        // Hiển thị view
        echo view("B/pages/config/config_contact", $view_data);
    }


    public function post_update_contact()
    {
        $validation = Services::validation();

        // Đặt các quy tắc xác thực
        $validate_rules = [];
        $this->request->getVar('website_name') ? $validate_rules['website_name'] = 'max_length[255]' : false;
        $this->request->getVar('slogan') ? $validate_rules['slogan'] = 'max_length[255]' : false;
        $this->request->getVar('website_intro') ? $validate_rules['website_intro'] = 'max_length[255]' : false;
        $this->request->getVar('email') ? $validate_rules['email'] = 'valid_email' : false;
        $this->request->getVar('address') ? $validate_rules['address'] = 'max_length[255]' : false;
        $this->request->getVar('domain') ? $validate_rules['domain'] = 'valid_url|max_length[255]' : false;
        $this->request->getVar('copyright') ? $validate_rules['copyright'] = 'max_length[255]' : false;
        $this->request->getVar('logo') ? $validate_rules['logo'] = 'max_length[255]' : false;
        $this->request->getVar('favicon') ? $validate_rules['favicon'] = 'max_length[255]' : false;
        $this->request->getVar('logo_footer') ? $validate_rules['logo_footer'] = 'max_length[255]' : false;
        $this->request->getVar('seo_title') ? $validate_rules['seo_title'] = 'max_length[255]' : false;
        $this->request->getVar('seo_keyword') ? $validate_rules['seo_keyword'] = 'max_length[255]' : false;
        $this->request->getVar('seo_description') ? $validate_rules['seo_description'] = 'max_length[255]' : false;

        // Lấy userID từ session
        $userID = get_user_data('id');

        // Dữ liệu từ form
        $form_input_data = [
            'website_name' => $this->request->getVar('website_name'),
            'slogan' => $this->request->getVar('slogan'),
            'website_intro' => $this->request->getVar('website_intro'),
            'hotline' => $this->request->getVar('hotline'),
            'email' => $this->request->getVar('email'),
            'address' => $this->request->getVar('address'),
            'domain' => $this->request->getVar('domain'),
            'copyright' => $this->request->getVar('copyright'),
            'author' => $userID,
            'logo' => $this->request->getVar('logo'),
            'favicon' => $this->request->getVar('favicon'),
            'logo_footer' => $this->request->getVar('logo_footer'),
            'seo_title' => $this->request->getVar('seo_title'),
            'seo_keyword' => $this->request->getVar('seo_keyword'),
            'seo_description' => $this->request->getVar('seo_description'),

            'facebook' => $this->request->getVar('facebook'),
            'zalo' => $this->request->getVar('zalo'),
            'tiktok' => $this->request->getVar('tiktok'),
            'youtube' => $this->request->getVar('youtube'),
        ];

        // Lọc bỏ các giá trị null
        $form_input_data = array_filter($form_input_data);

        // Xác thực
        $validation->setRules($validate_rules);
        if (!$validation->run($form_input_data)) {
            // Nếu có lỗi xác thực
            return redirect()->back()->with('error', 'Thông tin nhập không hợp lệ!');
        }

        $config_model = new Config_Model();

        // Kiểm tra xem người dùng đã có thông tin liên hệ chưa
        $existing_contact = $config_model->where('author', $userID)->first();

        if ($existing_contact) {
            // Nếu đã có thông tin, cập nhật
            $update_status = $config_model->update($existing_contact['id'], $form_input_data);


            $this->cache->delete("config_index_{$userID}");

            if ($update_status) {
                return redirect_with_message_url('success', 'Sửa thông tin thành công!', 'admin-config-contact');
            } else {
                return redirect_with_message_url('error', 'Cập nhật không thành công!', 'admin-config-contact');
            }
        } else {
            // Nếu chưa có thông tin, tạo mới
            $create_status = $config_model->insert($form_input_data);
            if ($create_status) {
                return redirect()->back()->with('success', 'Tạo mới thông tin thành công!');
            } else {
                return redirect()->back()->with('error', 'Tạo mới không thành công!');
            }
        }
    }



    public function google_map()
    {
        $config_model = new Config_Model();
        $columns      = 'map';
        $view_data    = [
            'title'      => 'Google Map',
            'config_map' => $config_model->get_config($columns)

        ];
        echo view("B/pages/config/config_map", $view_data);
    }

    public function post_update_google_map()
    {
        $validation = Services::validation();

        $validation_rules['map'] = 'required';

        $form_input_data['map'] = $this->request->getVar('map');

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin nhập không hợp lệ!');
        }

        $config_model  = new Config_Model();
        $update_status = $config_model->update_config_info($form_input_data);

        if ($update_status === true) {
            return redirect_with_message('success', 'Sửa thông tin thành công!');
        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }

    public function social_network()
    {
        $config_model = new Config_Model();
        $columns      = 'facebook, zalo, skype, youtube';
        $view_data    = [
            'title'       => 'Mạng xã hội',
            'social_info' => $config_model->get_config($columns)

        ];
        echo view("B/pages/config/config_social", $view_data);

    }


    public function introduction()
    {

        $landing_intro = new Landing_model();
        $view_data     = [
            'title'    => 'Giới thiệu',
            'intro'    => $landing_intro->where('id', 12)->get()->getRow(),
            'tam_nhin' => $landing_intro->select('content')->where('id', 13)->get()->getRow(),
            'su_menh'  => $landing_intro->select('content')->where('id', 14)->get()->getRow(),
            'gia_tri'  => $landing_intro->select('content')->where('id', 15)->get()->getRow(),
            'intro_en'    => $landing_intro->select('content_en')->where('id', 12)->get()->getRow(),
            'tam_nhin_en' => $landing_intro->select('content_en')->where('id', 13)->get()->getRow(),
            'su_menh_en'  => $landing_intro->select('content_en')->where('id', 14)->get()->getRow(),
            'gia_tri_en'  => $landing_intro->select('content_en')->where('id', 15)->get()->getRow()
        ];
        echo view("B/pages/config/config_intro", $view_data);
    }

    public function about_us()
    {

        $landing_intro = new Landing_model();
        $view_data     = [
            'title'    => 'Giới thiệu',
            'intro'    => $landing_intro->where('id', 12)->get()->getRow(),
            'tam_nhin' => $landing_intro->select('content')->where('id', 13)->get()->getRow(),
            'su_menh'  => $landing_intro->select('content')->where('id', 14)->get()->getRow(),
            'gia_tri'  => $landing_intro->select('content')->where('id', 15)->get()->getRow(),


            'intro_en'    => $landing_intro->select('content_en')->where('id', 12)->get()->getRow(),
            'tam_nhin_en' => $landing_intro->select('content_en')->where('id', 13)->get()->getRow(),
            'su_menh_en'  => $landing_intro->select('content_en')->where('id', 14)->get()->getRow(),
            'gia_tri_en'  => $landing_intro->select('content_en')->where('id', 15)->get()->getRow(),
        ];
        echo view("B/pages/config/config_about", $view_data);
    }

    public function post_introduction($id)
    {
        $form_input_data['content'] = $this->request->getVar('content');
        $form_input_data['content_en'] = $this->request->getVar('content_en');

        $landing_model = new Landing_model();

        // Kiểm tra tồn tại dữ liệu dựa trên ID
        $check_exist_intro_data = $landing_model->find($id);

        if ($check_exist_intro_data) {
            $landing_model->update($id, $form_input_data);
            return redirect_with_message('success', 'Cập nhật thành công');
        }

        return redirect_with_message('error', 'Không tìm thấy dữ liệu cần cập nhật');
    }
}
