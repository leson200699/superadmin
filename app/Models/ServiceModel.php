<?php
namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'author', 'video_url', 'name_en', 'category_id', 'thumbnail', 'slug',
        'description', 'description_en', 'content', 'content_en', 'status'
    ];

    public function get_services_list()
    {
        return $this->db->table($this->table)
            ->select("{$this->table}.id, service_categories.name AS category_name, {$this->table}.name, {$this->table}.description, {$this->table}.slug, {$this->table}.thumbnail, {$this->table}.created_at, {$this->table}.status")
            ->join('service_categories', "{$this->table}.category_id = service_categories.id", 'left')
            ->orderBy("{$this->table}.id", "DESC")
            ->get()
            ->getResult();
    }

    public function get_services_by_user($user_id)
    {
        return $this->db->table($this->table)
             ->select("{$this->table}.id, service_categories.name AS category_name, {$this->table}.name, {$this->table}.description, {$this->table}.slug, {$this->table}.thumbnail, {$this->table}.created_at, {$this->table}.status")
            ->join('service_categories', "{$this->table}.category_id = service_categories.id", 'left')
            ->where("{$this->table}.author", $user_id)
            ->orderBy("{$this->table}.id", "ASC")
            ->get()
            ->getResult();
    }

   public function getServicesByCategory($categoryId, $authorId, $locale = 'vi')
    {
        $fields = $locale === 'vi' 
            ? 'id, name, description, thumbnail, slug, status' 
            : 'id, name_en as name, description_en as description, thumbnail, slug, status';

        return $this->select($fields)
                    ->where('category_id', $categoryId)
                    ->where('author', $authorId)
                    ->where('status', 1)
                    ->get()
                    ->getResult();
    }

    // Lấy services theo category alias với hỗ trợ đa ngôn ngữ và author
    public function getServicesByCategoryAlias($alias, $authorId, $locale = 'vi')
    {
        $fields = $locale === 'vi' 
            ? 'services.id, services.name, services.description, services.thumbnail, services.slug, services.status' 
            : 'services.id, services.name_en as name, services.description_en as description, services.thumbnail, services.slug, services.status';

        return $this->select($fields)
                    ->join('service_categories', 'service_categories.id = services.category_id')
                    ->where('service_categories.alias', $alias)
                    ->where('services.author', $authorId)
                    ->where('services.status', 1)
                    ->findAll();
    }

    public function getServiceDetail($identifier, $authorId, $locale = 'vi')
    {
        $fields = $locale === 'vi' 
            ? 'id, name, description, content, thumbnail, slug, video_url, category_id, status' 
            : 'id, name_en as name, description_en as description, content_en as content, thumbnail, slug, video_url, category_id, status';

        $builder = $this->select($fields)
                       ->where('author', $authorId)
                       ->where('status', 1);

        // Kiểm tra identifier là id (số) hay alias (chuỗi)
        if (is_numeric($identifier)) {
            $builder->where('id', $identifier);
        } else {
            $builder->where('slug', $identifier);
        }

        return $builder->first();
    }
}