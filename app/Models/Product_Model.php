<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;
use Config\Services;

class Product_Model extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'alias', 'thumbnail','multiple_image', 'price', 'caption', 'content', 'best_seller',
        'created_at', 'updated_at', 'status', 'title', 'keyword', 'description',
        'view', 'author'
    ];
    protected $returnType = 'object';
    
    // Cache configuration
    protected $cache;
    protected $cacheTTL = 3600; // 1 hour
    
    public function __construct()
    {
        parent::__construct();
        $this->cache = Services::cache();
    }

    /**
     * Get product list with caching and optimized query
     */
    public function get_product_list($userID = null)
    {
        $cacheKey = "product_list_" . ($userID ?? 'all');
        
        // Try to get from cache first
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $builder = $this->db->table('products AS a')
            ->select('a.id, a.name, a.alias, a.status, a.price, a.thumbnail, a.caption, a.created_at, 
                     b.name AS category_name, b.alias AS category_alias')
            ->join('product_categories AS b', 'a.view = b.id', 'INNER')
            ->orderBy('a.created_at', 'DESC');

        if ($userID) {
            $builder->where('a.author', $userID);
        }

        $result = $builder->get()->getResult();
        
        // Cache the result
        $this->cache->save($cacheKey, $result, $this->cacheTTL);
        
        return $result;
    }

    /**
     * Get all active products with caching
     */
    public function getAllProduct()
    {
        $cacheKey = 'all_active_products';
        
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $result = $this->where('status', 1)
                      ->orderBy('id', 'ASC')
                      ->findAll();
        
        $this->cache->save($cacheKey, $result, $this->cacheTTL);
        
        return $result;
    }

    /**
     * Get products by user with optimized query
     */
    public function get_product_user($id)
    {
        $cacheKey = "user_products_{$id}";
        
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $result = $this->db->table('products')
            ->select('id, alias, thumbnail, multiple_image, created_at, status, 
                     name, price, caption, content')
            ->where('author', $id)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
            
        $this->cache->save($cacheKey, $result, $this->cacheTTL);
        
        return $result;
    }

    /**
     * Get product detail with caching
     */
    public function get_product_detail($identifier)
    {
        $cacheKey = "product_detail_{$identifier}";
        
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'id' : 'alias';

        $result = $this->db->table('products')
            ->select('id, alias, thumbnail, multiple_image, created_at, status, 
                     name, price, caption, content')
            ->where($field, $identifier)
            ->get()
            ->getRowArray();
            
        if ($result) {
            $this->cache->save($cacheKey, $result, $this->cacheTTL);
        }
        
        return $result;
    }

    /**
 * Get products by category ID or alias, with optional author filter and caching
 */
public function get_products_by_category($categoryIdentifier, $userID = null)
{
    $cacheKey = "products_by_category_" . $categoryIdentifier . ($userID ? "_user_$userID" : '');

    if ($cached = $this->cache->get($cacheKey)) {
        return $cached;
    }

    $isNumeric = is_numeric($categoryIdentifier);
    $categoryField = $isNumeric ? 'b.id' : 'b.alias';

    $builder = $this->db->table('products AS a')
        ->select('a.id, a.name, a.alias, a.status, a.price, a.thumbnail, a.caption, a.created_at, 
                  b.name AS category_name, b.alias AS category_alias')
        ->join('product_categories AS b', 'a.view = b.id', 'INNER')
        ->where($categoryField, $categoryIdentifier)
        ->where('a.status', 1)
        ->orderBy('a.created_at', 'DESC');

    if ($userID) {
        $builder->where('a.author', $userID);
    }

    $result = $builder->get()->getResult();

    $this->cache->save($cacheKey, $result, $this->cacheTTL);

    return $result;
}


    /**
     * Get best seller products with caching
     */
    public function get_product_home_list($userID = null)
    {
        $cacheKey = "best_seller_products_" . ($userID ?? 'all');
        
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $builder = $this->db->table('products AS a')
            ->select('a.id, a.name, a.alias, a.status, a.price, a.thumbnail, a.caption, a.created_at, 
                     b.name AS category_name, b.alias AS category_alias')
            ->join('product_categories AS b', 'a.view = b.id', 'INNER')
            ->where('a.best_seller', 1)
            ->where('a.status', 1)
            ->orderBy('a.created_at', 'DESC');

        if ($userID) {
            $builder->where('a.author', $userID);
        }

        $result = $builder->get()->getResult();
        
        $this->cache->save($cacheKey, $result, $this->cacheTTL);
        
        return $result;
    }

    /**
     * Insert product with transaction and cache invalidation
     */
    public function insert_product_get_id($data)
    {
        try {
            $dbConnection = Database::connect();
            $dbConnection->transStart();

            $dbConnection->table($this->table)->insert($data);
            $insert_id = $dbConnection->insertID();

            $dbConnection->transComplete();

            if ($dbConnection->transStatus()) {
                // Invalidate related caches
                $this->invalidateProductCaches();
                return $insert_id;
            }
            
            return false;
        } catch (\Exception $exception) {
            log_message('error', 'Product insert error: ' . $exception->getMessage());
            return false;
        }
    }

    /**
     * Update product with cache invalidation
     */
    public function update_product($product_id, $update_data)
    {
        try {
            $dbConnection = Database::connect();
            $dbConnection->transStart();

            $dbConnection->table($this->table)->where('id', $product_id)->update($update_data);

            $dbConnection->transComplete();

            if ($dbConnection->transStatus()) {
                // Invalidate related caches
                $this->invalidateProductCaches($product_id);
                return true;
            }
            
            return false;
        } catch (\Exception $exception) {
            log_message('error', 'Product update error: ' . $exception->getMessage());
            return false;
        }
    }

    /**
     * Delete product with cache invalidation
     */
    public function delete_product($product_id)
    {
        try {
            $dbConnection = Database::connect();
            $dbConnection->transStart();

            $dbConnection->table($this->table)->delete(['id' => $product_id]);

            $dbConnection->transComplete();

            if ($dbConnection->transStatus()) {
                // Invalidate related caches
                $this->invalidateProductCaches($product_id);
                return true;
            }
            
            return false;
        } catch (\Exception $exception) {
            log_message('error', 'Product delete error: ' . $exception->getMessage());
            return false;
        }
    }

    /**
     * Invalidate product-related caches
     */
    private function invalidateProductCaches($product_id = null)
    {
        $cacheKeys = [
            'product_list_all',
            'all_active_products',
            'best_seller_products_all'
        ];

        if ($product_id) {
            $cacheKeys[] = "product_detail_{$product_id}";
        }

        foreach ($cacheKeys as $key) {
            $this->cache->delete($key);
        }
    }

    /**
     * Search products with optimized query
     */
    public function searchProducts($query, $userID = null, $limit = 10)
    {
        $cacheKey = "product_search_" . md5($query . $userID . $limit);
        
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $builder = $this->db->table('products AS a')
            ->select('a.id, a.name, a.alias, a.status, a.price, a.thumbnail, a.caption, a.created_at, 
                     b.name AS category_name, b.alias AS category_alias')
            ->join('product_categories AS b', 'a.view = b.id', 'LEFT')
            ->where('a.status', 1)
            ->groupStart()
                ->like('a.name', $query)
                ->orLike('a.caption', $query)
                ->orLike('a.content', $query)
            ->groupEnd()
            ->orderBy('a.created_at', 'DESC')
            ->limit($limit);

        if ($userID) {
            $builder->where('a.author', $userID);
        }

        $result = $builder->get()->getResult();
        
        $this->cache->save($cacheKey, $result, 1800); // 30 minutes cache
        
        return $result;
    }

    /**
     * Get paginated product list with caching and optimized query
     */
    public function get_paginated_product_list($userID = null, $page = 1, $perPage = 12, $search = '')
    {
        $cacheKey = "product_paginated_list_{$userID}_{$page}_{$perPage}_" . md5($search);
        
        // Try to get from cache first
        if ($cached = $this->cache->get($cacheKey)) {
            return $cached;
        }

        $builder = $this->db->table('products AS a')
            ->select('a.id, a.name, a.alias, a.status, a.price, a.thumbnail, a.caption, a.created_at, 
                     b.name AS category_name, b.alias AS category_alias')
            ->join('product_categories AS b', 'a.view = b.id', 'INNER')
            ->orderBy('a.created_at', 'DESC');

        if ($userID) {
            $builder->where('a.author', $userID);
        }
        
        // Apply search if provided
        if (!empty($search)) {
            $builder->groupStart()
                ->like('a.name', $search)
                ->orLike('a.caption', $search)
                ->orLike('b.name', $search)
            ->groupEnd();
        }
        
        // Count total records for pagination
        $total = $builder->countAllResults(false);
        
        // Apply pagination
        $offset = ($page - 1) * $perPage;
        $result = $builder->limit($perPage, $offset)->get()->getResult();
        
        $data = [
            'products' => $result,
            'pager' => [
                'total' => $total,
                'perPage' => $perPage,
                'currentPage' => $page,
                'lastPage' => ceil($total / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total)
            ]
        ];
        
        // Cache the result
        $this->cache->save($cacheKey, $data, $this->cacheTTL);
        
        return $data;
    }
}
