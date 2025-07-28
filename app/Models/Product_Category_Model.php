<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Product_Category_Model extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'parent_id', 'name', 'name_en', 'alias', 'thumbnail', 'multiple_image',
        'caption', 'caption_en', 'content', 'content_en', 'title', 'keyword',
        'description', 'status', 'author'
    ];
    protected $returnType = 'object';

    public function get_product_category_list($userID = null)
    {
        $dbConnection = Database::connect();

        $sqlStatement = "
            SELECT a.id, a.name, a.thumbnail, b.name AS parent_name, a.status, a.author
            FROM product_categories AS a
            LEFT JOIN product_categories AS b ON a.parent_id = b.id
        ";

        if ($userID) {
            $sqlStatement .= " WHERE a.author = :author:";
            return $dbConnection->query($sqlStatement, ['author' => $userID])->getResult();
        }

        return $dbConnection->query($sqlStatement)->getResult();
    }

    public function get_categories_by_author($userID, $parentID = null)
    {
        $builder = $this->select('id, name');
        if ($parentID === null) {
            $builder->where('parent_id', null);
        } else {
            $builder->where('parent_id', $parentID);
        }
        return $builder->where('author', $userID)->get()->getResult();
    }

    public function get_categories_tree($userID)
    {
        $categories = $this->where('author', $userID)
                           ->orderBy('parent_id', 'ASC') // Sắp xếp theo danh mục cha trước
                           ->orderBy('name', 'ASC')
                           ->findAll();

        return $this->build_category_tree($categories);
    }

    // Hàm để tạo cây danh mục cha - con
    private function build_category_tree($categories, $parent_id = null)
    {
        $tree = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parent_id) {
                $children = $this->build_category_tree($categories, $category->id);
                if (!empty($children)) {
                    $category->children = $children;
                }
                $tree[] = $category;
            }
        }
        return $tree;
    }




    public function insert_product_category($data)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->insert($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update_product_category($news_category_id, $data)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->where("id = $news_category_id")->update($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function delete_product_category($category_id)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->delete(['id' => $category_id]);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();
        } catch (\Exception $exception) {
            return false;
        }
    }
}
