<?php
namespace App\Models;

use CodeIgniter\Model;

class News_Model extends Model
{
    protected $table         = 'news';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['category_id', 'author', 'name', 'alias', 'view', 'thumbnail', 'caption', 'content', 'status', 'title', 'keyword', 'description'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    /**
     * Lấy chi tiết tin tức theo ID hoặc Alias
     */
    public function get_news_detail($identifier)
    {
        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'news.id' : 'news.alias';

        return $this->db->table('news')
            ->select('news.id, news.alias, news.thumbnail, news.created_at, news.status, 
                      news.name, news.caption, news.content, news.category_id, news_categories.name as category_name')
            ->join('news_categories', 'news.category_id = news_categories.id', 'left')
            ->where($field, $identifier)
            ->get()
            ->getRowArray();
    }

    /**
     * Lấy danh sách tin tức theo danh mục (ID hoặc Alias)
     */
    public function get_news_by_category($identifier, $userId = null, $limit = 10, $excludeLatest = false)
    {
        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'news.category_id' : 'news_categories.alias';

        $builder = $this->db->table('news')
            ->select('news.id, news.name, news.caption, news.alias, news.thumbnail, news.created_at, news.status, 
                      news_categories.name as category_name')
            ->join('news_categories', 'news.category_id = news_categories.id', 'left')
            ->where($field, $identifier)
            ->orderBy('news.created_at', 'DESC');

        if ($userId) {
            $builder->where('news.author', $userId);
        }

        if ($excludeLatest && $isNumeric) {
            $latestNews = $this->db->table('news')
                ->where('category_id', $identifier)
                ->where('author', $userId)
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();
            if ($latestNews) {
                $builder->where('news.id !=', $latestNews['id']);
            }
        }

        return $builder->limit($limit)->get()->getResultArray();
    }

    public function get_news_by_user($user_id)
    {
        return $this->db->table($this->table)
            ->select("{$this->table}.id, {$this->table}.category_id, news_categories.name AS category_name, {$this->table}.name, {$this->table}.caption, {$this->table}.content, {$this->table}.alias, {$this->table}.thumbnail, {$this->table}.created_at, {$this->table}.status")
            ->join('news_categories', "{$this->table}.category_id = news_categories.id", 'left')
            ->where("{$this->table}.author", $user_id)
            ->orderBy("{$this->table}.id", "DESC")
            ->get()
            ->getResult();
    }

    public function get_news_list()
    {
        return $this->db->table($this->table)
            ->select("{$this->table}.id, news_categories.name AS category_name, {$this->table}.name, {$this->table}.caption, {$this->table}.alias, {$this->table}.thumbnail, {$this->table}.created_at, {$this->table}.status")
            ->join('news_categories', "{$this->table}.category_id = news_categories.id", 'left')
            ->orderBy("{$this->table}.id", "DESC")
            ->get()
            ->getResult();
    }

    public function get_related_news($categoryId, $currentNewsId, $limit = 3)
    {
        return $this->db->table($this->table)
            ->select("{$this->table}.id, news_categories.name AS category_name, {$this->table}.name, {$this->table}.alias, {$this->table}.thumbnail, {$this->table}.created_at")
            ->join('news_categories', "{$this->table}.category_id = news_categories.id", 'left')
            ->where("{$this->table}.category_id", $categoryId)
            ->where("{$this->table}.id !=", $currentNewsId)
            ->orderBy("{$this->table}.created_at", 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function insert_news($data)
    {
        try {
            $this->db->transStart();
            $this->insert($data);
            $insertId = $this->db->insertID();
            $this->db->transComplete();
            return $this->db->transStatus() ? $insertId : false;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            $this->db->transRollback();
            return false;
        }
    }

    public function update_news($id, $data)
    {
        try {
            $this->db->transStart();
            $this->update($id, $data);
            $this->db->transComplete();
            return $this->db->transStatus();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function get_paginated_news_by_user($user_id, $page = 1, $perPage = 12, $search = '')
    {
        // Xây dựng query
        $builder = $this->db->table($this->table)
            ->select("{$this->table}.id, {$this->table}.category_id, news_categories.name AS category_name, {$this->table}.name, {$this->table}.caption, {$this->table}.content, {$this->table}.alias, {$this->table}.thumbnail, {$this->table}.created_at, {$this->table}.status")
            ->join('news_categories', "{$this->table}.category_id = news_categories.id", 'left')
            ->where("{$this->table}.author", $user_id)
            ->orderBy("{$this->table}.created_at", "DESC");
            
        // Thêm điều kiện tìm kiếm nếu có
        if (!empty($search)) {
            $builder->groupStart()
                ->like("{$this->table}.name", $search)
                ->orLike("{$this->table}.caption", $search)
                ->orLike("news_categories.name", $search)
            ->groupEnd();
        }
        
        // Đếm tổng số bản ghi để phân trang
        $total = $builder->countAllResults(false);
        
        // Áp dụng phân trang
        $offset = ($page - 1) * $perPage;
        $result = $builder->limit($perPage, $offset)->get()->getResult();
        
        // Trả về dữ liệu và thông tin phân trang
        return [
            'news' => $result,
            'pager' => [
                'total' => $total,
                'perPage' => $perPage,
                'currentPage' => $page,
                'lastPage' => ceil($total / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total)
            ]
        ];
    }

    public function delete_news($id)
    {
        try {
            $this->db->transStart();
            $this->delete($id);
            $this->db->transComplete();
            return $this->db->transStatus();
        } catch (\Exception $e) {
            return false;
        }
    }
}