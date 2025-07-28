<?php
namespace App\Models;
use CodeIgniter\Model;

class InstructorModel extends Model
{
    protected $table = 'instructors';
    protected $allowedFields = ['name', 'bio'];
    protected $useTimestamps = true;
}