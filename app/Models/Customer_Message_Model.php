<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Customer_Message_Model extends Model
{
    protected $table         = 'customer_messages';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'fullname', 'phone', 'email', 'message', 'is_replied', 'is_read', 'status', 'created_at'
    ];

    public function get_customer_message($id = null)
    {
        $dbConnection = Database::connect();
        if ($id) {
            $result_data = $dbConnection->table($this->table)->where('id', $id)->get()->getRow();

        } else {
            $result_data = $dbConnection->table($this->table)->get()->getResult();

        }

        return $result_data;

    }

    public function insert_customer_message($data)
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
}
