<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Models\Customer_Message_Model;

class Customer extends ResourceController
{
    protected $modelName = 'App\\Models\\Customer_Message_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function create()
    {
        // Lấy dữ liệu từ request
        $data = $this->request->getJSON(true);
        // Validate dữ liệu
        if (!$this->validate($validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors(), 400);
        }

        // Thêm user_id từ authentication (nếu có)
        if ($this->request->user) {
            $data['user_id'] = $this->request->user;
        }

        // Thêm các field khác nếu cần
        $data['created_at'] = date('Y-m-d H:i:s');
        
        try {
            // Lưu vào database
            $id = $this->model->insert($data);
            
            if ($id) {
                // Xóa cache cũ nếu có
                $cacheKey = "slider_list_" . ($data['user_id'] ?? 'all');
                $this->cache->delete($cacheKey);

                // Lấy dữ liệu vừa tạo để trả về
                $newSlider = $this->model->find($id);
                
                return $this->respondCreated([
                    'status' => 'success',
                    'message' => 'Slider created successfully',
                    'data' => $newSlider
                ]);
            }
            
            return $this->fail('Failed to create slider', 500);
            
        } catch (\Exception $e) {
            return $this->failServerError('Error: ' . $e->getMessage());
        }
    }
}