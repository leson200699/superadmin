<?php

namespace App\Models;
use CodeIgniter\Model;
use \Config\Database;

class SectionModel extends Model
{
    protected $table      = 'sections';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'slug', 'author', 'name', 'content', 'thumbnail', 'position', 'active', 'type',
        'entity_type', 'entity_id'
    ];

    // Các loại entity cho section
    const ENTITY_TYPES = [
        'car' => 'Xe',
        'news' => 'Tin tức',
        'product' => 'Sản phẩm',
        'custom' => 'Trang tùy chỉnh',
        'none' => 'Không liên kết'
    ];

    public function get_section_by_user($userId)
    {
        return $this->where('author', $userId)
                    ->findAll();
    }

    /**
     * Lấy danh sách section có phân trang
     * 
     * @param int $userId ID của người dùng
     * @param int $page Trang hiện tại
     * @param int $perPage Số bản ghi mỗi trang
     * @param string $search Từ khóa tìm kiếm
     * @param string $entityType Loại thực thể để lọc
     * @param int $entityId ID của thực thể để lọc
     * @return array Mảng chứa danh sách section và thông tin phân trang
     */
    public function get_paginated_sections($userId, int $page = 1, int $perPage = 12, string $search = '', string $entityType = '', int $entityId = 0)
    {
        $builder = $this->db->table($this->table)
            ->where('author', $userId)
            ->orderBy('position', 'ASC');
            
        // Thêm điều kiện tìm kiếm nếu có
        if (!empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('slug', $search)
                ->orLike('content', $search)
                ->orLike('type', $search)
            ->groupEnd();
        }
        
        // Lọc theo loại thực thể nếu có
        if (!empty($entityType)) {
            $builder->where('entity_type', $entityType);
        }
        
        // Lọc theo ID thực thể nếu có
        if ($entityId > 0) {
            $builder->where('entity_id', $entityId);
        }
        
        // Đếm tổng số bản ghi để phân trang
        $total = $builder->countAllResults(false);
        
        // Áp dụng phân trang
        $offset = ($page - 1) * $perPage;
        $result = $builder->limit($perPage, $offset)->get()->getResultArray();
        
        // Trả về dữ liệu và thông tin phân trang
        return [
            'sections' => $result,
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
     * Lấy sections theo loại thực thể và ID
     */
    public function get_sections_by_entity($entityType, $entityId, $userId)
    {
        return $this->where('author', $userId)
                    ->where('entity_type', $entityType)
                    ->where('entity_id', $entityId)
                    ->where('active', 1)
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }
    
    /**
     * Lấy tên hiển thị của entity type
     */
    public static function getEntityTypeName($entityType)
    {
        return self::ENTITY_TYPES[$entityType] ?? 'Không xác định';
    }
}
