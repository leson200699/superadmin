<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Product_Ingredient_Model extends Model
{
    protected $table = 'product_ingredient';

    protected $primaryKey = 'id';

    protected $allowedFields = ['content'];

    public function insert_product_ingredient($product_id, $data)
    {
        $this->delete_product_ingredient($product_id);
        $insert_data = $this->repared_insert_data($product_id, $data);
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

    public function delete_product_ingredient($product_id)
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

    public function repared_insert_data($product_id, $data = [])
    {
        $product_ingredient = [];

        foreach ((array)$data as $item) {
            $product_ingredient_item['product_id'] = $product_id;
            $product_ingredient_item['content']    = $item;

            array_push($product_ingredient, $product_ingredient_item);
        }

        return $product_ingredient;
    }

}
