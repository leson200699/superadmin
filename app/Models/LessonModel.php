<?php

namespace App\Models;
use CodeIgniter\Model;

class LessonModel extends Model {
    protected $table = 'lessons';
    protected $allowedFields = ['course_id', 'title', 'content', 'instructor_id'];
}