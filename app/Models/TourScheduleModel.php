<?php

namespace App\Models;

use CodeIgniter\Model;

class TourScheduleModel extends Model
{
    protected $table = 'tour_schedules';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tour_id', 'day_number', 'schedule', 'schedule_en'];

    public function getSchedulesByTour($tourId)
    {
        return $this->where('tour_id', $tourId)->orderBy('day_number', 'ASC')->findAll();
    }
}