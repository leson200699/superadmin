<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Product_Model;
use App\Models\Product_Category_Model;
use CodeIgniter\Controller;

class Product extends BaseFrontendController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new Product_Model();
        $this->categoryModel = new Product_Category_Model();
    }

    /**
     * Hiển thị danh sách tin tức
     */
    public function index()
    {   
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default'; // <- lấy username nè
        $productList = $this->productModel->get_product_list($userId);

        // Lấy danh sách danh mục (dạng cây cha-con, filter theo user)
        $categories = $this->categoryModel->get_categories_tree($this->user['id']);

        // Nếu muốn list phẳng, dùng: $categories = $this->categoryModel->get_product_category_list($this->user['id']);


        return view('F/' . $username . '/products/index', [
            'productList' => $productList,
            'title' =>  'Danh sách tin tức',
            'categories' => $categories,
        ]);
    }

    /**
     * Hiển thị chi tiết tin tức theo ID hoặc alias
     */
    public function detail($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $productDetail = $this->productModel->get_product_detail($identifier);

        if (!$productDetail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tin tức không tồn tại");
        }

        // Lấy thêm tin liên quan nếu muốn
        //$relatedNews = $this->serviceModel->get_related_news($newsDetail['category_id'], $newsDetail['id']);



        // Lấy danh sách danh mục (dạng cây cha-con, filter theo user)
        $categories = $this->categoryModel->get_categories_tree($this->user['id']);

        // Nếu muốn list phẳng, dùng: $categories = $this->categoryModel->get_product_category_list($this->user['id']);

        return view('F/' . $username . '/products/detail', [
            'title' => $productDetail['name'],
            'productDetail' => $productDetail,
            'categories' => $categories,
        ]);
    }

    /**
     * Hiển thị danh sách tin tức theo danh mục (ID hoặc alias)
     */
    public function category($identifier)
    {
        $username = $this->user['username']; // <- lấy username nè
        $productByCategory = $this->productModel->get_products_by_category($identifier);
        $categories = $this->categoryModel->get_categories_tree($this->user['id']);

        if (empty($productByCategory)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Không tìm thấy tin tức trong danh mục này");
        }

        return view('F/' . $username . '/products/category', [
            'productByCategory' => $productByCategory,
            'categories' => $categories,
        ]);
    }
}
