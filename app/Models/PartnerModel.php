<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerModel extends Model
{
    protected $table = 'partners';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'name_en', 'logo', 'status', 'created_at', 'updated_at', 'author'];
    protected $useTimestamps = true;


    public function get_partner_by_user($user_id)
    {
        return $this->db->table($this->table)
            ->select("{$this->table}.id, {$this->table}.name, {$this->table}.name_en, {$this->table}.logo, {$this->table}.status, {$this->table}.author")
            ->where("{$this->table}.author", $user_id)
            ->orderBy("{$this->table}.id", "DESC")
            ->get()
            ->getResult();
    }


}



