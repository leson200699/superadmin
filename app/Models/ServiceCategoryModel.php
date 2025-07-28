<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceCategoryModel extends Model
{
    protected $table = 'service_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'name_en', 'author','description', 'description_en', 'parent_id'];


    public function getServiceCategoryByLocale($categoryid, $locale)
    {
        return $this->select($locale === 'vi' ? 'name, description' : 'name_en as name, description_en as description')
                    ->where('service_categories.id', $categoryid)
                    ->first();
    }


    public function getAllCategories($authorId, $locale = 'vi')
    {
        $fields = $locale === 'vi' 
            ? 'id, name, description, parent_id' 
            : 'id, name_en as name, description_en as description, parent_id';

        return $this->select($fields)
                    ->where('author', $authorId)
                    ->findAll();
    }





}