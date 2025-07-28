<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Landing_Model extends Model
{
    protected $table         = 'landing';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'name',
        'name_en',
        'author',
        'alias',
        'thumbnail',
        'multiple_image',
        'caption',
        'caption_en',
        'content',
        'content_en',
        'created_at',
        'status',
        'title',
        'keyword',
        'description'
    ];

    public function getLandingLocaleById($id, $locale)
    {
        return $this->select($locale === 'vi' ? 
                        'name, content, thumbnail, caption' : 
                        'name_en as name, content_en as content, thumbnail, caption_en as caption')
                    ->where('landing.id', $id) // Lọc theo ID
                    ->first(); // Trả về một bản ghi
    }


    public function getLandingLocaleByAlias($alias, $locale = 'vi')
    {
        return $this->select($locale === 'vi' ? 
                        'id, name, content, thumbnail, caption, alias, multiple_image' : 
                        'name_en as name, content_en as content, thumbnail, caption_en as caption')
                    ->where('landing.alias', $alias)
                    ->first();
    }


}
