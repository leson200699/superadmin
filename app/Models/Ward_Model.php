<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Ward_Model extends Model
{
    protected $table         = 'ward';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'district_id', 'status'];

    public function getAllWards()
    {
        return $this->select('ward.*, district.name as district_name, province.name as province_name')
                    ->join('district', 'ward.district_id = district.id')
                    ->join('province', 'district.province_id = province.id')
                    ->findAll();
    }
}
