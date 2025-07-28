<?php
namespace App\Models;
use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $allowedFields = ['title', 'author', 'level', 'price', 'caption', 'content', 'register_link', 'schedule', 'thumbnail'];
    protected $useTimestamps = true;
}