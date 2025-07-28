<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Product_Model;
use App\Models\Product_Category_Model;
use Config\Services; // Import Services để sử dụng Redis cache

class Product extends ResourceController
{
    protected $modelName = 'App\Models\Product_Model';
    protected $format    = 'json';
    protected $cache;

    public function __construct()
    {
        $this->cache = Services::cache(); // Khởi tạo Redis cache
    }

    // Lấy danh sách sản phẩm
    public function index()
    {
        $userId = $this->request->user;
        $cacheKey = "product_index_{$userId}";

        // Kiểm tra cache
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        // Nếu không có cache, truy vấn database
        $products = $this->model->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($products), 600); // Lưu cache 10 phút

        return $this->respond($products, 200);
    }

    // Lấy danh mục sản phẩm
    public function category()
    {
        $userId = $this->request->user;
        $cacheKey = "product_category_{$userId}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $categoryModel = new Product_Category_Model();
        $categories = $categoryModel->where('author', $userId)->findAll();
        $this->cache->save($cacheKey, json_encode($categories), 600);

        return $this->respond($categories, 200);
    }

    // Tìm kiếm sản phẩm theo tên
    public function search()
    {
        $userId = $this->request->user;
        $query  = $this->request->getGet('q');

        if (empty($query)) {
            return $this->respond([], 200);
        }

        $queryNumbers = preg_replace('/\D/', '', $query);
        if (strlen($queryNumbers) < 3) {
            return $this->respond([], 200);
        }

        $cacheKey = "product_search_{$userId}_{$queryNumbers}";
        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->respond(json_decode($cachedData, true), 200);
        }

        $builder = $this->model->where('author', $userId);
        $where = [];
        for ($i = 0; $i <= strlen($queryNumbers) - 3; $i++) {
            $where[] = "name LIKE '%" . substr($queryNumbers, $i, 3) . "%'";
        }
        $builder->where('(' . implode(' OR ', $where) . ')');

        $products = $builder->findAll();
        $this->cache->save($cacheKey, json_encode($products), 600);

        return $this->respond($products, 200);
    }

    // Lấy chi tiết sản phẩm theo alias
    public function detailByAlias($alias)
    {
        $cacheKey = "product_detail_alias_{$alias}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $productModel = new Product_Model();
        $categoryModel = new Product_Category_Model();

        // Truy vấn sản phẩm theo alias
        $product = $productModel->where('alias', $alias)->first();

        if (!$product) {
            return $this->failNotFound('Sản phẩm không tồn tại.');
        }

        // Lấy tên danh mục sản phẩm
        // $category = $categoryModel->find($product['view']);
        // $product['category'] = $category ? $category->name : 'Không xác định';


        // Lưu vào cache trong 10 phút
        $this->cache->save($cacheKey, json_encode(['status' => 'success', 'data' => $product]), 600);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $product,
        ]);
    }

    // Lấy danh sách sản phẩm theo danh mục (alias)
    public function productsByCategoryAlias($categoryAlias)
    {
        $cacheKey = "products_by_category_alias_{$categoryAlias}";

        if ($cachedData = $this->cache->get($cacheKey)) {
            return $this->response->setJSON(json_decode($cachedData, true));
        }

        $productModel = new Product_Model();
        $categoryModel = new Product_Category_Model();

        // Lấy thông tin danh mục
        $category = $categoryModel->where('alias', $categoryAlias)->first();
        if (!$category) {
            return $this->failNotFound('Danh mục không tồn tại.');
        }

        // Thêm dòng này để chuyển đối tượng thành mảng
        $category = (array) $category;


        // Lấy danh mục con
        $subCategories = $categoryModel->where('parent_id', $category['id'])->findAll();

        // Lấy danh sách sản phẩm nhưng chỉ lấy các trường cần thiết
        $productList = $productModel->select('id, name, alias, caption, description, image1, price, created_at, status')
                                    ->where('view', $category['id'])
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll();

        // Dữ liệu trả về
        $response = [
            'status' => 'success',
            'category' => [
                'id' => $category['id'],
                'name' => $category['name'],
                'alias' => $category['alias'],
                'subCategories' => $subCategories
            ],
            'products' => $productList
        ];

        // Lưu cache trong 10 phút
        $this->cache->save($cacheKey, json_encode($response), 600);

        return $this->response->setJSON($response);
    }
}
