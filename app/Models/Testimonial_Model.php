<?php

namespace App\Models;

use CodeIgniter\Model;

class Testimonial_Model extends Model
{
    protected $table         = 'testimonials';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['author', 'customer_name', 'testimonial', 'career', 'thumbnail'];

    // Optionally, you can add timestamps if needed
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    public function get_testimonial_by_user($userId)
    {
        return $this->where('author', $userId)
                    ->findAll();
    }
}
