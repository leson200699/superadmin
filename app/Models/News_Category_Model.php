<?php
namespace App\Models;

use CodeIgniter\Model;

class News_Category_Model extends Model
{
    protected $table         = 'news_categories';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'parent_id', 'name', 'author', 'alias', 'thumbnail', 'link', 'introduction', 'orders',
        'title', 'keyword', 'description', 'status'
    ];

    public function get_news_category_id($user_id)
    {
        return $this->db->table($this->table)
            ->select('news_categories.id, news_categories.name, parent.name as parent_name, news_categories.alias, news_categories.status, news_categories.thumbnail, news_categories.description')
            ->join('news_categories as parent', 'news_categories.parent_id = parent.id', 'left')
            ->where('news_categories.author', $user_id)
            ->groupBy('news_categories.id')
            ->orderBy('news_categories.name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function insert_news_category($data)
    {
        try {
            return $this->insert($data);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update_news_category($news_category_id, $data)
    {
        try {
            return $this->update($news_category_id, $data);
        } catch (\Exception $exception) {
            return false;
        }
    }
}