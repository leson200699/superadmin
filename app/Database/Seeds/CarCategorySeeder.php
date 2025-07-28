<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Xe Sedan',
                'slug' => 'xe-sedan',
                'description' => 'Xe sedan 4 cửa, phù hợp cho gia đình',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Xe SUV',
                'slug' => 'xe-suv',
                'description' => 'Xe thể thao đa dụng, cao cấp',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Xe Hatchback',
                'slug' => 'xe-hatchback',
                'description' => 'Xe nhỏ gọn, tiết kiệm nhiên liệu',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Xe MPV',
                'slug' => 'xe-mpv',
                'description' => 'Xe đa dụng, nhiều chỗ ngồi',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Xe Pickup',
                'slug' => 'xe-pickup',
                'description' => 'Xe bán tải, chở hàng',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('car_categories')->insertBatch($data);
    }
} 