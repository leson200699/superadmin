<?php
namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use Config\Services;

class CourseApi extends ResourceController
{
    protected $modelName = 'App\Models\CourseModel';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    // Lấy danh sách khóa học
    public function index()
    {
        $userId = $this->request->user ?? 'all'; // Nếu không có user, dùng 'all'
        $cacheKey = "courses_index_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $courses = $this->model->findAll();
        $this->cache->save($cacheKey, json_encode($courses), 600); // Cache 10 phút

        return $this->respond($courses, 200);
    }

    // Lấy chi tiết khóa học + danh sách buổi học
    public function show($id = null)
    {
        $cacheKey = "course_detail_{$id}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $course = $this->model->find($id);
        if (!$course) {
            return $this->failNotFound('Course không tồn tại.');
        }

        $lessonModel = new \App\Models\LessonModel();
        $instructorModel = new \App\Models\InstructorModel();
        $lessons = $lessonModel->where('course_id', $id)->findAll();
        foreach ($lessons as &$lesson) {
            $instructor = $instructorModel->find($lesson['instructor_id']);
            $lesson['instructor_name'] = $instructor ? $instructor['name'] : 'Chưa xác định';
        }
        $course['lessons'] = $lessons;

        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $course]), 600);
        return $this->respond(['status' => 'success', 'data' => $course], 200);
    }
}