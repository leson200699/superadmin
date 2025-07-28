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
        $this->cache = Services::cache();
    }

    public function createOrder()
    {
        $data = $this->request->getJSON(true);
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
        $data['status'] = 'pending';
        $orderId = $this->visaModel->insert($data);

        if (!$orderId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to save order'
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        $cacheKey = "visa_order_{$orderId}";
        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $data]), 3600);

        return $this->response->setJSON([
            'status' => 'success',
            'data' => ['order_id' => $orderId]
        ])->setStatusCode(ResponseInterface::HTTP_CREATED);
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
        $passportFront = $files['passport_front'] ?? null;
        $passportBack = $files['passport_back'] ?? null;

        if (!$passportFront || !$passportFront->isValid() || !$passportBack || !$passportBack->isValid()) {
            log_message('error', "Invalid file upload for order {$orderId}: " . json_encode($files));
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Vui lòng upload cả hai mặt passport hợp lệ'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Kiểm tra và lưu file
        $uploadPath = WRITEPATH . 'uploads/48/passports/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $frontPath = $passportFront->store('passports/', 'front_' . $orderId . '_' . $passportFront->getRandomName());
        $backPath = $passportBack->store('passports/', 'back_' . $orderId . '_' . $passportBack->getRandomName());

        if (!$frontPath || !$backPath) {
            log_message('error', "Failed to store files for order {$orderId}: frontPath={$frontPath}, backPath={$backPath}");
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Không thể lưu file passport'
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        $detailData = [
            'passport_front' => $frontPath,
            'passport_back' => $backPath,
            'additional_info' => $this->request->getPost('additional_info') ?? null
        ];

        log_message('debug', "Saving detail for order {$orderId}: " . json_encode($detailData));

        if (!$this->visaModel->saveDetail($orderId, $detailData)) {
            log_message('error', "Failed to save detail for order {$orderId}");
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Không thể lưu chi tiết đơn visa'
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        $cacheKey = "visa_order_{$orderId}";
        $this->cache->delete($cacheKey);

        $updatedOrder = $this->visaModel->find($orderId);
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $updatedOrder
        ])->setStatusCode(ResponseInterface::HTTP_OK);
    }

    public function getOrder($orderId)
    {
        $cacheKey = "visa_order_{$orderId}";
        if ($cachedData = $this->cache->get($cacheKey)) {
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
        return $this->response->setJSON($response)
                             ->setStatusCode(ResponseInterface::HTTP_OK);
    }
}