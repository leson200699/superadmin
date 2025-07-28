<?php

namespace App\Models;

use CodeIgniter\Model;

class Team_Member_Model extends Model
{
    protected $table         = 'team_members';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['fullname', 'image', 'description', 'author'];


    public function get_team_by_user($userId)
    {
        return $this->where('author', $userId)
                    ->findAll();
    }

}
