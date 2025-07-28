<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TourModel;
use App\Models\TourScheduleModel;
use App\Models\TourCategoryModel;
use App\Models\BookingModel; // Thêm model Booking
use Config\Services;

class TourApi extends ResourceController
{
    protected $modelName = 'App\Models\TourModel';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userId = $this->request->user ?? null;
        $cacheKey = "tours_index_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $tours = $userId ? $this->model->where('author_id', $userId)->findAll() : $this->model->findAll();
        foreach ($tours as &$tour) {
            $tour['schedules'] = $this->getSchedules($tour['id']);
            $tour['original_price'] = $tour['price']; // Giá gốc luôn bằng giá hiện tại
            if ($tour['discount'] > 0) {
                $tour['price'] = $tour['price'] * (1 - $tour['discount'] / 100); // Giá sau giảm
            }
        }

        $response = [
            'status' => 'success',
            'data' => $tours
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function bookTour()
    {
        $data = $this->request->getJSON(true);

        // Validate dữ liệu
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tour_id' => 'required|numeric',
            'customer_name' => 'required|string|max_length[255]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'required|string|max_length[20]',
            'quantity' => 'required|numeric|greater_than[0]'
        ]);

        if (!$validation->run($data)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $bookingModel = new BookingModel();
        $bookingData = [
            'tour_id' => $data['tour_id'],
            'customer_name' => $data['customer_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'quantity' => $data['quantity'],
            'status' => 'pending', // Trạng thái mặc định
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($bookingModel->insert($bookingData)) {
            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Đặt tour thành công',
                'data' => $bookingData
            ]);
        } else {
            return $this->fail('Không thể đặt tour, vui lòng thử lại.');
        }
    }

    public function category()
    {
        $userId = $this->request->user ?? null;
        $cacheKey = "tourcategories_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $categoryModel = new TourCategoryModel();
        $categories = $categoryModel->findAll();

        $response = [
            'status' => 'success',
            'data' => $categories
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function show($id = null)
    {
        $cacheKey = "tour_detail_{$id}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $tourModel = new TourModel();
        $categoryModel = new TourCategoryModel();

        $tour = $tourModel->find($id);
        if (!$tour) {
            return $this->failNotFound('Tour không tồn tại.');
        }

        $tour['schedules'] = $this->getSchedules($id);
        $tour['category'] = $categoryModel->find($tour['tourcategory_id']);

        $tour['original_price'] = $tour['price']; // Giá gốc luôn bằng giá hiện tại
        if ($tour['discount'] > 0) {
            $tour['price'] = $tour['price'] * (1 - $tour['discount'] / 100); // Giá sau giảm
        }


        $response = [
            'status' => 'success',
            'data' => $tour
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function toursByCategory($categoryId)
    {
        $cacheKey = "tours_by_category_{$categoryId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $tourModel = new TourModel();
        $categoryModel = new TourCategoryModel();

        $category = $categoryModel->find($categoryId);
        if (!$category) {
            return $this->failNotFound('Danh mục tour không tồn tại.');
        }

        $tours = $tourModel->where('tourcategory_id', $categoryId)
                           ->orderBy('created_at', 'DESC')
                           ->findAll();

        foreach ($tours as &$tour) {
            $tour['schedules'] = $this->getSchedules($tour['id']);
            $tour['original_price'] = $tour['price']; // Giá gốc luôn bằng giá hiện tại
            if ($tour['discount'] > 0) {
                $tour['price'] = $tour['price'] * (1 - $tour['discount'] / 100); // Giá sau giảm
            }
        }

        $response = [
            'status' => 'success',
            'category' => $category,
            'tours' => $tours
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function search()
    {
        $userId = $this->request->user ?? null;
        $query = $this->request->getGet('q');

        if (empty($query)) {
            return $this->respond(['status' => 'success', 'data' => []], 200);
        }

        $cacheKey = "tours_search_{$userId}_{$query}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $builder = $this->model;
        if ($userId) {
            $builder->where('author_id', $userId);
        }

        $builder->groupStart()
                ->like('name', $query)
                ->orLike('name_en', $query)
                ->groupEnd();

        $tours = $builder->findAll();
        foreach ($tours as &$tour) {
            $tour['schedules'] = $this->getSchedules($tour['id']);
        }

        $response = [
            'status' => 'success',
            'data' => $tours
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    public function advancedSearch()
    {
        $userId = $this->request->user ?? null;
        $isDomestic = $this->request->getGet('is_domestic');
        $departure = $this->request->getGet('departure');
        $destination = $this->request->getGet('destination');
        $startDate = $this->request->getGet('start_date');
        $duration = $this->request->getGet('duration');
        $isHot = $this->request->getGet('is_hot'); // Thêm tham số lọc tour hot
        $hasDiscount = $this->request->getGet('has_discount'); // Thêm tham số lọc tour khuyến mãi

        $cacheKey = "tours_advanced_search_" . md5(serialize($this->request->getGet()));
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $builder = $this->model->select('tours.*');
        $builder->join('tourcategories', 'tourcategories.id = tours.tourcategory_id');

        if ($userId) {
            $builder->where('author_id', $userId);
        }

        if ($isDomestic !== null) {
            $builder->where('tourcategories.is_domestic', $isDomestic);
        }

        if ($departure) {
            $builder->groupStart()
                    ->like('tours.itinerary', $departure)
                    ->orLike('tours.itinerary_en', $departure)
                    ->groupEnd();
        }

        if ($destination) {
            $builder->like('tours.location', $destination);
        }

        if ($startDate) {
            $builder->where('tours.start_date', $startDate);
        }

        if ($duration) {
            $builder->where('tours.duration', $duration);
        }

        // Lọc tour hot
        if ($isHot !== null) {
            $builder->where('tours.is_hot', $isHot);
        }

        // Lọc tour có khuyến mãi
        if ($hasDiscount === '1') {
            $builder->where('tours.discount >', 0);
        }

        $tours = $builder->findAll();
        foreach ($tours as &$tour) {
            $tour['schedules'] = $this->getSchedules($tour['id']);
            $tour['category'] = (new TourCategoryModel())->find($tour['tourcategory_id']);
            $tour['original_price'] = $tour['price']; // Giá gốc luôn bằng giá hiện tại
            if ($tour['discount'] > 0) {
                $tour['price'] = $tour['price'] * (1 - $tour['discount'] / 100); // Giá sau giảm
            }
        }

        $response = [
            'status' => 'success',
            'data' => $tours
        ];

        $this->cache->save($cacheKey, json_encode($response), 600);
        return $this->respond($response, 200);
    }

    protected function getSchedules($tourId)
    {
        $scheduleModel = new TourScheduleModel();
        return $scheduleModel->where('tour_id', $tourId)->orderBy('day_number', 'ASC')->findAll();
    }
}
