<?php 


$routes->group('admin', function ($routes) {
    // Login routes should be outside the admin-access filter
    $routes->group('auth', ['filter' => 'admin-login'], function ($routes) {
        $routes->get('login', 'B\Auth\Login::index', ['as' => 'admin-auth-login']);
        $routes->post('login', 'B\Auth\Login::login', ['as' => 'admin-post-login']);
        $routes->get('google-callback', 'B\Auth\Login::googleCallback', ['as' => 'google-callback']);
    });
    
    // Logout route (doesn't need filter since anyone can logout)
    $routes->get('logout', 'B\Auth\Login::logout', ['as' => 'admin-logout']);
    
    // All other admin routes should use admin-access filter
    $routes->get('/', 'B\Dashboard::index', ['as' => 'admin', 'filter' => 'admin-access']);
    // Dashboard
    $routes->get('dashboard', 'B\Dashboard::index', ['as' => 'dashboard', 'filter' => 'admin-access']);
    $routes->post('dashboard/sendMessage', 'B\Dashboard::sendMessage', ['as' => 'dashboard-send', 'filter' => 'admin-access']);
    // Khách hàng liên hệ
    $routes->get('message', 'B\Customer_Message::index', ['as' => 'admin-customer-message', 'filter' => 'admin-access']);
    // Auth login group
    // $routes->group('auth', ['filter' => 'admin-login'], function ($routes) {
    //     $routes->get('login', 'B\Auth\Login::index', ['as' => 'admin-auth-login']);
    //     $routes->post('login', 'B\Auth\Login::login', ['as' => 'admin-post-login']);
    //     $routes->get('google-callback', 'B\Auth\Login::googleCallback', ['as' => 'google-callback']);
    // });
    
    // Logout route (không cần filter vì ai cũng có thể logout)
    // $routes->get('logout', 'B\Auth\Login::logout', ['as' => 'admin-logout']);

    $routes->get('permissions', 'B\AdminPermissionController::list_permissions', ['as' => 'admin-permissions-list', 'filter' => 'admin-access']);
    $routes->get('permissions/create', 'B\AdminPermissionController::create_permission', ['as' => 'admin-permissions-create', 'filter' => 'admin-access']);
    $routes->post('permissions/create', 'B\AdminPermissionController::post_create_permission', ['as' => 'admin-permissions-store', 'filter' => 'admin-access']);

    $routes->get('permissions/assign', 'B\AdminPermissionController::assign_permissions', ['as' => 'admin-assign-permissions', 'filter' => 'admin-access']);



    $routes->post('assign-role-permissions', 'B\AdminPermissionController::assign_role_permissions', ['as' => 'admin-assign-role-permissions', 'filter' => 'admin-access']);
    $routes->post('assign-user-permissions', 'B\AdminPermissionController::assign_user_permissions', ['as' => 'admin-assign-user-permissions', 'filter' => 'admin-access']);


    $routes->get('view-role-permissions/(:num)', 'B\AdminPermissionController::view_role_permissions/$1', ['as' => 'admin-view-role-permissions', 'filter' => 'admin-access']);
    $routes->get('view-user-permissions/(:num)', 'B\AdminPermissionController::view_user_permissions/$1', ['as' => 'admin-view-user-permissions', 'filter' => 'admin-access']);



    $routes->get('backup/export/(:segment)', 'B\BackupUser::export/$1');
    $routes->get('backup', 'B\BackupUser::index');
    $routes->post('backup/export', 'B\BackupUser::export');
    $routes->get('backup/delete/(:segment)', 'B\BackupUser::delete/$1');
    $routes->get('backup/restore/(:segment)', 'B\BackupUser::restore/$1');


    // Css Editor
    $routes->get('css-editor/edit', 'B\CssEditor::edit', ['as' => 'css-editor']);
    $routes->post('css-editor/save', 'B\CssEditor::save');
    $routes->post('css-editor/restore', 'B\CssEditor::restoreBackup');



    $routes->get('ClearCache/(:num)', 'B\ClearCache::user/$1');

    // Logout (Old - commented out due to IDP integration)
    // $routes->get('logout', 'B\Auth\Login::logout', ['as' => 'admin-logout']);

    // User group
    $routes->group('user', ['filter' => 'admin-access'], function ($routes) {
        $routes->get('/', 'B\User::index', ['as' => 'admin-user']);
        $routes->post('admin-profile-update', 'B\User::update_profile', ['as' => 'admin-profile-update']);
        $routes->post('admin-password-update', 'B\User::update_password', ['as' => 'admin-password-update']);

        // Users list
        $routes->get('users-list', 'B\User::users_list', ['as' => 'admin-users-list']);

        // Delete user
        $routes->get('delete/id/(:num)', 'User::delete_user/$1', ['as' => 'admin-delete-user', 'namespace' => BACKEND_NAMESPACE]);

        // Add new user
        $routes->get('add-users', 'B\User::add_user', ['as' => 'admin-users-add-user']);
        $routes->post('add-users', 'B\User::post_add_user', ['as' => 'admin-user-post-add-user']);

        // Edit user
        $routes->get('edit/id/(:num)', 'User::edit_user/$1', ['as' => 'admin-user-edit-user', 'namespace' => BACKEND_NAMESPACE]);
        $routes->post('edit-user', 'User::post_edit_user', ['as' => 'admin-user-edit-post', 'namespace' => BACKEND_NAMESPACE]);

        // Group management
        $routes->group('group', ['filter' => 'admin-access'], function ($routes) {
            $routes->get('/', 'B\Group::index', ['as' => 'admin-group-list']);

            // Delete group
            $routes->get('delete/id/(:num)', 'Group::delete_group/$1', ['as' => 'admin-group-delete', 'namespace' => BACKEND_NAMESPACE]);

            // Edit group
            $routes->get('edit/id/(:num)', 'Group::edit_group/$1', ['as' => 'admin-group-edit', 'namespace' => BACKEND_NAMESPACE]);
            $routes->post('edit-group', 'Group::post_edit_group', ['as' => 'admin-group-edit-post', 'namespace' => BACKEND_NAMESPACE]);
        });

        // Create new group
        $routes->get('group-create', 'B\Group::create_group', ['as' => 'admin-group-create']);
        $routes->post('group-create', 'B\Group::post_create_group', ['as' => 'admin-group-create-post']);

    });

    $routes->group('menu', ['filter' => 'admin-access'], function ($routes) {
        $routes->get('/', 'B\Menu::index', ['as' => 'admin-menu-list']);
        $routes->get('create', 'B\Menu::create', ['as' => 'admin-menu-create']);
        $routes->get('menu-list', 'B\Menu::index', ['as' => 'admin-menu-list']);
        $routes->post('save', 'B\Menu::saveMenu');
        $routes->get('submenus/(:num)', 'B\Menu::getSubMenus/$1');
        $routes->get('delete/(:num)', 'B\Menu::delete/$1');
        $routes->get('edit/(:num)', 'B\Menu::edit/$1');
        $routes->post('update', 'B\Menu::updateMenu');
    });



    //tin tuc
    $routes->group('news', ['filter' => 'admin-access'], function ($routes) {
        $routes->get('news-list', 'B\News::index', ['as' => 'admin-news-list']);
        $routes->post('convert', 'B\News::convert_to_url', ['as' => 'convert_to_url']);
        $routes->post('status', 'B\News::update_status', ['as' => 'update_status']);
        //xoa tin
        $routes->get('delete/id/(:num)', 'News::delete_news/$1', ['as' => 'admin-news-delete', 'namespace' =>  BACKEND_NAMESPACE]);
        $routes->post('delete/id/(:num)', 'News::delete_news/$1', ['as' => 'admin-news-delete', 'namespace' =>  BACKEND_NAMESPACE]);
        //them tin moi
        $routes->get('news-create', 'B\News::create_news', ['as' => 'admin-news-create']);
        $routes->post('news-create', 'B\News::post_create_news', ['as' => 'admin-news-create-post']);
        //edit tin tuc
        $routes->get('edit/id/(:num)', 'News::edit_news/$1', ['as' => 'admin-news-edit', 'namespace' =>  BACKEND_NAMESPACE]);
        $routes->post('edit-news', 'News::post_edit_news', ['as' => 'admin-news-edit-post', 'namespace' =>  BACKEND_NAMESPACE]);

        $routes->get('news-category', 'B\News::category_list', ['as' => 'admin-news-category-list']);
        //xoa danh muc
        $routes->post('delete-category/(:num)', 'B\News::delete_category/$1', ['as' => 'admin-news-category-delete']);
        //them danh muc moi
        $routes->get('category-create', 'B\News::create_category', ['as' => 'admin-news-category-create']);
        $routes->post('category-create', 'B\News::post_create_category', ['as' => 'admin-news-category-post']);
        //edit tin tuc
        $routes->get('category/edit/id/(:num)', 'News::edit_category/$1', ['as' => 'admin-news-category-edit', 'namespace' => BACKEND_NAMESPACE]);
        $routes->post('edit', 'News::post_edit_category', ['as' => 'admin-news-category-edit-post', 'namespace' => BACKEND_NAMESPACE]);

    });

    //cau hinh thong tin website
    $routes->group('config', ['filter' => 'admin-access'], function ($routes) {
        //gioi thieu
        $routes->get('admin-intro', 'B\Config::introduction', ['as' => 'admin-intro']);
        $routes->post('admin-intro/(:num)', 'B\Config::post_introduction/$1', ['as' => 'admin-intro-post']);
        //cau hinh website, email, hotline, dia chi, ten mien
        $routes->get('contact-config', 'B\Config::contact', ['as' => 'admin-config-contact']);
        $routes->post('contact-config', 'B\Config::post_update_contact', ['as' => 'admin-config-contact-update']);

        //cau hinh google map
        $routes->get('google-config', 'B\Config::google_map', ['as' => 'admin-config-google-map']);
        $routes->post('google-config', 'B\Config::post_update_google_map', ['as' => 'admin-config-google-map']);


    });

    //slideshow
    $routes->group('plugins', ['filter' => 'admin-access'], function ($routes) {
        //danh sach slideshow
        $routes->get('slideshow-list', 'B\Slideshow::get_slideshow_list', ['as' => 'admin-slideshow-list']);
        //chinh sua slideshow
        $routes->get('slideshow-edit/id/(:num)', 'Slideshow::edit_slideshow/$1', ['as' => 'admin-slideshow-edit', 'namespace' => BACKEND_NAMESPACE]);
        $routes->post('slideshow-edit', 'B\Slideshow::post_edit_slideshow', ['as' => 'admin-slideshow-edit-post']);

        //them moi slideshow
        $routes->get('slideshow-create', 'B\Slideshow::create_slideshow', ['as' => 'admin-slideshow-create']);
        $routes->post('slideshow-create', 'B\Slideshow::post_create_slideshow', ['as' => 'admin-slideshow-create-post']);

        //xoa slideshow
        $routes->post('slideshow-delete/id/(:num)', 'Slideshow::delete_slideshow/$1', ['as' => 'admin-slideshow-delete', 'namespace' =>  BACKEND_NAMESPACE]);
    });

    //san phan
    $routes->group('product', ['filter' => 'admin-access'], function ($routes) {
        //danh sach san pham
        $routes->get('product-list', 'B\Product::index', ['as' => 'admin-product-list']);

        //them moi san pham
        $routes->get('product-create', 'B\Product::create_product', ['as' => 'admin-product-create']);
        $routes->post('product-create', 'B\Product::post_create_product', ['as' => 'admin-product-create-post']);

        //chinh sua san pham
        $routes->get('product-edit/id/(:num)', 'Product::edit_product/$1', ['as' => 'admin-product-edit', 'namespace' => BACKEND_NAMESPACE]);
        $routes->post('product-edit', 'B\Product::post_edit_product', ['as' => 'admin-product-edit-post']);

        //xoa san pham
        $routes->post('delete/id/(:num)', 'Product::delete_Product/$1', ['as' => 'admin-product-delete', 'namespace' =>  BACKEND_NAMESPACE]);

        //cap nhat trang thai
        $routes->post('status', 'B\Product::update_status', ['as' => 'product_update_status']);


        $routes->get('product-category', 'B\Product::category_list', ['as' => 'admin-product-category-list']);
        //xoa danh muc
        $routes->post('category-delete/(:num)', 'Product::delete_category/$1', ['as' => 'admin-product-category-delete', 'namespace' => BACKEND_NAMESPACE]);
        //them danh muc moi
        $routes->get('product-category-create', 'B\Product::create_category', ['as' => 'admin-product-category-create']);
        $routes->post('category-create', 'B\Product::post_create_category', ['as' => 'admin-product-category-post']);
        //edit tin tuc
        $routes->get('product-category-edit/(:num)', 'Product::edit_category/$1', ['as' => 'admin-product-category-edit', 'namespace' => BACKEND_NAMESPACE]);
        $routes->post('edit', 'Product::post_edit_category', ['as' => 'admin-product-category-edit-post', 'namespace' => BACKEND_NAMESPACE]);

    });

    $routes->group('filemanager', function ($routes) {
        $routes->get('/', 'B\Filemanager::index', ['as' => 'filemanager', 'filter' => 'admin-access']);
        $routes->post('upload', 'B\Filemanager::upload', ['filter' => 'admin-access']);
        $routes->post('upload_pop', 'B\Filemanager::upload_pop', ['filter' => 'admin-access']);
        $routes->post('createFolderfull', 'B\Filemanager::createFolderfull', ['filter' => 'admin-access']);
        $routes->get('deleteFolder/(:segment)', 'B\Filemanager::deleteFolder/$1', ['filter' => 'admin-access']);
        $routes->post('delete', 'B\Filemanager::delete');
        $routes->get('delete', 'B\Filemanager::delete');
        $routes->post('deleteMultiple', 'B\Filemanager::deleteMultiple');
        $routes->get('download/(:segment)', 'B\Filemanager::download/$1', ['filter' => 'admin-access']);
        $routes->post('renameFile', 'B\Filemanager::renameFile', ['filter' => 'admin-access']);
        $routes->get('listFiles', 'B\Filemanager::listFiles', ['filter' => 'admin-access']);
        $routes->post('deleteFile', 'B\Filemanager::deleteFile', ['filter' => 'admin-access']);
        $routes->post('createFolder', 'B\Filemanager::createFolder', ['filter' => 'admin-access']);
    });

    $routes->group('pop_file', function ($routes) {
        $routes->get('/', 'B\Filemanager::pop', ['as' => 'pop_file', 'filter' => 'admin-access']);
        $routes->post('upload', 'B\Filemanager::upload', ['filter' => 'admin-access']);
        $routes->post('createFolder', 'B\Filemanager::createFolder', ['filter' => 'admin-access']);
        $routes->get('deleteFolder/(:segment)', 'B\Filemanager::deleteFolder/$1', ['filter' => 'admin-access']);
        $routes->get('delete/(:segment)', 'B\Filemanager::delete/$1', ['filter' => 'admin-access']);
        $routes->get('download/(:segment)', 'B\Filemanager::download/$1', ['filter' => 'admin-access']);
        $routes->post('renameFile', 'B\Filemanager::renameFile', ['filter' => 'admin-access']);
    });


    $routes->group('editor_file', function ($routes) {
        $routes->get('/', 'B\Filemanager::editor', ['as' => 'editor_file', 'filter' => 'admin-access']);
    });

    $routes->group('team', function ($routes) {
        $routes->get('/', 'B\Team::index', ['as' => 'team-list', 'filter' => 'admin-access']);
        $routes->get('create', 'B\Team::create', ['as' => 'team-create', 'filter' => 'admin-access']);
        $routes->post('store', 'B\Team::store', ['as' => 'team-store', 'filter' => 'admin-access']);
        $routes->get('edit/(:segment)', 'B\Team::edit/$1', ['as' => 'team-edit', 'filter' => 'admin-access']);
        $routes->post('update/(:segment)', 'B\Team::update/$1', ['as' => 'team-edit', 'filter' => 'admin-access']);
        $routes->post('delete/(:segment)', 'B\Team::delete/$1', ['as' => 'team-delete', 'filter' => 'admin-access']);

    });

    $routes->group('testimonial', function ($routes) {
        $routes->get('/', 'B\Testimonial::index', ['as' => 'testimonial-list', 'filter' => 'admin-access']);
        $routes->get('create', 'B\Testimonial::create', ['as' => 'testimonial-create', 'filter' => 'admin-access']);
        $routes->post('store', 'B\Testimonial::store', ['as' => 'testimonial-store', 'filter' => 'admin-access']);
        $routes->get('edit/(:segment)', 'B\Testimonial::edit/$1', ['as' => 'testimonial-edit', 'filter' => 'admin-access']);
        $routes->post('update/(:segment)', 'B\Testimonial::update/$1', ['as' => 'testimonial-update', 'filter' => 'admin-access']);
        $routes->get('delete/(:segment)', 'B\Testimonial::delete/$1', ['as' => 'testimonial-delete', 'filter' => 'admin-access']);
    });

    $routes->get('get-recent-logs', 'B\Dashboard::ajaxGetRecentLogs');
    $routes->get('district/getByProvince/(:num)', 'District_Controller::getByProvince/$1');

    $routes->group('project', function ($routes) {
        $routes->get('/', 'B\Project_Controller::index', ['as' => 'project-list', 'filter' => 'admin-access']);
        $routes->get('create', 'B\Project_Controller::create', ['as' => 'project-create', 'filter' => 'admin-access']);
        $routes->post('store', 'B\Project_Controller::store', ['as' => 'project-store', 'filter' => 'admin-access']);
        $routes->get('edit/(:segment)', 'B\Project_Controller::edit/$1', ['as' => 'admin-project-edit', 'filter' => 'admin-access']);
        $routes->post('update/(:segment)', 'B\Project_Controller::update/$1', ['as' => 'admin-project-update', 'filter' => 'admin-access']);
        $routes->get('delete/(:segment)', 'B\Project_Controller::delete/$1', ['as' => 'admin-project-delete', 'filter' => 'admin-access']);
        $routes->get('getDistrictsByProvince/(:num)', 'B\Project_Controller::getByProvince/$1', ['as' => 'project-getDistricts', 'filter' => 'admin-access']);

        $routes->get('getWardsByDistrict/(:num)', 'B\Project_Controller::getByDistrict/$1', ['as' => 'project-getWards', 'filter' => 'admin-access']);

    });
    $routes->group('ward', function ($routes) {
        $routes->get('/', 'B\Ward::index', ['as' => 'ward-list', 'filter' => 'admin-access']);
        $routes->get('create', 'B\Ward::create', ['as' => 'ward-create', 'filter' => 'admin-access']);
        $routes->post('store', 'B\Ward::store', ['as' => 'ward-store', 'filter' => 'admin-access']);
        $routes->get('edit/(:segment)', 'B\Ward::edit/$1', ['as' => 'ward-edit', 'filter' => 'admin-access']);
        $routes->post('update/(:segment)', 'B\Ward::update/$1', ['as' => 'ward-update', 'filter' => 'admin-access']);
        $routes->get('delete/(:segment)', 'B\Ward::delete/$1', ['as' => 'ward-delete', 'filter' => 'admin-access']);
    });
    $routes->group('services', ['namespace' => 'App\Controllers\B', 'filter' => 'admin-access'], function ($routes) {
        $routes->get('', 'ServiceController::index', ['as' => 'admin-service-list']);
        $routes->get('create', 'ServiceController::create', ['as' => 'admin-service-create']);
        $routes->post('store', 'ServiceController::store', ['as' => 'admin-service-create-post']);
        $routes->get('edit/(:num)', 'ServiceController::edit/$1');
        $routes->post('update/(:num)', 'ServiceController::update/$1', ['as' => 'admin-service-update-post']);
        $routes->get('delete/(:num)', 'ServiceController::delete/$1');

        $routes->get('category', 'ServiceCategoryController::index', ['as' => 'admin-service-category-list']);
        $routes->get('category/create', 'ServiceCategoryController::create', ['as' => 'admin-service-category-create']);
        $routes->post('category/store', 'ServiceCategoryController::store');
        $routes->get('category/edit/(:num)', 'ServiceCategoryController::edit/$1');
        $routes->post('category/update/(:num)', 'ServiceCategoryController::update/$1');
        $routes->get('category/delete/(:num)', 'ServiceCategoryController::delete/$1');


    });
    $routes->group('custom', ['namespace' => 'App\Controllers\B', 'filter' => 'admin-access'], function ($routes) {
        $routes->get('', 'LandingController::index', ['as' => 'admin-custom-list']);
        $routes->get('create', 'LandingController::create', ['as' => 'admin-custom-create']);
        $routes->post('store', 'LandingController::store', ['as' => 'admin-custom-store']);
        $routes->get('(:num)', 'LandingController::show/$1');
        $routes->get('edit/(:num)', 'LandingController::edit/$1');
        $routes->post('update/(:num)', 'LandingController::update/$1', ['as' => 'admin-custom-update']);
        $routes->get('delete/(:num)', 'LandingController::delete/$1');
    });
    // Routes cho Backend (Admin Panel)
    $routes->group('abouts', ['namespace' => 'App\Controllers\B', 'filter' => 'admin-access'], function ($routes) {
        $routes->get('', 'AboutController::index', ['as' => 'admin-about-us']);      // Hiển thị danh sách trang About
        $routes->get('create', 'AboutController::create');    // Form thêm mới trang About
        $routes->post('store', 'AboutController::store');     // Xử lý lưu trang About mới
        $routes->get('edit/(:num)', 'AboutController::edit/$1'); // Form chỉnh sửa trang About
        $routes->post('update/(:num)', 'AboutController::update/$1'); // Xử lý cập nhật trang About
        $routes->get('delete/(:num)', 'AboutController::delete/$1'); // Xóa trang About
    });



    // Backend Routes
    $routes->group('partners', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'PartnerController::index', ['as' => 'admin-partners-list']);
        $routes->get('create', 'PartnerController::create');
        $routes->post('store', 'PartnerController::store');
        $routes->get('edit/(:num)', 'PartnerController::edit/$1');
        $routes->post('update/(:num)', 'PartnerController::update/$1');
        $routes->post('delete/(:num)', 'PartnerController::delete/$1');
    });
    $routes->get('language/(:segment)', 'B\Language::change_b/$1');


    $routes->group('section', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'Section::index', ['as' => 'admin-section']);      // Hiển thị danh sách trang
        $routes->get('create', 'Section::create', ['as' => 'admin-section-create']);    // Form thêm mới trang
        $routes->post('store', 'Section::store', ['as' => 'admin-section-store']);     // Xử lý lưu trang mới
        $routes->get('edit/(:num)', 'Section::edit/$1', ['as' => 'admin-section-edit']); // Form chỉnh sửa trang
        $routes->post('update/(:num)', 'Section::update/$1', ['as' => 'admin-section-update']); // Xử lý cập nhật
        $routes->post('delete/(:num)', 'Section::delete/$1', ['as' => 'admin-section-delete']); // Xóa trang
        $routes->post('status', 'Section::update_status', ['as' => 'section_update_status']); // Cập nhật trạng thái
        // Routes cho section liên kết với entity
        $routes->get('entity/(:segment)/(:num)', 'Section::entity_sections/$1/$2');
    });



    $routes->group('tours', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'TourController::index', );
        $routes->get('create', 'TourController::create');
        $routes->post('store', 'TourController::store');
        $routes->get('edit/(:num)', 'TourController::edit/$1');
        $routes->post('update/(:num)', 'TourController::update/$1');
        $routes->get('view/(:num)', 'TourController::view/$1');
    });


    $routes->group('tourcategories', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'TourCategoryController::index', );
        $routes->get('create', 'TourCategoryController::create');
        $routes->post('store', 'TourCategoryController::store');
        $routes->get('edit/(:num)', 'TourCategoryController::edit/$1');
        $routes->post('update/(:num)', 'TourCategoryController::update/$1');
        $routes->get('edit/(:num)', 'TourCategoryController::edit/$1');
        $routes->get('delete/(:num)', 'TourCategoryController::delete/$1');

    });


    $routes->group('bookings', ['namespace' => 'App\Controllers\B', 'filter' => 'admin-access'], function ($routes) {
        $routes->get('/', 'BookingController::index');
        $routes->get('view/(:num)', 'BookingController::view/$1');
        $routes->post('book/(:num)', 'BookingController::book/$1');

    });


    $routes->group('courses', ['namespace' => 'App\Controllers\B', 'filter' => 'admin-access'], function ($routes) {

        $routes->get('list', 'CourseAdmin::index', ['as' => 'admin-courses-list']);
        $routes->get('create', 'CourseAdmin::create', ['as' => 'admin-courses-create']);
        $routes->get('delete/(:num)', 'CourseAdmin::delete/$1', ['as' => 'admin-courses-delete']);
        $routes->post('store', 'CourseAdmin::store');
        $routes->get('show/(:num)', 'CourseAdmin::show/$1', ['as' => 'admin-courses-show']);
        $routes->get('edit/(:num)', 'CourseAdmin::edit/$1', ['as' => 'admin-courses-edit']);
        $routes->post('update/(:num)', 'CourseAdmin::update/$1', ['as' => 'admin-courses-update']);

        $routes->post('store', 'CourseAdmin::store');

        $routes->get('create-lesson/(:num)', 'CourseAdmin::createLesson/$1', ['as' => 'admin-courses-create-lesson']);
        $routes->post('store-lesson/(:num)', 'CourseAdmin::storeLesson/$1');

        $routes->get('delete-lesson/(:num)/(:num)', 'CourseAdmin::deleteLesson/$1/$2');

        $routes->get('edit-lesson/(:num)/(:num)', 'CourseAdmin::editLesson/$1/$2');
        $routes->post('update-lesson/(:num)/(:num)', 'CourseAdmin::updateLesson/$1/$2');




        $routes->get('instructors/instructors-list', 'InstructorController::index', ['as' => 'admin-instructors-list']);
        $routes->get('instructors/instructors-create', 'InstructorController::create', ['as' => 'admin-instructors-create']);
        $routes->post('instructors/store', 'InstructorController::store');
        $routes->get('instructors/show/(:num)', 'InstructorController::show/$1', ['as' => 'admin-instructors-show']);



        $routes->get('instructors/edit/(:num)', 'InstructorController::edit/$1', ['as' => 'admin-instructors-edit']);
        $routes->post('instructors/update/(:num)', 'InstructorController::update/$1', ['as' => 'admin-instructors-update']);

    });


    $routes->group('video', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'VideoAdmin::index', ['as' => 'admin-video']);
        $routes->post('store', 'VideoAdmin::store');
        $routes->match(['GET', 'POST'], 'create', 'VideoAdmin::create');
        $routes->match(['GET', 'POST'], 'update/(:num)', 'VideoAdmin::update/$1');
        $routes->get('delete/(:num)', 'VideoAdmin::delete/$1');
    });

    $routes->group('car', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'Car::index', ['as' => 'admin-car-list']);
        $routes->get('create', 'Car::create', ['as' => 'admin-car-create']);
        $routes->post('store', 'Car::store', ['as' => 'admin-car-create-post']);
        $routes->get('edit/(:num)', 'Car::edit/$1');
        $routes->post('update/(:num)', 'Car::update/$1');
        $routes->get('delete/(:num)', 'Car::delete/$1');
        $routes->post('status', 'Car::update_status', ['as' => 'car_update_status']);

        $routes->get('car-category', 'CarCategories::index');
        $routes->get('car-category/create', 'CarCategories::create');
        $routes->post('car-category/store', 'CarCategories::store');
        $routes->get('car-category/edit/(:num)', 'CarCategories::edit/$1');
        $routes->post('car-category/update/(:num)', 'CarCategories::update/$1');
        $routes->get('car-category/delete/(:num)', 'CarCategories::delete/$1');
    });
    
    // Quản lý đơn đặt lịch xe
    $routes->group('car-booking', ['namespace' => 'App\Controllers\B'], function ($routes) {
        $routes->get('/', 'CarBooking::index', ['as' => 'admin-car-booking-list']);
        $routes->get('view/(:num)', 'CarBooking::view/$1', ['as' => 'admin-car-booking-view']);
        $routes->get('delete/(:num)', 'CarBooking::delete/$1', ['as' => 'admin-car-booking-delete']);
        $routes->post('update-status', 'CarBooking::update_status', ['as' => 'admin-car-booking-status']);
    });


    // Auth0 routes (không cần filter vì cần truy cập trước khi đăng nhập)
    $routes->get('auth0/login', 'B\Auth::login', ['as' => 'admin-auth0-login']);
    $routes->get('auth0/callback', 'B\Auth::callback', ['as' => 'admin-auth0-callback']);
    $routes->get('auth0/logout', 'B\Auth::logout', ['as' => 'admin-auth0-logout']);
    
    // Test route để kiểm tra
    $routes->get('test-auth', function() { return 'Auth test OK'; }, ['as' => 'admin-test-auth']);



});





