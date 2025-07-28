<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Slideshow_Detail_Model extends Model
{
    protected $table      = 'slideshow_slides';
    protected $primaryKey = 'id';

    protected $allowedFields = ['slideshow_id', 'url', 'link'];

    public function get_slideshow_detail($id)
    {
        $dbConnection = Database::connect();

        $result_data = $dbConnection->table($this->table)->select('url, link')->where('slideshow_id=', $id)->get()->getResult();

        return $result_data;

    }

    public function insert_slideshow_detail($data)
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

    public function delete_slideshow_detail($id)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->delete(['slideshow_id' => $id]);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }
}
