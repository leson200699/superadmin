<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\TourModel;
use App\Models\TourScheduleModel;
use App\Models\TourCategoryModel;

class TourController extends BaseController
{
    protected $tourModel;
    protected $scheduleModel;
    protected $tourCategoryModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
        $this->scheduleModel = new TourScheduleModel();
        $this->tourCategoryModel = new TourCategoryModel();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $builder = $this->tourModel->select('tours.*');
        $builder->join('tourcategories', 'tourcategories.id = tours.tourcategory_id');

        // Lọc theo trong nước/quốc tế
        if ($isDomestic = $this->request->getGet('is_domestic')) {
            $builder->where('tourcategories.is_domestic', $isDomestic);
        }

        // Lọc theo nơi khởi hành
        if ($departure = $this->request->getGet('departure')) {
            $builder->groupStart()
                    ->like('tours.itinerary', $departure)
                    ->orLike('tours.itinerary_en', $departure)
                    ->groupEnd();
        }

        // Lọc theo điểm đến
        if ($destination = $this->request->getGet('destination')) {
            $builder->like('tours.location', $destination);
        }

        // Lọc theo ngày đi
        if ($startDate = $this->request->getGet('start_date')) {
            $builder->where('tours.start_date', $startDate);
        }

        // Lọc theo số ngày đi
        if ($duration = $this->request->getGet('duration')) {
            $builder->where('tours.duration', $duration);
        }

        $data['tours'] = $builder->findAll();
        $data['lang'] = session()->get('lang') ?? 'vi';
        $data['title'] = 'Tour list';
        return view('B/pages/tour/index', $data);
    }

    public function create()
    {
        $data['tourcategories'] = $this->tourCategoryModel->findAll();
        $data['title'] = 'Tour create';
        return view('B/pages/tour/create', $data);
    }

public function store()
    {
        $user = session()->get('user');
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Vui lòng đăng nhập để tạo tour.');
        }

        $data = [
            'author_id' => $user->id,
            'tourcategory_id' => $this->request->getPost('tourcategory_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'start_date' => $this->request->getPost('start_date'),
            'duration' => $this->request->getPost('duration'),
            'location' => $this->request->getPost('location'),
            'thumbnail' => $this->request->getPost('thumbnail'), // Thêm thumbnail
            'itinerary' => $this->request->getPost('itinerary'),
            'transport' => $this->request->getPost('transport'),
            'notes' => $this->request->getPost('notes'),
            'name_en' => $this->request->getPost('name_en'),
            'description_en' => $this->request->getPost('description_en'),
            'itinerary_en' => $this->request->getPost('itinerary_en'),
            'notes_en' => $this->request->getPost('notes_en'),
            'alias' => $this->request->getPost('alias'),
            'multiple_image' => $this->request->getVar('gallery_image_ids'),

            'is_hot' => $this->request->getPost('is_hot') ? 1 : 0,
            'discount' => $this->request->getPost('discount') ?: 0.00,
            'created_at' => date('Y-m-d H:i:s'),



        ];

        $tourId = $this->tourModel->insert($data);

        $days = $this->request->getPost('day_number');
        $schedules = $this->request->getPost('schedule');
        $schedulesEn = $this->request->getPost('schedule_en');
        if ($days && $schedules) {
            foreach ($days as $index => $day) {
                $this->scheduleModel->insert([
                    'tour_id' => $tourId,
                    'day_number' => $day,
                    'schedule' => $schedules[$index],
                    'schedule_en' => $schedulesEn[$index] ?? null,
                ]);
            }
        }

        return redirect()->to('/admin/tours')->with('success', 'Tour đã được tạo thành công.');
    }

    public function edit($id)
    {
        $user = session()->get('user');
        $tour = $this->tourModel->find($id);
        if (!$user || $tour['author_id'] != $user->id) {
            return redirect()->to('/tours')->with('error', 'Bạn không có quyền chỉnh sửa tour này.');
        }
        $data['title'] = 'Tour edit';
        $data['tour'] = $tour;
        $data['schedules'] = $this->scheduleModel->getSchedulesByTour($id);
        $data['tourcategories'] = $this->tourCategoryModel->findAll();
        return view('B/pages/tour/edit', $data);
    }

    public function update($id)
    {
        $user = session()->get('user');
        $tour = $this->tourModel->find($id);
        if (!$user || $tour['author_id'] != $user->id) {
            return redirect()->to('/tours')->with('error', 'Bạn không có quyền chỉnh sửa tour này.');
        }

        $data = [
            'tourcategory_id' => $this->request->getPost('tourcategory_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'start_date' => $this->request->getPost('start_date'),
            'duration' => $this->request->getPost('duration'),
            'location' => $this->request->getPost('location'),
            'thumbnail' => $this->request->getPost('thumbnail'), // Thêm thumbnail
            'itinerary' => $this->request->getPost('itinerary'),
            'transport' => $this->request->getPost('transport'),
            'notes' => $this->request->getPost('notes'),
            'name_en' => $this->request->getPost('name_en'),
            'description_en' => $this->request->getPost('description_en'),
            'itinerary_en' => $this->request->getPost('itinerary_en'),
            'notes_en' => $this->request->getPost('notes_en'),
            'is_hot' => $this->request->getPost('is_hot') ? 1 : 0,
            'discount' => $this->request->getPost('discount') ?: 0.00,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->tourModel->update($id, $data);

        $this->scheduleModel->where('tour_id', $id)->delete();
        $days = $this->request->getPost('day_number');
        $schedules = $this->request->getPost('schedule');
        $schedulesEn = $this->request->getPost('schedule_en');
        if ($days && $schedules) {
            foreach ($days as $index => $day) {
                $this->scheduleModel->insert([
                    'tour_id' => $id,
                    'day_number' => $day,
                    'schedule' => $schedules[$index],
                    'schedule_en' => $schedulesEn[$index] ?? null,
                ]);
            }
        }

        return redirect()->to('/admin/tours')->with('success', 'Tour đã được cập nhật.');
    }

    public function view($id)
    {   
        $data['title'] = 'Tour views';
        $data['tour'] = $this->tourModel->getTourWithSchedules($id);
        $data['schedules'] = $this->scheduleModel->getSchedulesByTour($id);
        $data['lang'] = session()->get('lang') ?? 'vi';
        return view('B/pages/tour/view', $data);
    }
}