<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Config_Model extends Model
{
    protected $table         = 'config';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'author', 'website_name', 'slogan', 'website_intro', 'hotline', 'email', 'email_send', 'address', 'map', 'facebook', 'zalo', 'tiktok', 'logo',
        'logo_footer', 'favicon', 'domain', 'youtube', 'seo_title', 'seo_keyword', 'seo_description', 'copyright'
    ];

    public function getConfig()
    {
        // Bảo đảm trả về mảng
        return $this->asArray()->first();
    }




    public function get_config_by_user($userID)
{
    return $this->where('author', $userID)->first(); // Lấy thông tin theo author (userID)
}


    public function getSeoWebsite(array $fields)
    {
        // Kiểm tra nếu mảng fields không hợp lệ
        if (empty($fields) || !is_array($fields)) {
            throw new \InvalidArgumentException('Phải cung cấp danh sách các trường hợp lệ.');
        }

        // Lấy bản ghi đầu tiên với các cột được chỉ định
        $result = $this->select($fields)->first();

        // Trả về danh sách các trường hoặc null cho trường không tồn tại
        return array_intersect_key($result ?? [], array_flip($fields));
    }

    public function get_config(string $columns)
    {
        $dbConnection = Database::connect();
        $result_data  = $dbConnection->table($this->table)
            ->select($columns)
            ->get()
            ->getRow();
        return $result_data;

    }

    public function update_config_info($data)
    {
        try {
            $dbConnection = Database::connect();

            $dbConnection->transStart();

            $dbConnection->table($this->table)->where('id = ', 2)->update($data);

            $dbConnection->transComplete();

            return $dbConnection->transStatus();

        } catch (\Exception $exception) {

            return false;
        }
    }

}
