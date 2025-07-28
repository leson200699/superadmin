<?php
namespace App\Models;

use CodeIgniter\Model;

class UserSessionModel extends Model
{
    protected $table = 'user_sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'access_token', 
        'username', 
        'domain', 
        'avatar', 
        'firstname', 
        'lastname', 
        'email', 
        'mobile_no', 
        'sex', 
        'address', 
        'role', 
        'is_active', 
        'is_verify', 
        'is_admin', 
        'is_visible', 
        'is_deletable', 
        'last_ip', 
        'last_login', 
        'expires', 
        'created_at', 
        'updated_at'
    ];

    // Method createSession: Giữ nguyên, nhưng khi gọi sẽ insert đầy đủ data
    public function createSession($data)
    {
        return $this->insert($data);
    }

    public function getSessionByToken($token)
    {
        return $this->where('access_token', $token)->first();
    }

    // Tùy chọn: Method để xóa session expired (gọi cron nếu cần)
    public function deleteExpired()
    {
        return $this->where('expires <', date('Y-m-d H:i:s'))->delete();
    }
}