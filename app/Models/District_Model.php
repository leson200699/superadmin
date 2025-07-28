<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class District_Model extends Model
{
    protected $table         = 'district';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['province_id', 'name', 'status'];

    // Lấy danh sách quận/huyện theo province_id
    public function getDistrictsByProvince($province_id)
    {
        return $this->where('province_id', $province_id)->findAll();
    }
}
