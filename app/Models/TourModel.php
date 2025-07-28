<?php

namespace App\Models;

use CodeIgniter\Model;

class TourModel extends Model
{
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'author_id', 'tourcategory_id', 'name', 'alias', 'description', 'price', 'start_date', 'duration',
        'location', 'thumbnail', 'multiple_image', 'itinerary', 'transport', 'notes', 'created_at', 'updated_at',
        'name_en', 'description_en', 'itinerary_en', 'notes_en', 'is_hot', 'discount'
    ];
    protected $useTimestamps = false;

    public function getTourWithSchedules($id)
    {
        return $this->select('tours.*, tourcategories.name as tourcategory_name, tourcategories.name_en as tourcategory_name_en, tourcategories.domestic_type_id')
            ->join('tourcategories', 'tourcategories.id = tours.tourcategory_id')
            ->find($id);
    }

    public function getHotToursByAuthor($authorId)
    {
        return $this->select('tours.*, tourcategories.name as tourcategory_name, tourcategories.name_en as tourcategory_name_en, tourcategories.domestic_type_id')
            ->join('tourcategories', 'tourcategories.id = tours.tourcategory_id')
            ->where('tours.is_hot', 1)
            ->where('tours.author_id', $authorId)
            ->findAll();
    }

}