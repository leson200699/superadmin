<?php

namespace App\Controllers\B;


use App\Models\Car_Model;
use App\Models\CarCategory_Model;
use CodeIgniter\Controller;
use Config\Services;

class Car extends Controller
{
    protected $carModel;

    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper', 'vn_to_en']);
         $this->cache = Services::cache(); // Khởi tạo Redis cache
         $this->carModel = new Car_Model(); // Khởi tạo carModel
    }


    public function index()
    {
        $user = get_user_data();
        $userId = $user['id'] ?? 0;
        
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        // Tham số phân trang và tìm kiếm
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12; // Hiển thị 12 xe mỗi trang
        $search = $this->request->getGet('search') ?? '';
        
        // Lấy danh sách xe có phân trang
        $carModel = new Car_Model();
        $paginated_result = $carModel->get_paginated_cars($userId, $page, $perPage, $search);

        $view_data = [
            'title'     => 'Danh sách xe',
            'cars'      => $paginated_result['cars'],
            'pager'     => $paginated_result['pager'],
            'search'    => $search,
            'tab'       => 'car, car l',
            'user'      => $user
        ];
        echo view("B/pages/car/car_list", $view_data);
    }

    public function create()
    {
        $user = get_user_data();
        $categories_model = new CarCategory_Model();
        $categories = $categories_model->findAll();
        $view_data  = [
            'title'     => lang('validation.news_manage'),
            'categories' => $categories,
            'tab'       => 'tin tuc, tin tuc l',
            'user' => $user
        ];
        
        echo view("B/pages/car/car_create", $view_data);
    }



    public function store()
    {
        $validation = \Config\Services::validation();
        // Quy tắc validate
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric|greater_than[0]',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'permit_empty|valid_url',
            'video_url' => 'permit_empty|valid_url',
            'colors' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Lấy dữ liệu từ form
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->generateSlug($this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'year' => $this->request->getPost('year'),
            'engine' => $this->request->getPost('engine'),
            'transmission' => $this->request->getPost('transmission'),
            'fuel_type' => $this->request->getPost('fuel_type'),
            'mileage' => $this->request->getPost('mileage'),
            'caption' => $this->request->getPost('caption'),
            'content' => $this->request->getPost('content'),
            'video_url' => $this->request->getPost('video_url'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'category_id' => $this->request->getPost('category_id'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keyword' => $this->request->getPost('meta_keyword'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status' => $this->request->getPost('status') ?? 1,
            'author' => get_user_data('id'), // Thêm author
        ];

        // Lưu xe vào database
        $carId = $this->carModel->insertCar($data);

        if ($carId) {
            // Xử lý màu xe
            $colors = $this->request->getPost('colors');
            if (!empty($colors)) {
                $colors = json_decode($colors, true);
                if (is_array($colors)) {
                    foreach ($colors as $color) {
                        if (!empty($color['hex']) && !empty($color['image'])) {
                            $this->carModel->insertColor($carId, [
                                'hex_code' => $color['hex'],
                                'image_url' => $color['image'],
                            ]);
                        }
                    }
                }
            }

            // Xử lý thư viện ảnh
            $galleryImageIds = $this->request->getPost('gallery_image_ids');
            if (!empty($galleryImageIds)) {
                $imageIds = explode(',', $galleryImageIds);
                foreach ($imageIds as $imageId) {
                    // Giả sử image_url được lấy từ bảng images hoặc từ file manager
                    $imageUrl = $this->carModel->getImageUrlById($imageId);
                    if ($imageUrl) {
                        $this->carModel->insertGalleryImage($carId, $imageUrl);
                    }
                }
            }

            return redirect()->to('/admin/cars')->with('message', 'Thêm xe thành công!');
        }

        return redirect()->back()->with('error', 'Không thể thêm xe. Vui lòng thử lại.');
    }



    public function edit($id)
    {
        $car = $this->carModel->find($id);
        if (!$car) {
            return redirect()->to('/admin/car')->with('error', 'Xe không tồn tại!');
        }
        
        $categories = (new CarCategory_Model())->findAll();
        $colors = $this->carModel->get_car_colors($id);
        
        // Chuyển đổi format colors để phù hợp với Alpine.js
        $formattedColors = [];
        if (!empty($colors)) {
            foreach ($colors as $color) {
                $formattedColors[] = [
                    'hex' => $color['hex_code'] ?? $color['hex'],
                    'image' => $color['image_url'] ?? $color['image']
                ];
            }
        }
        
        // Thêm colors vào car data
        $car['colors'] = $formattedColors;
        
        $view_data = [
            'car' => $car,
            'categories' => $categories,
            'colors' => $formattedColors, // For backward compatibility
            'title' => 'Chỉnh sửa xe',
        ];
        
        echo view('B/pages/car/car_create', $view_data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        
        // Quy tắc validate
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric|greater_than[0]',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'permit_empty|valid_url',
            'video_url' => 'permit_empty|valid_url',
            'colors' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Lấy dữ liệu từ form
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->generateSlug($this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
            'year' => $this->request->getPost('year'),
            'engine' => $this->request->getPost('engine'),
            'transmission' => $this->request->getPost('transmission'),
            'fuel_type' => $this->request->getPost('fuel_type'),
            'mileage' => $this->request->getPost('mileage'),
            'caption' => $this->request->getPost('caption'),
            'content' => $this->request->getPost('content'),
            'video_url' => $this->request->getPost('video_url'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'category_id' => $this->request->getPost('category_id'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_keyword' => $this->request->getPost('meta_keyword'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status' => $this->request->getPost('status') ?? 1,
        ];

        // Cập nhật xe trong database
        $updated = $this->carModel->update($id, $data);

        if ($updated) {
            // Xử lý màu xe
            $colors = $this->request->getPost('colors');
            if (!empty($colors)) {
                $colors = json_decode($colors, true);
                if (is_array($colors)) {
                    $this->carModel->updateCarColors($id, $colors);
                }
            } else {
                // Xóa tất cả màu nếu không có màu nào được gửi
                $this->carModel->deleteCarColors($id);
            }

            return redirect()->to('/admin/car')->with('message', 'Cập nhật xe thành công!');
        }

        return redirect()->back()->with('error', 'Không thể cập nhật xe. Vui lòng thử lại.');
    }

    public function delete($id)
    {
        (new Car_Model())->delete($id);
        return redirect()->to('/admin/car');
    }

    /**
     * Tạo slug từ tên xe
     */
    private function generateSlug($name)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Kiểm tra slug trùng lặp
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->carModel->where('slug', $slug)->countAllResults() > 0) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Cập nhật trạng thái xe qua Ajax
     */
    public function update_status()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Người dùng chưa đăng nhập'
            ]);
        }

        // Lấy dữ liệu từ yêu cầu POST
        $id     = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Kiểm tra xem yêu cầu có phải là AJAX không
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Yêu cầu không hợp lệ'
            ]);
        }

        // Kiểm tra xe có tồn tại và thuộc về người dùng hiện tại không
        $car = $this->carModel->where('id', $id)->where('author', $userID)->first();
        
        if (!$car) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Xe không tồn tại hoặc bạn không có quyền'
            ]);
        }

        // Cập nhật trạng thái
        $updateData = ['status' => $status];
        $updateStatus = $this->carModel->update($id, $updateData);

        // Kiểm tra xem việc cập nhật có thành công không
        if ($updateStatus) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Trạng thái đã được cập nhật!'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Không thể cập nhật trạng thái'
        ]);
    }
}
