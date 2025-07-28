<?php
namespace App\Models;

use CodeIgniter\Model;

class VisaModel extends Model
{
    protected $table = 'visa_orders';
    protected $primaryKey = 'order_id';
    protected $allowedFields = [
        'order_id', 'email', 'full_name', 'phone_number', 'travel_info', 'num_applicants',
        'visa_type', 'purpose_entry', 'processing_time', 'total_price', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Giá cơ bản (có thể cấu hình trong config)
    private $pricing = [
        'tourist' => 50,    // USD
        'business' => 70,
        'student' => 40,
        'other' => 60,
        'processing_time' => [
            '04-06_days' => 0,
            '03_days' => 20,
            '02_days' => 40
        ]
    ];

    public function calculateTotalPrice($data)
    {
        $basePrice = $this->pricing[$data['visa_type']] * $data['num_applicants'];
        $processingFee = $this->pricing['processing_time'][$data['processing_time']];
        return $basePrice + $processingFee;
    }

    public function saveDetail($orderId, $data)
    {
        $db = \Config\Database::connect();
        return $db->table('visa_order_details')->insert([
            'order_id' => $orderId,
            'passport_front' => $data['passport_front'],
            'passport_back' => $data['passport_back'],
            'additional_info' => $data['additional_info'] ?? null
        ]);
    }
}