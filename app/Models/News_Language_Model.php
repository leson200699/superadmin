<?php

namespace App\Models;

use CodeIgniter\Model;

class News_Language_Model extends Model
{
    protected $table         = 'news_translations';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['news_id', 'language', 'name', 'caption', 'content'];
}
