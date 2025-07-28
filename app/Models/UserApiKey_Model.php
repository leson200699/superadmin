<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Config\Database;

class UserApiKey_Model extends Model
{
    protected $table      = 'user_api_keys';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'api_key'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function __construct(?ConnectionInterface &$db = null, ?ValidationInterface $validation = null)
    {
         parent::__construct($db, $validation);
    }

    // Insert API Key cho user
    public function insertApiKey($userId, $apiKey)
    {
        return $this->insert([
            'user_id' => $userId,
            'api_key' => $apiKey
        ]);
    }

    // Kiểm tra API Key
    public function checkApiKey($apiKey)
    {
        return $this->where('api_key', $apiKey)->first();
    }

    public function getUserByToken($apiKey)
    {
        return $this->where('api_key', $apiKey)->first(); // Trả về user dựa trên API Key
    }
}
