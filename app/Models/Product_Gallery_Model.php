<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Product_Gallery_Model extends Model
{
    protected $table      = 'product_gallery';
    protected $primaryKey = 'id';

    protected $allowedFields = ['product_id', 'image'];

    public function get_product_gallery($product_id)
    {

    }

    public function insert_product_gallery($data)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->insertBatch($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }

    public function delete_product_gallery($parent_id)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->where('parenid', $id)->delete();

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }

    }

}
