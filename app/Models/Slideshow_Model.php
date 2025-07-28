<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Slideshow_Model extends Model
{
    protected $table      = 'slideshow';
    protected $primaryKey = 'id';
    protected $allowedFields = ['author', 'name', 'name_en', 'caption', 'caption_en', 'thumbnail', 'link', 'video', 'status', 'deletable'];

    public function getSlideshows($authorId)
    {
        return $this->where('author', $authorId)->findAll();
    }

    public function getSlideByLocale($locale)
    {
        return $this->select($locale === 'vi' ? 'name, caption, thumbnail' : 'name_en as name, caption_en as caption, thumbnail')
                    ->where('status', 1)
                    ->findAll();
    }



    public function insert_slideshow_get_id($data)
    {
        try {
            $dbConnection = Database::connect();
            $dbConnection->transStart();
            $dbConnection->table($this->table)->insert($data);
            $insert_id = $dbConnection->insertID();
            $dbConnection->transComplete();

            return $dbConnection->transStatus() ? $insert_id : false;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function update_slideshow($id, $data)
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

    public function delete_slideshow($id)
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
}