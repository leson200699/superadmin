<?php

namespace App\Controllers\B;

use App\Models\News_Category_Model;
use App\Models\News_Language_Model;
use App\Models\News_Model;
use CodeIgniter\Controller;
use Config\Services;


class News extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper', 'vn_to_en']);
         $this->cache = Services::cache(); // Khởi tạo Redis cache
    }
    public function index()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return redirect_with_message('error', 'Bạn chưa đăng nhập');
        }
        
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 12; // Hiển thị 12 bài viết mỗi trang
        $search = $this->request->getGet('search') ?? '';
        
        $news_model = new News_Model();
        $paginated_result = $news_model->get_paginated_news_by_user($userId, $page, $perPage, $search);

        $view_data  = [
            'title'     => lang('validation.news_manage'),
            'news_list' => $paginated_result['news'],
            'pager'     => $paginated_result['pager'],
            'search'    => $search,
            'tab'       => 'tin tuc, tin tuc l',
            'user'      => get_user_data(),
        ];
        echo view("B/pages/news/news_list", $view_data);
    }

    //tao bai viet
    public function create_news()
    {


        $user = get_user_data();
        $category_model = new News_Category_Model();
        $category_data  = $category_model->get_news_category_id(get_user_data('id'));

        $view_data = [
            'title'              => 'Thêm tin mới',
            'tab'                => 'tin tức',
            'news_category_list' => $category_data
        ];
        return view('B/pages/news/news_create', $view_data);
    }

    //post tao bai viet
    public function post_create_news()
    {
        $validation = Services::validation();
        
        // Thu thập dữ liệu từ form
        $form_input_data['name']        = $this->request->getVar('name');
        $form_input_data['thumbnail']   = $this->request->getVar('thumbnail');
        $form_input_data['caption']     = $this->request->getVar('caption');
        $form_input_data['content']     = $this->request->getVar('content');
        $form_input_data['category_id'] = $this->request->getVar('category');
        $form_input_data['status']      = $this->request->getVar('status');
        $form_input_data['author']      = get_user_data('id');
        $form_input_data['created_at']  = date('Y-m-d H:i:s');

        // Tạo alias ban đầu từ tên bài viết
        $news_model = new News_Model();
        $alias = url_title(vn_to_en($form_input_data['name']), '-', true);
        $form_input_data['alias'] = $this->generateUniqueSlug($alias, $news_model);

        // Xác thực dữ liệu
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';
        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if (!$validation->run($form_input_data)) {
            // Hiển thị lỗi chi tiết để kiểm tra
            dd($validation->getErrors());
        }


        // Kiểm tra danh mục
        $news_category_model = new News_Category_Model();
        $check_exist_parent  = $news_category_model->find($form_input_data['category_id']);
        if (!$check_exist_parent) {
            return redirect_with_message_url('error', 'Danh mục không tồn tại', 'admin-news-list');
        }

        // Lưu bài viết vào bảng `news`
        $insert_status = $news_model->insert_news($form_input_data);

        if ($insert_status) {
            // Lưu nội dung ngôn ngữ bổ sung (Tiếng Anh)
            $english_title   = $this->request->getVar('name_en');
            $english_content = $this->request->getVar('content_en');

            if ($english_title && $english_content) {
                $news_translation_data = [
                    'news_id'  => $insert_status,
                    'language' => 'en', // Ngôn ngữ Tiếng Anh
                    'name'     => $english_title,
                    'content'  => $english_content,
                ];

                $news_translation_model = new News_Language_Model();
                $news_translation_model->insert($news_translation_data);
            }
            $userId = get_user_data('id');
            $this->cache->delete("news_index_{$userId}");
            $this->cache->delete("news_category_{$userId}");
            return redirect_with_message_url('success', 'Thêm tin tức thành công!', 'admin-news-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-news-list');
    }

    /**
     * Hàm tạo slug duy nhất (nếu trùng thì thêm số -1, -2,...)
     */
    private function generateUniqueSlug($slug, $newsModel)
    {
        $originalSlug = $slug;
        $counter = 1;

        while ($newsModel->where('alias', $slug)->countAllResults() > 0) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    //edit bai viet
    public function edit_news($id)
    {


        $user = get_user_data();
        $category_model = new News_Category_Model();
        $category_data  = $category_model->get_news_category_id(get_user_data('id'));


        $news_model = new News_Model();
        $edit_news = $news_model->where("id =", $id)->get()->getRow();

        if (!$edit_news) {
            return redirect_with_message('error', 'Bài viết không tồn tại!');
        }

        $view_data = [
            'title'              => 'Thêm tin mới',
            'tab'                => 'tin tức',
            'edit_news'          => $edit_news,
            'news_category_list' => $category_data
        ];
        return view('B/pages/news/news_edit', $view_data);
    }

    //post edit bai viet
    public function post_edit_news()
    {

        $news_model   = new News_Model();
        $validation   = Services::validation();
        $news_edit_id = $this->request->getVar('id');

        $form_input_data['name']  = $this->request->getVar('name');
        $validation_rules['name'] = 'required|max_length[255]';
        $check_exist_news_name    = $news_model->where('name =', $this->request->getVar('name'))->where('id != ', $news_edit_id)->get()->getRow();
        if ($check_exist_news_name) {
            return redirect_with_message('error', 'Tên bài viết đã tồn tại! ');
        }

        $form_input_data['thumbnail']  = $this->request->getVar('thumbnail');
        $form_input_data['content'] = $this->request->getVar('content');

        $form_input_data['category_id'] = $this->request->getVar('category');
        $news_category_model            = new News_Category_Model();
        $check_exist_parent             = $news_category_model->find($form_input_data['category_id']);
        if (!$check_exist_parent) {
            return redirect_with_message('error', 'Danh mục không tồn tại');
        }

        $form_input_data['status']  = $this->request->getVar('status');
        $validation_rules['status'] = 'required|is_natural|less_than_equal_to[1]';

        if ($this->request->getVar('caption')) {
            $form_input_data['caption']  = $this->request->getVar('caption');
            $validation_rules['caption'] = 'max_length[512]';
        }

        if ($this->request->getVar('title')) {
            $form_input_data['title']  = $this->request->getVar('title');
            $validation_rules['title'] = 'max_length[255]';
        }

        if ($this->request->getVar('keyword')) {
            $form_input_data['keyword']  = $this->request->getVar('keyword');
            $validation_rules['keyword'] = 'max_length[255]';
        }

        if ($this->request->getVar('description')) {
            $form_input_data['description']  = $this->request->getVar('keyword');
            $validation_rules['description'] = 'max_length[255]';
        }

        $validation->setRules($validation_rules);
        $validation->run($form_input_data);

        if ($validation->getErrors()) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', 'admin-news-list');
        }

        $form_input_data['alias']      = url_title(vn_to_en($form_input_data['name']), '-', true);
        $form_input_data['author']     = get_user_data('id');
        $form_input_data['created_at'] = date('Y-m-d H:i:s');

        $insert_status = $news_model->update_news($news_edit_id, $form_input_data);

        if ($insert_status) {
            return redirect_with_message_url('success', 'Sửa tin tức thành công!', 'admin-news-list');
        }

        return redirect_with_message_url('error', ADMIN_SYSTEM_ERROR, 'admin-news-list');
    }
    //xoa bai viet
    public function delete_news($id)
    {

        $news_model  = new News_Model();
        $delete_news = $news_model->find($id);
        if (!$delete_news) {
            return redirect_with_message('error', 'Bài viết không tồn tại!');
        }
        $delete_status = $news_model->delete_news($id);
        if ($delete_status) {
            return redirect_with_message('success', 'Xóa bài viết thành công!');

        }
        return redirect_with_message('error', ADMIN_SYSTEM_ERROR);
    }

    public function create_category()
    {
        $user = get_user_data();
        $category_model = new News_Category_Model();
        $category_data = $category_model->get_news_category_id(get_user_data('id'));

        $view_data = [
            'title'         => 'Danh mục tin tức',
            'category_list' => $category_data,
            'tab'           => 'tin tức, danh mục, tạo'
        ];
        return view('B/pages/news/category_create', $view_data);
    }

    public function category_list()
    {
        $user = get_user_data();
        $category_model = new News_Category_Model();
        $category_data = $category_model->get_news_category_id(get_user_data('id'));

        $view_data = [
            'title'         => 'Danh mục tin tức',
            'category_list' => $category_data,
            'tab'           => 'tin tức',
            'user' => $user
        ];
        return view('B/pages/news/category_list', $view_data);
    }

    //post tao danh muc
    public function post_create_category()
    {
        $validation          = Services::validation();
        $news_category_model = new News_Category_Model();
        $user_id     = get_user_data('id');

        // Thu thập dữ liệu từ request
        $form_input_data = [
            'name'        => $this->request->getVar('name'),
            'thumbnail'   => $this->request->getVar('thumbnail'),
            'parent_id'   => $this->request->getVar('parent'),
            'status'      => $this->request->getVar('status'),
            'title'       => $this->request->getVar('title'),
            'keyword'     => $this->request->getVar('keyword'),
            'description' => $this->request->getVar('description'),
            'author'      => $user_id,
        ];

        // Quy tắc validation (Không yêu cầu ảnh)
        $validation_rules = [
            'name'   => 'required|max_length[255]|is_unique[news_categories.name]',
            'status' => 'required|is_natural|less_than_equal_to[1]'
        ];

        // Áp dụng validation
        $validation->setRules($validation_rules);

        if (!$validation->run($form_input_data)) {
            return redirect_with_message_url('error', 'Sai quy tắc', 'dashboard');
        }

        // Tạo alias cho category
        $form_input_data['alias'] = url_title(vn_to_en($form_input_data['name']), '-', true);

        // Thêm dữ liệu vào database
        $insert_status = $news_category_model->insert($form_input_data);

        if ($insert_status) {
            return redirect_with_message_url('success', 'Thêm danh mục thành công!', 'dashboard');
        }

        return redirect_with_message_url('error', 'Có lỗi xảy ra trong hệ thống, vui lòng thử lại sau.', 'dashboard');
    }


    //chinh sua danh muc
    public function edit_category($id)
    {

        $user = get_user_data();

 

        $news_category_model = new News_Category_Model();
        $category_list       = $news_category_model->select('id, name')->where("parent_id != $id")->where("id != $id")->where('author = ' . get_user_data('id'))->get()->getResult();
        $category_data       =  $news_category_model->select('id, name, parent_id, title, keyword, description, status')->where("id = $id")->get()->getRow();
        $view_data           = [
            'title'         => 'Danh mục tin tức',
            'category_data' => $category_data,
            'category_list' => $category_list,
            'tab'           => 'tin tức, danh mục, tạo'
        ];
        return view('B/pages/news/category_edit', $view_data);
    }

    public function post_edit_category()
    {
        $news_category_id    = $this->request->getVar('id');
        $validation          = Services::validation();
        $news_category_model = new News_Category_Model();

        $form_input_data = [
            'name'        => $this->request->getVar('name'),
            'parent_id'   => $this->request->getVar('parent'),
            'status'      => $this->request->getVar('status'),
            'title'       => $this->request->getVar('title'),
            'keyword'     => $this->request->getVar('keyword'),
            'description' => $this->request->getVar('description')
        ];

        // Quy tắc validation (Không yêu cầu ảnh)
        $validation_rules = [
            'name'   => 'required|max_length[255]',
            'status' => 'required|is_natural|less_than_equal_to[1]'
        ];

        $validation->setRules($validation_rules);

        if (!$validation->run($form_input_data)) {
            return redirect_with_message_url('error', 'Thông tin nhập không hợp lệ!', 'admin-news-category-list');
        }

        // Kiểm tra nếu có hình ảnh mới thì cập nhật
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/categories/', $imageName);
            $form_input_data['thumbnail'] = '/uploads/categories/' . $imageName;
        }

        // Cập nhật alias nếu tên thay đổi
        $form_input_data['alias'] = url_title(vn_to_en($form_input_data['name']), '-', true);

        $update_status = $news_category_model->update_news_category($news_category_id, $form_input_data);

        if ($update_status) {
            return redirect_with_message_url('success', 'Cập nhật danh mục thành công!', 'admin-news-category-list');
        }

        return redirect_with_message_url('error', 'Có lỗi xảy ra trong hệ thống!', 'admin-news-category-list');
    }


    public function convert_to_url()
    {
        $request = \Config\Services::request();
        $text = $request->getPost('text');

        if ($text) {
            $convertedText = url_title(vn_to_en($text), '-', true);
            return $this->response
                ->setContentType('text/plain')
                ->setBody($convertedText);
        } else {
            return $this->response
                ->setContentType('text/plain')
                ->setBody('');
        }
    }



    public function update_status()
    {
        // Lấy dữ liệu từ yêu cầu POST
        $id     = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        // Kiểm tra xem yêu cầu có phải là AJAX không
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Invalid request.'
            ]);
        }

        // Tạo đối tượng model
        $news_model = new News_Model();

        // Cập nhật trạng thái
        $updateData   = ['status' => $status]; // Dữ liệu để cập nhật
        $updateStatus = $news_model->update_news($id, $updateData); // Gọi phương thức cập nhật

        // Kiểm tra xem việc cập nhật có thành công không
        if ($updateStatus) {
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Status updated successfully!'
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update status.'
        ]);
    }



    public function delete_category($id)
    {
        $news_category_model = new News_Category_Model();
        $category = $news_category_model->find($id);

        if (!$category) {
            return redirect_with_message_url('error', 'Danh mục không tồn tại!', 'admin-news-category-list');
        }

        // Kiểm tra xem danh mục có bài viết hoặc danh mục con không
        $news_model = new News_Model();
        $child_categories = $news_category_model->where('parent_id', $id)->countAllResults();
        $news_count = $news_model->where('category_id', $id)->countAllResults();

        if ($child_categories > 0 || $news_count > 0) {
            return redirect_with_message_url('error', 'Không thể xóa danh mục vì có bài viết hoặc danh mục con liên quan!', 'admin-news-category-list');
        }

        // Xóa danh mục
        $delete_status = $news_category_model->delete($id);
        if ($delete_status) {
            $userId = get_user_data('id');
            $this->cache->delete("news_category_{$userId}");
            return redirect_with_message_url('success', 'Xóa danh mục thành công!', 'admin-news-category-list');
        }

        return redirect_with_message_url('error', 'Không thể xóa danh mục!', 'admin-news-category-list');
    }

    

}
