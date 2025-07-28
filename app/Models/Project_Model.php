<?php 

namespace App\Models;
use CodeIgniter\Model;
use \Config\Database;

class Project_Model extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'author', 'alias', 'type', 'attributes', 'multiple_image', 'province_id', 'district_id', 'ward_id', 'price', 'thumbnail', 'description', 'content', 'status'];
    protected $returnType = 'object';

    // Lấy danh sách dự án với tỉnh và huyện đi kèm
    public function getAllProjects()
    {
        return $this->select('project.*, province.name as province_name, district.name as district_name, ward.name as ward_name')
                    ->join('province', 'project.province_id = province.id', 'left')
                    ->join('district', 'project.district_id = district.id', 'left')
                    ->join('ward', 'project.ward_id = ward.id', 'left')
                    ->findAll();
    }
    public function getAllProjectsByUser($userId)
    {
        return $this->select('project.*, province.name as province_name, district.name as district_name, ward.name as ward_name')
                    ->join('province', 'project.province_id = province.id', 'left')
                    ->join('district', 'project.district_id = district.id', 'left')
                    ->join('ward', 'project.ward_id = ward.id', 'left')
                    ->where('project.author', $userId) // Lọc theo user_id
                    ->findAll();
    }

    public function get_project_detail($identifier)
    {
        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'project.id' : 'project.alias';

        return $this->select('id, name, author, alias, type, thumbnail, multiple_image, content, price, description, status, province_id, district_id, ward_id')
                        ->where($field, $identifier)
                        ->first();
    }

    public function getProjectWithID($id)
    {
        $project = $this->select('id, name, caption, author, alias, type, thumbnail, multiple_image, content, price, description, status, province_id, district_id, ward_id, title, keyword, description')
                        ->where('id', $id)
                        ->first();

        if ($project) {
            $project->images = !empty($project->multiple_image) ? explode(',', $project->multiple_image) : [];
        }
        return $project;
    }


        public function delete_project($id)
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
