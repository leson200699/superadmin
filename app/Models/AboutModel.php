<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = 'about_pages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'name_en', 'thumbnail', 'multiple_image', 'slug', 'description',
        'description_en', 'content', 'content_en', 'status',
        'created_at', 'updated_at', 'author'
    ];
    protected $useTimestamps = true;

    public function getAboutById($id, $locale)
    {
        return $this->select($locale === 'vi' ? 
                        'name, description, content, multiple_image' : 
                        'name_en as name, description_en as description, content_en as content, multiple_image')
                    ->where('about_pages.id', $id)
                    ->first();
    }

    public function get_about_by_user($id)
    {
        return $this->select(
                    'about_pages.name, about_pages.description, about_pages.content, about_pages.multiple_image')
                    ->where('about_pages.author', $id)
                    ->get()
                    ->getResult();
    }
}