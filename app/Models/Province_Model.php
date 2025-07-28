<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Province_Model extends Model
{
    protected $table         = 'province';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'prefix', 'code', 'status'];
}


