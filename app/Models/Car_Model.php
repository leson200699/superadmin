<?php

namespace App\Models;
use CodeIgniter\Model;

class Car_Model extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'order', 'author', 'slug', 'price', 'pile_price', 'brand', 'model', 'year',
        'engine', 'transmission', 'fuel_type', 'mileage', 'color',
        'description', 'content', 'thumbnail', 'multiple_image', 'status', 'video_url', 'brochure', 'category_id', 'caption',
        'meta_title', 'meta_keyword', 'meta_description', 'status',
        'dai_rong_x_cao', 'chieu_dai_so', 'khoang_sang_gam_xe', 'cong_suat_toi_da',
        'mo_men_xoan_cuc_dai', 'quang_duong_chay_NEDC', 'dung_luong_pin_kwh',
        'cong_suat_sac_toi_da', 'dan_dong', 'che_do_di', 'he_thong_treo_truoc_sau',
        'dia_tang_trong', 'kich_thuoc_la_zang', 'den_chieu_sang_phia_truoc',
        'dong_mo_cua_sau', 'he_thong_die_u_hoa', 'man_hinh_thong_tin_lai',
        'chuong_nghe_di_tri', 'he_thong_loa', 'ghe_lai',
        'so_cho_ngoi', 'ban_kinh_quay_dau',
        'dung_tich_khoang_hanh_ly', 'thoi_gian_nap_pin_nhanh_nhat'
    ];

    /**
     * Get cars by author ID
     * 
     * @param int $authorId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getByAuthor(int $authorId)
    {
        return $this->where('author', $authorId)
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->getResult();
    }

    public function get_car_by_user(int $authorId): array
    {
        return $this->where('author', $authorId)
                    ->where('status', 1)
                    ->orderBy('order', 'ASC')
                    ->get()
                    ->getResult();
    }

    /**
     * Get a car by slug or ID
     * 
     * @param string|int $identifier
     * @return array|null
     */
    public function get_car_detail($identifier)
    {
        $isNumeric = is_numeric($identifier);
        $field = $isNumeric ? 'cars.id' : 'cars.slug';

        return $this->db->table('cars')
            ->select('cars.id, cars.slug, cars.thumbnail, cars.multiple_image, cars.banner, cars.video_url, cars.brochure, cars.created_at, 
                      cars.name, cars.caption, cars.content, cars.brand, cars.model, cars.year, cars.engine, cars.transmission, cars.fuel_type, cars.mileage, cars.color, cars.price, cars.pile_price, cars.description, cars.category_id, car_categories.name as category_name,
                      cars.dai_rong_x_cao, cars.chieu_dai_so, cars.khoang_sang_gam_xe, cars.cong_suat_toi_da,
                      cars.mo_men_xoan_cuc_dai, cars.quang_duong_chay_NEDC, cars.dung_luong_pin_kwh,
                      cars.cong_suat_sac_toi_da, cars.dan_dong, cars.che_do_di, cars.he_thong_treo_truoc_sau,
                      cars.dia_tang_trong, cars.kich_thuoc_la_zang, cars.den_chieu_sang_phia_truoc,
                      cars.dong_mo_cua_sau, cars.he_thong_die_u_hoa, cars.man_hinh_thong_tin_lai,
                      cars.chuong_nghe_di_tri, cars.he_thong_loa, cars.ghe_lai,
                      cars.so_cho_ngoi, cars.ban_kinh_quay_dau,
                      cars.dung_tich_khoang_hanh_ly, cars.thoi_gian_nap_pin_nhanh_nhat')
            ->join('car_categories', 'cars.category_id = car_categories.id', 'left')
            ->where($field, $identifier)
            ->get()
            ->getRowArray();
    }

    public function get_car_colors($carId)
    {
        return $this->db->table('car_colors')
            ->where('car_id', $carId)
            ->get()
            ->getResultArray();
    }

    /**
     * Lấy danh sách xe có phân trang
     * 
     * @param int $authorId ID của tác giả
     * @param int $page Trang hiện tại
     * @param int $perPage Số bản ghi mỗi trang
     * @param string $search Từ khóa tìm kiếm
     * @return array Mảng chứa danh sách xe và thông tin phân trang
     */
    public function get_paginated_cars(int $authorId, int $page = 1, int $perPage = 12, string $search = '')
    {
        // Xây dựng truy vấn
        $builder = $this->db->table($this->table . ' AS c')
            ->select('c.*, cat.name AS category_name')
            ->join('car_categories AS cat', 'c.category_id = cat.id', 'left')
            ->where('c.author', $authorId)
            ->orderBy('c.created_at', 'DESC');
        
        // Thêm điều kiện tìm kiếm nếu có
        if (!empty($search)) {
            $builder->groupStart()
                ->like('c.name', $search)
                ->orLike('c.caption', $search)
                ->orLike('c.brand', $search)
                ->orLike('c.model', $search)
                ->orLike('cat.name', $search)
            ->groupEnd();
        }
        
        // Đếm tổng số bản ghi để phân trang
        $total = $builder->countAllResults(false);
        
        // Áp dụng phân trang
        $offset = ($page - 1) * $perPage;
        $result = $builder->limit($perPage, $offset)->get()->getResult();
        
        // Trả về dữ liệu và thông tin phân trang
        return [
            'cars' => $result,
            'pager' => [
                'total' => $total,
                'perPage' => $perPage,
                'currentPage' => $page,
                'lastPage' => ceil($total / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total)
            ]
        ];
    }
}