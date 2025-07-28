<?php
namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'file_path', 'thumbnail', 'duration', 'author'];
    protected $useTimestamps = true;

    // Lấy danh sách video
    public function getVideos($perPage = 10, $page = 1)
    {
        return $this->paginate($perPage, 'default', $page);
    }

    // Lấy chi tiết video
    public function getVideoById($id)
    {
        return $this->find($id);
    }
}