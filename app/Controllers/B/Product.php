<?php

namespace App\Controllers\B;

use App\Models\Product_Category_Model;
use App\Models\Product_Ingredient_Model;
use App\Models\Product_Model;
use App\Models\Product_User_Guide_Model;
use CodeIgniter\Controller;
use Config\Services;

class Product extends Controller
{
    protected $cache;

    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper', 'vn_to_en']);
        $this->cache = Services::cache();
    }

    public function index()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12; // Show 12 products per page as requested
        $search = $this->request->getGet('search') ?? '';

        $product_model = new Product_Model();
        $paginated_result = $product_model->get_paginated_product_list($userID, $page, $perPage, $search);

        $view_data = [
            'title'        => 'Danh sách sản phẩm',
            'product_list' => $paginated_result['products'],
            'pager'        => $paginated_result['pager'],
            'search'       => $search,
            'tab'          => 'tin tuc, tin tuc l'
        ];
        return view("B/pages/product/product_list", $view_data);
    }

    public function create_product()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_categories_model = new Product_Category_Model();
        $product_categories = $product_categories_model->get_categories_tree($userID); // Lấy danh mục theo cây

        $view_data = [
            'title'              => 'Thêm sản phẩm mới',
            'product_categories' => $product_categories
        ];

        return view('B/pages/product/product_create', $view_data);
    }


    public function edit_product($product_id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_categories_model = new Product_Category_Model();
        $product_categories = $product_categories_model->select('id, name')
                                                      ->where('author', $userID)
                                                      ->get()
                                                      ->getResult();

        $product_model = new Product_Model();
        $edit_product = $product_model->select('id, name, status, image1, image2, caption, price, content, best_seller, title, view, keyword, description')
                                     ->where('id', $product_id)
                                     ->where('author', $userID)
                                     ->get()
                                     ->getRow();

        if (!$edit_product) {
            return redirect_with_message('error', 'Sản phẩm không tồn tại hoặc bạn không có quyền');
        }

        $product_ingredient_model = new Product_Ingredient_Model();
        $edit_product->ingredient = $product_ingredient_model->select('content')->where('product_id', $product_id)->get()->getResult();

        $product_user_guide_model = new Product_User_Guide_Model();
        $edit_product->user_guide = $product_user_guide_model->get_product_user_guide($product_id);

        $view_data = [
            'title'              => 'Chỉnh sửa sản phẩm',
            'edit_product'       => $edit_product,
            'product_categories' => $product_categories,
        ];
        return view("B/pages/product/product_edit", $view_data);
    }

    public function post_create_product()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $validation = Services::validation();

        $form_input_data['name'] = $this->request->getVar('name');
        $validation_rules['name'] = 'required|min_length[10]|max_length[255]|is_unique[products.name]';
        $form_input_data['thumbnail']   = $this->request->getVar('thumbnail');
        $form_input_data['view'] = $this->request->getVar('category');
        $validation_rules['view'] = 'required|is_natural';
        $form_input_data['multiple_image']   = $this->request->getVar('gallery_image_ids');


        $form_input_data['price'] = $this->request->getVar('price');
        $validation_rules['price'] = 'required|is_natural|greater_than[0]';

        if ($this->request->getVar('best_seller')) {
            $form_input_data['best_seller'] = $this->request->getVar('best_seller');
            $validation_rules['best_seller'] = 'required|in_list[1]';
        }

        $form_input_data['status'] = $this->request->getVar('status');
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';


        if ($this->request->getVar('caption')) {
            $form_input_data['caption'] = $this->request->getVar('caption');
            $validation_rules['caption'] = 'max_length[512]';
        }

        if ($this->request->getVar('title')) {
            $form_input_data['title'] = $this->request->getVar('title');
            $validation_rules['title'] = 'max_length[255]';
        }

        if ($this->request->getVar('keyword')) {
            $form_input_data['keyword'] = $this->request->getVar('keyword');
            $validation_rules['keyword'] = 'max_length[255]';
        }

        if ($this->request->getVar('description')) {
            $form_input_data['description'] = $this->request->getVar('description');
            $validation_rules['description'] = 'max_length[255]';
        }

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        // if ($validation->getErrors()) {
        //     return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', 'admin-product-list');
        // }

         if ($validation->getErrors()) {
            return redirect_with_message_url('error', array_values($validation->getErrors()), 'admin-product-list');
        }




        $form_input_data['content'] = $this->request->getVar('content');
        $form_input_data['alias'] = $this->request->getVar('alias');
        $form_input_data['created_at'] = date('Y-m-d H:i:s');
        $form_input_data['updated_at'] = date('Y-m-d H:i:s');
        $form_input_data['author'] = $userID;

        $product_model = new Product_Model();
        $insert_id = $product_model->insert_product_get_id($form_input_data);

        if ($insert_id) {
            $product_ingredient_model = new Product_Ingredient_Model();
            $this->request->getVar('ingredient') ? $product_ingredient_model->insert_product_ingredient($insert_id, $this->request->getVar('ingredient')) : false;

            $product_user_guide_model = new Product_User_Guide_Model();
            $this->request->getVar('user_guide') ? $product_user_guide_model->insert_product_user_guide($insert_id, $this->request->getVar('user_guide')) : false;

            $this->cache->delete("product_index_{$userID}");
            return redirect_with_message_url('success', 'Tạo sản phẩm thành công!', 'admin-product-list');
        }
        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-product-list');
    }

    public function delete_Product($product_id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_model = new Product_Model();
        $check_exist_delete_product = $product_model->find($product_id);

        if (!$check_exist_delete_product || $check_exist_delete_product->author != $userID) { // Đã đúng với ->author
            return redirect_with_message('error', 'Sản phẩm không tồn tại hoặc bạn không có quyền');
        }

        $product_ingredient_model = new Product_Ingredient_Model();
        $delete_product_ingredient_status = $product_ingredient_model->delete_product_ingredient($product_id);

        if (!$delete_product_ingredient_status) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
        }

        $product_user_guide_model = new Product_User_Guide_Model();
        $delete_product_user_guide_status = $product_user_guide_model->delete_product_user_guide($product_id);

        if (!$delete_product_user_guide_status) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
        }

        $delete_product_status = $product_model->delete_product($product_id);

        if ($delete_product_status) {
            $this->cache->delete("product_index_{$userID}");
            $this->cache->delete("product_show_{$product_id}_{$userID}");
            return redirect_with_message('success', 'Xóa sản phẩm thành công!');
        }

        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }




    public function post_edit_product()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_id = $this->request->getVar('id');
        $product_model = new Product_Model();

        // Kiểm tra sản phẩm tồn tại và quyền sở hữu
        $product = $product_model->where('id', $product_id)->where('author', $userID)->first();
        if (!$product) {
            return redirect_with_message_url('error', 'Sản phẩm không tồn tại hoặc bạn không có quyền', 'admin-product-list');
        }

        $validation = Services::validation();
        $form_input_data = [];

        // Validation rules
        $validation_rules = [
            'name'        => "required|min_length[10]|max_length[255]|is_unique[products.name,id,{$product_id}]",
        ];

        // Lấy dữ liệu từ form
        $form_input_data = [
            'name'        => $this->request->getVar('name'),
            'view'        => $this->request->getVar('category'),
            'price'       => $this->request->getVar('price'),
            'status'      => $this->request->getVar('status'),
            'image1'      => $this->request->getVar('thumbnail'),
            'best_seller' => $this->request->getVar('best_seller'),
            'caption'     => $this->request->getVar('caption'),
            'title'       => $this->request->getVar('title'),
            'keyword'     => $this->request->getVar('keyword'),
            'description' => $this->request->getVar('description'),
            'image2'      => $this->request->getVar('img-user-guide'),
            'content'     => $this->request->getVar('content'),
            'alias'       => url_title(vn_to_en($this->request->getVar('name')), '-', true),
            'updated_at'  => date('Y-m-d H:i:s'),
            'author'      => $userID
        ];

        // Kiểm tra validation
        if (!$validation->setRules($validation_rules)->run($form_input_data)) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', "admin-product-list");
        }

        // Cập nhật sản phẩm
        $update_status = $product_model->update($product_id, $form_input_data);
        if ($update_status) {
            // Xử lý ingredient
            $product_ingredient_model = new Product_Ingredient_Model();
            $product_ingredient_model->where('product_id', $product_id)->delete();
            if ($this->request->getVar('ingredient')) {
                $product_ingredient_model->insert_product_ingredient($product_id, $this->request->getVar('ingredient'));
            }

            // Xử lý user guide
            $product_user_guide_model = new Product_User_Guide_Model();
            $product_user_guide_model->where('product_id', $product_id)->delete();
            if ($this->request->getVar('user_guide')) {
                $product_user_guide_model->insert_product_user_guide($product_id, $this->request->getVar('user_guide'));
            }

            // Xóa cache
            $this->cache->delete("product_index_{$userID}");
            $this->cache->delete("product_show_{$product_id}_{$userID}");

            return redirect_with_message_url('success', 'Cập nhật sản phẩm thành công!', 'admin-product-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, "admin-product-list");
    }

    public function category_list()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $category_model = new Product_Category_Model();
        $category_data = $category_model->get_product_category_list($userID); // Lọc theo author
        $view_data = [
            'title'         => 'Danh mục sản phẩm',
            'category_list' => $category_data,
        ];
        return view('B/pages/product/category_list', $view_data);
    }


    // Tạo danh mục sản phẩm
    public function create_category()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $category_model = new Product_Category_Model();
        $category_data = $category_model->get_categories_by_author($userID);

        $view_data = [
            'title'         => 'Danh mục sản phẩm',
            'category_list' => $category_data,
        ];
        return view('B/pages/product/category_create', $view_data);
    }

    public function post_create_category()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $validation = Services::validation();

        $form_input_data['name'] = $this->request->getVar('name');
        $validation_rules['name'] = 'required|max_length[255]|is_unique[product_categories.name]';

        $product_category_model = new Product_Category_Model();
        $form_input_data['parent_id'] = $this->request->getVar('parent');
        if (!empty($form_input_data['parent_id']) && $form_input_data['parent_id'] != 0) {
            $check_exist_parent = $product_category_model->find($form_input_data['parent_id']);
            if (!$check_exist_parent || $check_exist_parent->author != $userID) { // Sửa ['author'] thành ->author
                return redirect_with_message('error', 'Danh mục cha không tồn tại hoặc không thuộc quyền của bạn');
            }
        } else {
            $form_input_data['parent_id'] = null;
        }

        $form_input_data['status'] = $this->request->getVar('status');
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';

        if ($this->request->getVar('title')) {
            $form_input_data['title'] = $this->request->getVar('title');
            $validation_rules['title'] = 'max_length[255]';
        }

        if ($this->request->getVar('keyword')) {
            $form_input_data['keyword'] = $this->request->getVar('keyword');
            $validation_rules['keyword'] = 'max_length[255]';
        }

        if ($this->request->getVar('description')) {
            $form_input_data['description'] = $this->request->getVar('description');
            $validation_rules['description'] = 'max_length[255]';
        }

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message('error', 'Thông tin nhập không hợp lệ!');
        }

        $form_input_data['thumbnail'] = $this->request->getVar('thumbnail');
        $form_input_data['multiple_image'] = $this->request->getVar('post_images');
        $form_input_data['caption'] = $this->request->getVar('caption');
        $form_input_data['caption_en'] = $this->request->getVar('caption_en');
        $form_input_data['content'] = $this->request->getVar('content');
        $form_input_data['content_en'] = $this->request->getVar('content_en');
        $form_input_data['alias'] = url_title(vn_to_en($form_input_data['name']), '-', true);
        $form_input_data['author'] = $userID;

        $insert_status = $product_category_model->insert_product_category($form_input_data);

        if ($insert_status) {
            $this->cache->delete("product_category_index_{$userID}");
            return redirect_with_message_url('success', 'Thêm danh mục thành công!', 'admin-product-category-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-product-category-list');
    }
    // Chỉnh sửa danh mục
    public function edit_category($id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_category_model = new Product_Category_Model();

        // Lấy danh sách danh mục cha tiềm năng: thuộc author, không phải danh mục đang chỉnh sửa
        $category_list = $product_category_model->select('id, name')
                                               ->where('id !=', $id) // Loại danh mục đang chỉnh sửa
                                               ->where('author', $userID)
                                               ->get()
                                               ->getResult();

        // Lấy thông tin danh mục đang chỉnh sửa
        $category_data = $product_category_model->select('id, name, parent_id, thumbnail, multiple_image, caption, caption_en, content, content_en, title, keyword, description, status')
                                               ->where('id', $id)
                                               ->where('author', $userID)
                                               ->get()
                                               ->getRow();

        if (!$category_data) {
            return redirect_with_message('error', 'Danh mục không tồn tại hoặc bạn không có quyền');
        }

        $images = explode(',', $category_data->multiple_image);

        $view_data = [
            'title'         => 'Danh mục sản phẩm',
            'category'      => $category_data,
            'category_list' => $category_list,
            'images'        => $images,
        ];
        return view('B/pages/product/category_edit', $view_data);
    }

    // Post chỉnh sửa danh mục
    public function post_edit_category()
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $product_category_id = $this->request->getVar('id');
        $validation = Services::validation();
        $product_category_model = new Product_Category_Model();

        $form_input_data['name'] = $this->request->getVar('name');
        $validation_rules['name'] = 'required|max_length[255]';

        $form_input_data['parent_id'] = $this->request->getVar('parent');
        if (!empty($form_input_data['parent_id']) && $form_input_data['parent_id'] != 0) {
            $check_exist_parent = $product_category_model->find($form_input_data['parent_id']);
            if (!$check_exist_parent) {
                return redirect_with_message_url('error', 'Danh mục cha không tồn tại', '/admin/product/category-edit2/' . $product_category_id);
            }
        } else {
            $form_input_data['parent_id'] = null;
        }

        $form_input_data['status'] = $this->request->getVar('status');
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';

        if ($this->request->getVar('title')) {
            $form_input_data['title'] = $this->request->getVar('title');
            $validation_rules['title'] = 'max_length[255]';
        }

        if ($this->request->getVar('keyword')) {
            $form_input_data['keyword'] = $this->request->getVar('keyword');
            $validation_rules['keyword'] = 'max_length[255]';
        }

        if ($this->request->getVar('description')) {
            $form_input_data['description'] = $this->request->getVar('description');
            $validation_rules['description'] = 'max_length[255]';
        }

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', '/admin/product/category-edit3/' . $product_category_id);
        }

        $form_input_data['thumbnail'] = $this->request->getVar('thumbnail');
        $form_input_data['multiple_image'] = $this->request->getVar('post_images');
        $form_input_data['caption'] = $this->request->getVar('caption');
        $form_input_data['caption_en'] = $this->request->getVar('caption_en');
        $form_input_data['content'] = $this->request->getVar('content');
        $form_input_data['content_en'] = $this->request->getVar('content_en');
        $form_input_data['alias'] = url_title(vn_to_en($form_input_data['name']), '-', true);
        $form_input_data['author'] = $userID; // Thêm author

        $update_status = $product_category_model->update_product_category($product_category_id, $form_input_data);

        if ($update_status) {
            // Xóa cache
            $this->cache->delete("product_category_index_{$userID}");
            $this->cache->delete("product_category_show_{$product_category_id}_{$userID}");
            return redirect_with_message_url('success', 'Sửa danh mục thành công!', 'admin-product-category-list');
        }
        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, '/admin/product/category-edit5/' . $product_category_id);
    }

    public function delete_category($id)
    {
        $userID = get_user_data('id');
        if (!$userID) {
            return redirect_with_message('error', 'User not authenticated');
        }

        $category_model = new Product_Category_Model();

        $delete_status = $category_model->delete_product_category($id);
        if (!$delete_status) {
            return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
        }

        // Xóa cache
        $this->cache->delete("product_category_index_{$userID}");
        $this->cache->delete("product_category_show_{$id}_{$userID}");

        return redirect_with_message_url('success', 'Xóa danh mục thành công!', 'admin-product-category-list');
    }

    /**
     * Cập nhật trạng thái sản phẩm qua Ajax
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

        // Kiểm tra sản phẩm có tồn tại và thuộc về người dùng hiện tại không
        $product_model = new Product_Model();
        $product = $product_model->where('id', $id)->where('author', $userID)->first();
        
        if (!$product) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Sản phẩm không tồn tại hoặc bạn không có quyền'
            ]);
        }

        // Cập nhật trạng thái
        $updateData = ['status' => $status];
        $updateStatus = $product_model->update_product($id, $updateData);

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
