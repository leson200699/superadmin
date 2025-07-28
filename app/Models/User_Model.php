<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Config\Database;

class User_Model extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'email', 'password', 'is_Admin', 'is_Verify'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $selectColumns = ['id', 'username', 'avatar', 'email','password', 'firstname', 'lastname' ,'mobile_no', 'address', 'role', 'is_admin'];
    

    public function __construct(?ConnectionInterface &$db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->builder = Database::connect()->table($this->table);
    }


    public function insert_user($data)
    {
        try {
            $dbConnection = Database::connect(); // Kết nối database
            $dbConnection->transStart(); // Bắt đầu giao dịch

            $dbConnection->table($this->table)->insert($data); // Chèn dữ liệu vào bảng users
            $insertID = $dbConnection->insertID(); // Lấy ID vừa chèn

            if ($insertID) {
                $dbConnection->transComplete(); // Xác nhận giao dịch nếu thành công
            } else {
                $dbConnection->transRollback(); // Nếu lỗi, rollback
                return false;
            }

            if ($dbConnection->transStatus()) {
                return $insertID; // Trả về ID của user mới tạo
            }

            return false;

        } catch (\Exception $exception) {
            log_message('error', $exception->getMessage());
            $dbConnection->transRollback(); // Nếu có lỗi, rollback
            return false;
        }
    }

    public function getRowData($field, $value)
    {
        $dbConnection = Database::connect()->table($this->table)->select($this->selectColumns);
        $resultData   = $dbConnection->where($field, $value)->get()->getRow();
        return $resultData;

    }


    public function getUserWithApiKey($id)
    {
        return $this->select('users.*, user_api_keys.api_key, user_api_keys.status')
            ->join('user_api_keys', 'user_api_keys.user_id = users.id', 'left')
            ->where('users.id', $id)
            ->first();
    }




    // public function insert_user($data)
    // {

    //     try {
    //         $dbConnection = Database::connect();

    //         $dbConnection->transStart();

    //         $dbConnection->table($this->table)->insert($data);

    //         $dbConnection->transComplete();

    //         return $dbConnection->transStatus();

    //     } catch (\Exception $exception) {

    //         return false;
    //     }
    // }

    public function update_user($id, $data)
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

    public function update_user_condition($data, $where = 1)
    {

        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->where($where)->update($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }

    public function delete_user($id)
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

    public function get_user_with_api_key($user_id)
        {
            return $this->select("users.*, user_api_keys.api_key")
                ->join("user_api_keys", "user_api_keys.user_id = users.id", "left")
                ->where("users.id", $user_id)
                ->get()
                ->getRow();
        }


}
