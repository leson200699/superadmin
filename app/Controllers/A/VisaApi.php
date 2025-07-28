<?php
namespace App\Controllers\A;

use App\Controllers\BaseController;
use App\Models\VisaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class VisaController extends BaseController
{
    protected $visaModel;
    protected $cache;

    public function __construct()
    {
        $this->visaModel = new VisaModel();
        $this->cache = Services::cache(); // Sử dụng cache của CI4
    }

    public function createOrder()
    {
        try {
            $data = $this->request->getJSON(true);
            if (!$data) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON input'
                ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
            }

            $validation = \Config\Services::validation();
            $rules = [
                'email' => 'required|valid_email',
                'full_name' => 'required',
                'phone_number' => 'required',
                'travel_info' => 'required',
                'num_applicants' => 'required|integer|greater_than[0]',
                'visa_type' => 'required|in_list[tourist,business,student,other]',
                'purpose_entry' => 'required',
                'processing_time' => 'required|in_list[04-06_days,03_days,02_days]'
            ];

            if (!$validation->setRules($rules)->run($data)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $validation->getErrors()
                ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
            }

            $data['total_price'] = $this->visaModel->calculateTotalPrice($data);
            $orderId = $this->visaModel->insert($data);

            if (!$orderId) {
                log_message('error', 'Failed to insert order into database');
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to save order'
                ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
            }

            $response = [
                'status' => 'success',
                'order_id' => $orderId,
                'message' => 'Order created successfully'
            ];

            // Lưu vào cache với key duy nhất cho order
            $cacheKey = "visa_order_{$orderId}";
            $this->cache->save($cacheKey, json_encode($response), 3600); // Cache 1 giờ
            log_message('debug', "Cached order {$orderId} with key {$cacheKey}");

            return $this->response->setJSON($response)
                                 ->setStatusCode(ResponseInterface::HTTP_CREATED);

        } catch (\Exception $e) {
            log_message('error', 'CreateOrder Exception: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error'
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOrderDetail($orderId)
    {
        $order = $this->visaModel->find($orderId);
        if (!$order) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Order not found'
            ])->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        $files = $this->request->getFiles();
        $data = $this->request->getPost();

        // Xử lý upload file
        $passportFront = $files['passport_front'];
        $passportBack = $files['passport_back'];

        if (!$passportFront->isValid() || !$passportBack->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid file upload'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        $frontPath = $passportFront->store('passports/');
        $backPath = $passportBack->store('passports/');

        $detailData = [
            'passport_front' => $frontPath,
            'passport_back' => $backPath,
            'additional_info' => $data['additional_info'] ?? null
        ];

        $this->visaModel->saveDetail($orderId, $detailData);

        // Xóa cache khi cập nhật
        $cacheKey = "visa_order_{$orderId}";
        $this->cache->delete($cacheKey);
        log_message('debug', "Deleted cache for order {$orderId} with key {$cacheKey}");

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Order detail updated successfully',
            'total_price' => $order['total_price']
        ])->setStatusCode(ResponseInterface::HTTP_OK);
    }

    public function getOrder($orderId)
    {
        $cacheKey = "visa_order_{$orderId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            log_message('debug', "Cache hit for order {$orderId}");
            return $this->response->setJSON(json_decode($cachedData, true))
                                 ->setStatusCode(ResponseInterface::HTTP_OK);
        }

        $order = $this->visaModel->find($orderId);
        if (!$order) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Order not found'
            ])->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
        }

        $response = [
            'status' => 'success',
            'data' => $order
        ];

        $this->cache->save($cacheKey, json_encode($response), 3600);
        log_message('debug', "Cached order {$orderId} with key {$cacheKey}");

        return $this->response->setJSON($response)
                             ->setStatusCode(ResponseInterface::HTTP_OK);
    }
}