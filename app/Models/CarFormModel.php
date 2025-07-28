<?php

namespace App\Models;

use CodeIgniter\Model;

class CarFormModel extends Model
{
    protected $table = 'car_form';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'form_type', 'full_name', 'phone', 'email', 'province_city', 'dealer',
        'car_model', 'test_drive_time', 'license_plate', 'service_type',
        'appointment_time', 'version', 'color', 'payment_type', 'note', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; // Không dùng updated_at nếu không cần
    protected $dateFormat = 'datetime';

    // Insert dữ liệu dựa trên form_type
    public function insertFormData(array $data, int $formType): int
    {
        $data['form_type'] = $formType;
        $data['status'] = 'pending'; // Mặc định
        return $this->insert($data) ? $this->getInsertID() : 0;
    }
    
    /**
     * Lấy danh sách đặt lịch xe có phân trang và lọc
     * 
     * @param int $userId ID của người dùng admin
     * @param int $page Trang hiện tại
     * @param int $perPage Số bản ghi mỗi trang
     * @param string $search Từ khóa tìm kiếm
     * @param string|int $formType Loại form (1: Lái thử, 2: Dịch vụ, 3: Báo giá, 4: Tư vấn)
     * @param string $status Trạng thái đơn (pending, processing, completed, cancelled)
     * @return array Mảng chứa danh sách đặt lịch và thông tin phân trang
     */
    public function get_paginated_bookings($userId, int $page = 1, int $perPage = 12, string $search = '', $formType = '', string $status = '')
    {
        $builder = $this->db->table($this->table)
            ->orderBy('created_at', 'DESC');
            
        // Thêm điều kiện tìm kiếm nếu có
        if (!empty($search)) {
            $builder->groupStart()
                ->like('full_name', $search)
                ->orLike('phone', $search)
                ->orLike('email', $search)
                ->orLike('car_model', $search)
            ->groupEnd();
        }
        
        // Lọc theo loại form
        if (!empty($formType)) {
            $builder->where('form_type', $formType);
        }
        
        // Lọc theo trạng thái
        if (!empty($status)) {
            $builder->where('status', $status);
        }
        
        // Đếm tổng số bản ghi để phân trang
        $total = $builder->countAllResults(false);
        
        // Áp dụng phân trang
        $offset = ($page - 1) * $perPage;
        $result = $builder->limit($perPage, $offset)->get()->getResultArray();
        
        // Trả về dữ liệu và thông tin phân trang
        return [
            'bookings' => $result,
            'pager' => [
                'total' => $total,
                'perPage' => $perPage,
                'currentPage' => $page,
                'lastPage' => ceil($total / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total)
            ]
        ];
    }
    
    /**
     * Lấy tên loại form dựa trên form_type
     * 
     * @param int $formType Loại form
     * @return string Tên loại form
     */
    public static function getFormTypeName($formType)
    {
        switch ($formType) {
            case 1:
                return 'Đăng ký lái thử';
            case 2:
                return 'Đặt lịch dịch vụ';
            case 3:
                return 'Yêu cầu báo giá';
            case 4:
                return 'Đăng ký tư vấn';
            default:
                return 'Không xác định';
        }
    }
    
    /**
     * Lấy CSS class cho trạng thái
     * 
     * @param string $status Trạng thái
     * @return string CSS class
     */
    public static function getStatusClass($status)
    {
        switch ($status) {
            case 'pending':
                return 'bg-yellow-100 text-yellow-800';
            case 'processing':
                return 'bg-blue-100 text-blue-800';
            case 'completed':
                return 'bg-green-100 text-green-800';
            case 'cancelled':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
}