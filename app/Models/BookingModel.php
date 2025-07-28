<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tour_id', 'customer_name', 'email', 'phone', 'quantity', 'booking_date', 'status'];
}