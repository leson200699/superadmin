<?php
namespace App\Models;

use CodeIgniter\Model;

class LandingSection_Model extends Model
{
    protected $table = 'landing_sections';
    protected $primaryKey = 'id';
    protected $allowedFields = ['landing_id', 'type', 'name','thumbnail', 'content', 'created_at'];
    public $timestamps = false;
}
