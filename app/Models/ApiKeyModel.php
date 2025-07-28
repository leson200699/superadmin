<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiKeyModel extends Model
{
    protected $table = 'user_api_keys';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'api_key', 'status', 'created_at', 'updated_at'];
}
