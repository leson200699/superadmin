<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Product_User_Guide_Model extends Model
{
    protected $table      = 'product_user_guide';
    protected $primaryKey = 'id';

    protected $allowedFields = ['content', 'step'];

    public function get_product_user_guide($product_id)
    {
        $dbConnection = Database::connect();

        $sql_query = "
            SELECT content, step
            FROM product_user_guide
            where product_id = $product_id
            ORDER BY step ASC
        ";

        $result_data = $dbConnection->query($sql_query)->getResult();

        return $result_data;
    }
    public function insert_product_user_guide($product_id, $data)
    {
        $this->delete_product_user_guide($product_id);

        $insert_data = $this->prepare_insert_data($product_id, $data);
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->insertBatch($insert_data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }

    public function delete_product_user_guide($product_id)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->delete("product_id = $product_id");

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }

    }

    public function prepare_insert_data($product_id, $data = [])
    {
        $product_user_guide = [];
        $step               = 1;
        foreach ((array)$data as $item) {
            $product_user_guide_item['product_id'] = $product_id;
            $product_user_guide_item['content']    = $item;
            $product_user_guide_item['step']       = $step;
            array_push($product_user_guide, $product_user_guide_item);
            $step = $step + 1;
        }

        return $product_user_guide;

    }
}
