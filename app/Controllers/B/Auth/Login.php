<?php

namespace App\Controllers\B\Auth;

use App\Controllers\B\User;
use App\Models\User_Model;
use CodeIgniter\Controller;
use Config\Services;
use Google_Client;

class Login extends Controller
{
    private $form_page = 'B/pages/auth/login';
    public function __construct()
    {
        helper(['session_helper', 'response_helper']);
    }

    public function index()
    {
        $data['google_login_url'] = $this->getGoogleLoginUrl();
        echo view($this->form_page, $data);
    }

    // Đăng nhập thông thường
    public function login()
    {
        $validation = Services::validation();

        $validation_rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]|max_length[255]'
        ];

        $form_input_data['email']    = $this->request->getVar('email');
        $form_input_data['password'] = $this->request->getVar('password');

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin đăng nhập không hợp lệ');
        }

        $userModel = new User_Model();
        $user      = $userModel->getRowData('email', $form_input_data['email']);

        if (!$user) {
            return redirect_with_message('error', 'Email không tồn tại');
        }

        if (!password_verify($form_input_data['password'], $user->password)) {
            return redirect_with_message('error', 'Mật khẩu không đúng');
        }

        set_session_data('user', $user);
        return redirect_with_message_url('success', 'Đăng nhập thành công', 'dashboard');
    }

    // Tạo URL đăng nhập Google
    private function getGoogleLoginUrl()
    {
        $client = new Google_Client();
        $client->setClientId(config('Google')->clientId);
        $client->setClientSecret(config('Google')->clientSecret);
        $client->setRedirectUri(config('Google')->redirectUri);
        $client->addScope('email');
        $client->addScope('profile');

        return $client->createAuthUrl();
    }

    // Callback xử lý sau khi đăng nhập Google
    public function googleCallback()
    {
        $client = new Google_Client();
        $client->setClientId(config('Google')->clientId);
        $client->setClientSecret(config('Google')->clientSecret);
        $client->setRedirectUri(config('Google')->redirectUri);

        if ($this->request->getVar('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            $client->setAccessToken($token);

            // Lấy thông tin người dùng từ Google
            $googleService = new \Google_Service_Oauth2($client);
            $userInfo = $googleService->userinfo->get();

            $email = $userInfo->email;
            $name = $userInfo->name;

            $userModel = new User_Model();
            $user = $userModel->getRowData('email', $email);

            if (!$user) {
                // Nếu không có người dùng trong hệ thống, trả về thông báo lỗi
                return redirect_with_message('error', 'Email không tồn tại trong hệ thống');
            }

            // Lưu thông tin vào session nếu đăng nhập thành công
            set_session_data('user', $user);
            return redirect_with_message_url('success', 'Đăng nhập bằng Google thành công', 'dashboard');
        } else {
            return redirect_with_message('error', 'Đăng nhập Google thất bại');
        }
    }


    public function logout()
    {
        helper('session_helper');
        remove_session_data('user');

        if (check_session_data_exist('user')) {
            return redirect_with_message('error', 'Không đăng xuất được, vui lòng liên hệ admin!');
        }

        return redirect_with_message_url('success', 'Đăng xuất thành công', 'admin-login');
    }
}