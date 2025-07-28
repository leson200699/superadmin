<?php

namespace App\Helpers;

use CodeIgniter\Database\Database;

class AuditLogHelper
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Kết nối database
    }

    /**
     * Hàm để lưu lịch sử hành động.
     *
     * @param int $userId        ID của người dùng thực hiện hành động
     * @param string $actionType Loại hành động (create, update, delete)
     * @param string $tableName  Bảng dữ liệu bị ảnh hưởng
     * @param int $recordId      ID của bản ghi bị thay đổi (nếu có)
     * @param string $details    Mô tả chi tiết về hành động
     */
    public function logAction($userId, $actionType, $tableName, $recordId, $details)
    {
        $data = [
            'user_id'        => $userId,
            'action_type'    => $actionType,
            'table_name'     => $tableName,
            'record_id'      => $recordId,
            'action_details' => $details
        ];

        $this->db->table('audit_logs')->insert($data);
    }
}
