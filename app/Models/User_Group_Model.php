<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Config\Database;

class User_Group_Model extends Model
{
    protected $table      = 'user_groups';
    protected $primaryKey = 'id';

    protected $allowedFields = ['group_name', 'status', 'is_deletable'];

    //    protected $useSoftDeletes = true;

    //    protected $useTimestamps = false;
    //    protected $createdField  = 'created_at';
    //    protected $updatedField  = 'updated_at';

    //
    //    protected $validationRules    = [];
    //    protected $validationMessages = [];
    //    protected $skipValidation     = false;

    public function delete_group($id)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->delete(['id' => $id]);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }

    public function insert_group($data)
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

    public function update_group($id, $data)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->where('id', $id)->update($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }
}
