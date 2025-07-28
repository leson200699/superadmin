<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\News_Model;
use App\Models\ContactModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseFrontendController
{
    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new News_Model();
    }

    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè
        $newsList = $this->newsModel->get_news_by_user($userId);

        return view('F/' . $username . '/contact', [
            'newsList' => $newsList,
            'title' =>  'Danh sách tin tức',
        ]);
    }

    public function thank_you()
    {
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè

        return view('F/' . $username . '/thank_you', [
            'title' =>  'Cảm ơn bạn đã liên hệ',
        ]);
    }

   
    public function submit()
    {
        $validation = \Config\Services::validation();
        $data = $this->request->getPost([
            'name',
            'email',
            'message'
        ]);

        $rules = [
            'name'    => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'message' => 'required|min_length[10]',
        ];

        if (!$validation->setRules($rules)->run($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ])->setStatusCode(400); // dùng số trực tiếp thay vì ResponseInterface
        }

        // Lưu liên hệ
        $contactModel = new ContactModel();
        $contactModel->insert($data);
        $userEmail = $this->user['email'];
        // Gửi email
        $emailService = \Config\Services::email();
        $emailService->setTo($userEmail);
        $emailService->setSubject('Liên hệ từ website');
        $emailService->setMessage(
            "Tên: {$data['name']}\nEmail: {$data['email']}\n\nNội dung:\n{$data['message']}"
        );
        $emailService->setMailType('text');

        if (!$emailService->send()) {
            // Ghi log để debug dễ hơn
            log_message('error', $emailService->printDebugger(['headers', 'subject', 'body']));

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Không thể gửi email. Vui lòng thử lại sau.'
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Đã gửi liên hệ thành công.'
        ]);
    }





}
