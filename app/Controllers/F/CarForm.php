<?php

namespace App\Controllers\F;

use App\Models\CarFormModel;
use CodeIgniter\HTTP\RedirectResponse;
use App\Controllers\F\BaseFrontendController;
use Config\Services;

class CarForm extends BaseFrontendController
{
    protected $validation;
    protected $carFormModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->carFormModel = new CarFormModel();
    }

    // Hiển thị form Đăng ký lái thử
    public function test_drive(): string
    {
        return view('F/' . $this->user['username'] . '/forms/test_drive');
    }

    // Hiển thị form Đặt lịch dịch vụ
    public function service_appointment(): string
    {
        return view('F/' . $this->user['username'] . '/forms/service_appointment');
    }

    // Hiển thị form Yêu cầu báo giá
    public function quote_request(): string
    {
        return view('F/' . $this->user['username'] . '/forms/quote_request');
    }

    // Xử lý submit từ tất cả form (dựa trên hidden field 'form_type')
    public function submit(): RedirectResponse
    {
        $post = $this->request->getPost();
        $formType = (int) $post['form_type'] ?? 0;

        // Quy tắc validation chung
        $this->validation->setRules([
            'full_name' => 'required|min_length[3]',
            // 'phone' => 'required|min_length[9]|max_length[15]',
            // 'email' => 'required|valid_email',
        ]);

        // Quy tắc riêng dựa trên form_type
        switch ($formType) {
            case 1: // Lái thử
                $this->validation->setRules([
                    'province_city' => 'required',
                    'dealer' => 'required',
                    'car_model' => 'required',
                    'test_drive_time' => 'required|valid_date',
                ]);
                break;
            case 2: // Dịch vụ
                $this->validation->setRules([
                    'license_plate' => 'required',
                    'car_model' => 'required',
                    'service_type' => 'required', // Kiểm tra mảng không rỗng
                    'appointment_time' => 'required|valid_date',
                ]);
                break;
            case 3: // Báo giá
                $this->validation->setRules([
                    'province_city' => 'required',
                    'dealer' => 'required',
                    'car_model' => 'required',
                    'version' => 'required',
                    'color' => 'required',
                    'payment_type' => 'required',
                ]);
                break;

            case 4: // DK tư vấn
                $this->validation->setRules([
                     'phone' => 'required',
                ]);

                break;
            default:
                return redirect()->back()->with('error', 'Loại form không hợp lệ.');
        }

        if (!$this->validation->run($post)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Chuẩn bị data (lọc null cho trường không dùng)
        $serviceType = null;
        if (isset($post['service_type']) && is_array($post['service_type'])) {
            $serviceType = implode(', ', $post['service_type']);
        } elseif (isset($post['service_type'])) {
            $serviceType = $post['service_type'];
        }

        $data = array_filter([
            'full_name' => $post['full_name'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'province_city' => $post['province_city'] ?? null,
            'dealer' => $post['dealer'] ?? null,
            'car_model' => $post['car_model'] ?? null,
            'test_drive_time' => $post['test_drive_time'] ?? null,
            'license_plate' => $post['license_plate'] ?? null,
            'service_type' => $serviceType ?? null,
            'appointment_time' => $post['appointment_time'] ?? null,
            'version' => $post['version'] ?? null,
            'color' => $post['color'] ?? null,
            'payment_type' => $post['payment_type'] ?? null,
            'note' => $post['note'] ?? null,
        ]);

        // Insert qua model
        $insertId = $this->carFormModel->insertFormData($data, $formType);

        if ($insertId > 0) {
            return redirect()->to('/thank-you')->with('success', 'Đăng ký thành công! ID: ' . $insertId);
        } else {
            return redirect()->back()->with('error', 'Lỗi khi lưu dữ liệu.');
        }
    }
}