<?php

namespace App\Models;

use CodeIgniter\Model;

class TourCategoryModel extends Model
{
    protected $table = 'tourcategories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'thumbnail', 'description', 'name_en', 'description_en', 'domestic_type_id'];

    public function getTourByType($identifier, $authorId)
    {
        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'id' : 'alias';

        $domestic = $this->db->table('domestic_types')
                       ->where($field, $identifier)
                       ->where('author', $authorId)
                       ->get()
                       ->getRowArray();
        if (!$domestic) {
            return [
                'domestic_type' => null,
                'tours' => [],
            ];
        }

        $tours = $this->where('domestic_type_id', $domestic['id'])->findAll();

         return [
            'domestic_type' => $domestic,
            'tours' => $tours,
        ];
    }

    public function getToursByCategory($categoryId, $userId)
    {
        return $this->db->table('tours')
            ->where('tourcategory_id', $categoryId)
            ->where('author_id', $userId)
            ->get()
            ->getResultArray();
    }
}
