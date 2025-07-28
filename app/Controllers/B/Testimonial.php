<?php

namespace App\Controllers\B;

use App\Models\Testimonial_Model;
use App\Helpers\AuditLogHelper; // Import helper
use CodeIgniter\Controller;
use Config\Services;

class Testimonial extends Controller
{
    protected $testimonialModel;
    protected $auditLog;

    public function __construct()
    {
        $this->testimonialModel = new Testimonial_Model();
        $this->cache = Services::cache(); // Khởi tạo Redis cache
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->auditLog = new AuditLogHelper(); // Khởi tạo helper
    }


    public function index()
    {
        $user = session()->get('user');
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Bạn cần đăng nhập trước!');
        }

        $data = [
            'title'        => 'Customer Testimonials',
            'testimonials' => $this->testimonialModel->where('author', get_user_data('id'))->findAll(),
        ];
        return view('B/pages/testimonial/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Testimonial'
        ];

        return view('B/pages/testimonial/create', $data);
    }

    public function store()
    {
        $userID = get_user_data('id');
        
        // Kiểm tra người dùng đã đăng nhập
        if (!$userID) {
            return redirect()->to('/admin/login')->with('error', 'Bạn cần đăng nhập trước!');
        }
        
        // Kiểm tra người dùng tồn tại trong bảng tenants
        $db = \Config\Database::connect();
        $userExists = $db->table('tenants')->where('id', $userID)->countAllResults() > 0;
        
        if (!$userExists) {
            return redirect()->to('/admin/testimonial')->with('error', 'Không tìm thấy thông tin người dùng trong bảng tenants!');
        }
        
        $data = [
            'customer_name' => $this->request->getPost('customer_name'),
            'testimonial'   => $this->request->getPost('testimonial'),
            'career'        => $this->request->getPost('career'),
            'thumbnail'     => $this->request->getPost('thumbnail'),
            'author' => $userID,
        ];

        try {
            $this->testimonialModel->insert($data);
            $insertId = $this->testimonialModel->insertID();

            $this->auditLog->logAction(
                $userID,
                'create',
                'testimonials',
                $insertId,
                'Added new testimonial: '. json_encode($data),
            );

            $this->cache->delete("testimonial_index_{$userID}");
            
            return redirect()->to('/admin/testimonial')->with('success', 'Đã thêm testimonial thành công!');
        } catch (\Exception $e) {
            return redirect()->to('/admin/testimonial')->with('error', 'Lỗi khi thêm testimonial: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = [
            'title'       => 'Edit Testimonial',
            'testimonial' => $this->testimonialModel->find($id)
        ];

        return view('B/pages/testimonial/edit', $data);
    }

    public function update($id)
    {
        $userID = get_user_data('id');
        
        // Kiểm tra người dùng đã đăng nhập
        if (!$userID) {
            return redirect()->to('/admin/login')->with('error', 'Bạn cần đăng nhập trước!');
        }
        
        // Kiểm tra testimonial tồn tại và thuộc về người dùng hiện tại
        $testimonial = $this->testimonialModel->find($id);
        if (!$testimonial) {
            return redirect()->to('/admin/testimonial')->with('error', 'Không tìm thấy testimonial!');
        }
        
        // Lấy author ID, hỗ trợ cả mảng và đối tượng
        $authorId = is_array($testimonial) ? ($testimonial['author'] ?? null) : ($testimonial->author ?? null);
        
        // Kiểm tra quyền cập nhật
        if ($authorId != $userID && !get_user_is_admin(0)) {
            return redirect()->to('/admin/testimonial')->with('error', 'Bạn không có quyền cập nhật testimonial này!');
        }

        $data = [
            'customer_name' => $this->request->getPost('customer_name'),
            'testimonial'   => $this->request->getPost('testimonial'),
            'career'        => $this->request->getPost('career'),
            'thumbnail'     => $this->request->getPost('thumbnail'),
        ];

        try {
            $this->testimonialModel->update($id, $data);
            
            // Ghi log
            $this->auditLog->logAction(
                $userID,
                'update',
                'testimonials',
                $id,
                'Updated testimonial: ' . json_encode($data)
            );
            
            $this->cache->delete("testimonial_index_{$userID}");
            $this->cache->delete("testimonial_detail_{$id}");
            
            return redirect()->to('/admin/testimonial')->with('success', 'Cập nhật testimonial thành công!');
        } catch (\Exception $e) {
            return redirect()->to('/admin/testimonial')->with('error', 'Lỗi khi cập nhật testimonial: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $userID = get_user_data('id');
        
        // Kiểm tra người dùng đã đăng nhập
        if (!$userID) {
            return redirect()->to('/admin/login')->with('error', 'Bạn cần đăng nhập trước!');
        }
        
        // Kiểm tra testimonial tồn tại và thuộc về người dùng hiện tại
        $testimonial = $this->testimonialModel->find($id);
        if (!$testimonial) {
            return redirect()->to('/admin/testimonial')->with('error', 'Không tìm thấy testimonial!');
        }
        
        // Lấy author ID, hỗ trợ cả mảng và đối tượng
        $authorId = is_array($testimonial) ? ($testimonial['author'] ?? null) : ($testimonial->author ?? null);
        
        if ($authorId != $userID && !get_user_is_admin(0)) {
            return redirect()->to('/admin/testimonial')->with('error', 'Bạn không có quyền xóa testimonial này!');
        }

        try {
            $this->testimonialModel->delete($id);
            
            // Ghi log
            $this->auditLog->logAction(
                $userID,
                'delete',
                'testimonials',
                $id,
                'Deleted testimonial ID: ' . $id
            );
            
            $this->cache->delete("testimonial_index_{$userID}");
            $this->cache->delete("testimonial_detail_{$id}");
            
            return redirect()->to('/admin/testimonial')->with('success', 'Đã xóa testimonial thành công!');
        } catch (\Exception $e) {
            return redirect()->to('/admin/testimonial')->with('error', 'Lỗi khi xóa testimonial: ' . $e->getMessage());
        }
    }
}
