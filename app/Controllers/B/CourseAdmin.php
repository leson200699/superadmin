<?php
namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\LessonModel;
use App\Models\InstructorModel;
use Config\Services;

class CourseAdmin extends BaseController
{
    protected $courseModel;
    protected $lessonModel;
    protected $instructorModel;
    protected $cache;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->instructorModel = new InstructorModel();
        $this->cache = Services::cache();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    // Danh sách khóa học
      public function index()
    {
        $user = session()->get('user');
        $data['courses'] = $this->courseModel->where('author', $user->id)->findAll();
        $data['title'] = "Courses";
        return view('B/pages/courses/index', $data);
    }

    // Hiển thị form tạo khóa học mới
    public function create()
    {
        $data['title'] = "Create Course";
        return view('B/pages/courses/create', $data);
    }

    // Xử lý lưu khóa học mới
    public function store()
    {
        // Validation rules
        $validationRules = [
            'title'         => 'required|max_length[255]',
            'level'         => 'required|max_length[100]',
            'price'         => 'required|numeric',
            'register_link' => 'permit_empty|valid_url|max_length[255]',
            'schedule'      => 'permit_empty',
            'thumbnail'     => 'permit_empty|max_length[255]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin nhập.');
        }


        $userID = session()->has('user') ? session()->get('user')->id : null;
        if (!$userID) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        $data = $this->request->getPost();
        $data['author'] = $userID; // Gán author bằng user_id

        // Lưu dữ liệu vào database
        if ($this->courseModel->save($data)) {
            $cacheKeyIndex = "courses_index_{$userID}";
            $this->cache->delete($cacheKeyIndex);
            $this->cache->delete('courses_index_all');
            return redirect_with_message_url('success', 'Khóa học đã được tạo thành công!', 'admin-courses-list');
        } else {
            return redirect_with_message_url('error', 'Không thể tạo khóa học.', 'admin-courses-list');
        }
    }

    // Xem chi tiết khóa học
    public function show($id)
    {
        $data['course'] = $this->courseModel->find($id);
        if (!$data['course']) {
            return redirect()->to('/admin/courses')->with('error', 'Khóa học không tồn tại.');
        }
        $data['lessons'] = $this->lessonModel->where('course_id', $id)->findAll();
        $data['title'] = "Course Details";
        return view('B/pages/courses/show', $data);
    }

    public function createLesson($courseId)
    {
        $data['course'] = $this->courseModel->find($courseId);
        if (!$data['course']) {
            return redirect()->to('/admin/courses')->with('error', 'Khóa học không tồn tại.');
        }
        $data['instructors'] = $this->instructorModel->findAll();
        $data['title'] = "Add Lesson";
        return view('B/pages/lessons/create', $data);
    }

    public function storeLesson($courseId)
    {
        $validationRules = [
            'title'        => 'required|max_length[255]',
            'content'      => 'permit_empty',
            'instructor_id' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin buổi học.');
        }

        $data = [
            'course_id'     => $courseId,
            'title'         => $this->request->getPost('title'),
            'content'       => $this->request->getPost('content'),
            'instructor_id' => $this->request->getPost('instructor_id')
        ];

        if ($this->lessonModel->save($data)) {
            $this->cache->delete("course_detail_{$courseId}");
            return redirect()->to("/admin/courses/show/{$courseId}")->with('success', 'Buổi học đã được thêm.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Không thể thêm buổi học.');
        }
    }


    public function deleteLesson($courseId, $lessonId)
    {
        $lesson = $this->lessonModel->find($lessonId);
        if (!$lesson || $lesson['course_id'] != $courseId) {
            return redirect()->to("/admin/courses/show/{$courseId}")->with('error', 'Buổi học không tồn tại.');
        }

        if ($this->lessonModel->delete($lessonId)) {
            $this->cache->delete("course_detail_{$courseId}");
            return redirect()->to("/admin/courses/show/{$courseId}")->with('success', 'Buổi học đã được xóa thành công!');
        } else {
            return redirect()->to("/admin/courses/show/{$courseId}")->with('error', 'Không thể xóa buổi học.');
        }
    }




    public function edit($id)
    {
        $data['course'] = $this->courseModel->find($id);
        if (!$data['course']) {
            return redirect()->to('/admin/courses')->with('error', 'Khóa học không tồn tại.');
        }
        $data['title'] = "Edit Course";
        return view('B/pages/courses/edit', $data);
    }

    // Xử lý cập nhật khóa học
    public function update($id)
    {
        $course = $this->courseModel->find($id);
        if (!$course) {
            return redirect()->to('/admin/courses')->with('error', 'Khóa học không tồn tại.');
        }

        // Validation rules
        $validationRules = [
            'title'         => 'required|max_length[255]',
            'level'         => 'required|max_length[100]',
            'price'         => 'required|numeric',
            'register_link' => 'permit_empty|valid_url|max_length[255]',
            'schedule'      => 'permit_empty',
            'thumbnail'     => 'permit_empty|max_length[255]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin nhập.');
        }

        // Lấy dữ liệu từ form
        $data = $this->request->getPost();
        $user = session()->get('user');
        $data['author'] = $user->id;

        // Cập nhật dữ liệu
        if ($this->courseModel->update($id, $data)) {
            $cacheKeyIndex = "courses_index_{$user->id}";
            $this->cache->delete($cacheKeyIndex);
            $this->cache->delete('courses_index_all');
            $this->cache->delete("course_detail_{$id}");

            return redirect_with_message_url('success', 'Khóa học đã được cập nhật thành công!', 'admin-courses-list');

        } else {
            return redirect()->back()->withInput()->with('error', 'Không thể cập nhật khóa học.');
        }
    }


    public function delete($id)
    {
        $course = $this->courseModel->find($id);
        if (!$course) {
            return redirect_with_message_url('error', 'Khóa học không tồn tại!', 'admin-courses-list');
        }

        // Xóa các bài học liên quan (nếu có)
        $this->lessonModel->where('course_id', $id)->delete();

        // Xóa khóa học
        if ($this->courseModel->delete($id)) {
            $user = session()->get('user');
            $cacheKeyIndex = "courses_index_{$user->id}";
            $this->cache->delete($cacheKeyIndex);
            $this->cache->delete('courses_index_all');
            $this->cache->delete("course_detail_{$id}");

            return redirect_with_message_url('success', 'Khóa học đã được xóa thành công!', 'admin-courses-list');
        } else {
            return redirect_with_message_url('error', 'Không thể xóa khóa học!', 'admin-courses-list');
        }
    }



    public function editLesson($courseId, $lessonId)
    {
        $data['course'] = $this->courseModel->find($courseId);
        $data['lesson'] = $this->lessonModel->find($lessonId);
        
        if (!$data['course'] || !$data['lesson'] || $data['lesson']['course_id'] != $courseId) {
            return redirect()->to('/admin/courses')->with('error', 'Khóa học hoặc buổi học không tồn tại.');
        }

        $data['instructors'] = $this->instructorModel->findAll();
        $data['title'] = "Edit Lesson";
        return view('B/pages/lessons/edit', $data);
    }

    public function updateLesson($courseId, $lessonId)
    {
        $lesson = $this->lessonModel->find($lessonId);
        if (!$lesson || $lesson['course_id'] != $courseId) {
            return redirect()->to('/admin/courses')->with('error', 'Buổi học không tồn tại.');
        }

        $validationRules = [
            'title'        => 'required|max_length[255]',
            'content'      => 'permit_empty',
            'instructor_id' => 'required|numeric'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin buổi học.');
        }

        $data = [
            'title'         => $this->request->getPost('title'),
            'content'       => $this->request->getPost('content'),
            'instructor_id' => $this->request->getPost('instructor_id')
        ];

        if ($this->lessonModel->update($lessonId, $data)) {
            $this->cache->delete("course_detail_{$courseId}");
            return redirect()->to("/admin/courses/show/{$courseId}")->with('success', 'Buổi học đã được cập nhật.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Không thể cập nhật buổi học.');
        }
    }

    
}