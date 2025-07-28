<?php

namespace App\Controllers\B;

use App\Models\CarFormModel;
use CodeIgniter\Controller;
use Config\Services;

class CarBooking extends Controller
{
    protected $carFormModel;
    protected $cache;

    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->carFormModel = new CarFormModel();
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        // Tham số phân trang và tìm kiếm
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12; // Hiển thị 12 đơn đặt lịch mỗi trang
        $search = $this->request->getGet('search') ?? '';
        $formType = $this->request->getGet('form_type') ?? '';
        $status = $this->request->getGet('status') ?? '';
        
        // Lấy danh sách đặt lịch có phân trang
        $paginated_result = $this->carFormModel->get_paginated_bookings($userId, $page, $perPage, $search, $formType, $status);

        return view('B/pages/car/booking_list', [
            'title' => 'Danh sách đặt lịch xe',
            'bookings' => $paginated_result['bookings'],
            'pager' => $paginated_result['pager'],
            'search' => $search,
            'form_type' => $formType,
            'status' => $status,
        ]);
    }

    public function view($id)
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        $booking = $this->carFormModel->find($id);
        
        if (!$booking) {
            return redirect_with_message('error', 'Đơn đặt lịch không tồn tại');
        }

        return view('B/pages/car/booking_view', [
            'title' => 'Chi tiết đặt lịch',
            'booking' => $booking,
        ]);
    }

    public function update_status()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Người dùng chưa đăng nhập'
            ]);
        }

        // Lấy dữ liệu từ yêu cầu POST
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Kiểm tra xem yêu cầu có phải là AJAX không
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Yêu cầu không hợp lệ'
            ]);
        }

        // Kiểm tra đơn đặt lịch có tồn tại không
        $booking = $this->carFormModel->find($id);
        
        if (!$booking) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Đơn đặt lịch không tồn tại'
            ]);
        }

        // Cập nhật trạng thái
        $updateStatus = $this->carFormModel->update($id, ['status' => $status]);

        // Kiểm tra xem việc cập nhật có thành công không
        if ($updateStatus) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Trạng thái đã được cập nhật!'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Không thể cập nhật trạng thái'
        ]);
    }

    public function delete($id)
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        $booking = $this->carFormModel->find($id);
        
        if (!$booking) {
            return redirect_with_message('error', 'Đơn đặt lịch không tồn tại');
        }
        
        $deleted = $this->carFormModel->delete($id);
        
        if ($deleted) {
            return redirect_with_message('success', 'Đã xóa đơn đặt lịch thành công');
        } else {
            return redirect_with_message('error', 'Không thể xóa đơn đặt lịch');
        }
    }
} 