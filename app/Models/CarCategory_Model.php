<?php

namespace App\Models;

use CodeIgniter\Model;

class CarCategory_Model extends Model
{
    protected $table = 'car_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'description'];
}
