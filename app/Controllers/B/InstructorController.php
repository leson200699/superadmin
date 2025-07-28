<?php
namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\InstructorModel;
use Config\Services;

class InstructorController extends BaseController
{
    protected $instructorModel;
    protected $cache;

    public function __construct()
    {
        $this->instructorModel = new InstructorModel();
        $this->cache = Services::cache();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    // Danh sách giảng viên
    public function index()
    {
        $data['instructors'] = $this->instructorModel->findAll();
        $data['title'] = "Instructors";
        return view('B/pages/instructors/index', $data);
    }

    // Hiển thị form tạo giảng viên mới
    public function create()
    {
        $data['title'] = "Create Instructor";
        return view('B/pages/instructors/create', $data);
    }

    // Xử lý lưu giảng viên mới
    public function store()
    {
        $validationRules = [
            'name' => 'required|max_length[255]',
            'bio'  => 'permit_empty'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin nhập.');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio')
        ];

        if ($this->instructorModel->save($data)) {
            return redirect()->to('/admin/instructors')->with('success', 'Giảng viên đã được tạo thành công!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Không thể tạo giảng viên.');
        }
    }

    // Xem chi tiết giảng viên
    public function show($id)
    {
        $data['instructor'] = $this->instructorModel->find($id);
        if (!$data['instructor']) {
            return redirect()->to('/admin/instructors')->with('error', 'Giảng viên không tồn tại.');
        }
        $data['title'] = "Instructor Details";
        return view('B/pages/instructors/show', $data);
    }


    public function edit($id)
    {
        $data['instructor'] = $this->instructorModel->find($id);
        if (!$data['instructor']) {
            return redirect()->to('/admin/courses/instructors')->with('error', 'Giảng viên không tồn tại.');
        }
        $data['title'] = "Edit Instructor";
        return view('B/pages/instructors/edit', $data);
    }

    // Xử lý cập nhật giảng viên
    public function update($id)
    {
        $instructor = $this->instructorModel->find($id);
        if (!$instructor) {
            return redirect()->to('/admin/courses/instructors')->with('error', 'Giảng viên không tồn tại.');
        }

        // Validation rules
        $validationRules = [
            'name' => 'required|max_length[255]',
            'bio'  => 'permit_empty'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin nhập.');
        }

        // Lấy dữ liệu từ form
        $data = [
            'name' => $this->request->getPost('name'),
            'bio'  => $this->request->getPost('bio')
        ];

        // Cập nhật dữ liệu
        if ($this->instructorModel->update($id, $data)) {
            $this->cache->delete('instructors_list'); // Xóa cache danh sách nếu có
            return redirect()->to('/admin/courses/instructors/instructors-list')->with('success', 'Giảng viên đã được cập nhật thành công!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Không thể cập nhật giảng viên.');
        }
    }
    public function delete($id)
    {
        $instructor = $this->instructorModel->find($id);
        if (!$instructor) {
            return redirect()->to('/admin/courses/instructors/instructors-list')->with('error', 'Giảng viên không tồn tại.');
        }

        // Kiểm tra xem giảng viên có liên quan đến bài học nào không (tùy chọn)
        // Nếu có, bạn có thể thêm logic xử lý ở đây (ví dụ: không cho xóa)

        if ($this->instructorModel->delete($id)) {
            $this->cache->delete('instructors_list'); // Xóa cache danh sách nếu có
            return redirect()->to('/admin/courses/instructors/instructors-list')->with('success', 'Giảng viên đã được xóa thành công!');
        } else {
            return redirect()->to('/admin/courses/instructors/instructors-list')->with('error', 'Không thể xóa giảng viên.');
        }
    }

    
}