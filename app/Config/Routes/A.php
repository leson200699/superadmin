<?php

$routes->group('api', function ($routes) {
    // Sản phẩm (Product API)
    $routes->get('products', 'A\Product::index', ['filter' => 'apiauth']); // Lấy danh sách sản phẩm
    $routes->get('products/search', 'A\Product::search', ['filter' => 'apiauth']); // Tìm kiếm sản phẩm
    $routes->get('products/detail/(:segment)', 'A\Product::detailByAlias/$1'); // Chi tiết sản phẩm theo alias
    $routes->get('products/category/(:segment)', 'A\Product::productsByCategoryAlias/$1'); // Sản phẩm theo danh mục
    $routes->get('product-category', 'A\Product::category', ['filter' => 'apiauth']); // Lấy danh mục sản phẩm


    // Tin tức (News API)
    $routes->get('news', 'A\News::index', ['filter' => 'apiauth']);
    $routes->get('news/category/(:any)', 'A\News::newsByCategory/$1', ['filter' => 'apiauth']); // Đặt trước
    $routes->get('news/(:any)', 'A\News::news/$1', ['filter' => 'apiauth']);
    $routes->get('news/search', 'A\News::search', ['filter' => 'apiauth']);
    $routes->get('news/related/(:any)', 'A\News::relatedNews/$1', ['filter' => 'apiauth']);
    $routes->get('news-category', 'A\News::category', ['filter' => 'apiauth']);

    // Hình ảnh
    $routes->get('image/(:num)x(:num)', 'A\Image::index/$1/$2');

    // Cấu hình hệ thống
    $routes->get('config', 'A\Config::index', ['filter' => 'apiauth']);

    // Dịch vụ
    $routes->get('service', 'A\Service::index', ['filter' => 'apiauth']);
    $routes->get('service/category/(:num)', 'A\Service::byCategory/$1', ['filter' => 'apiauth']);
    $routes->get('service/category/alias/(:segment)', 'A\Service::byCategoryAlias/$1', ['filter' => 'apiauth']);
    $routes->get('service/show/(:any)', 'A\Service::show/$1', ['filter' => 'apiauth']);
    $routes->get('service/categories', 'A\Service::categories', ['filter' => 'apiauth']);
    $routes->get('service/(:any)', 'A\Service::show/$1', ['filter' => 'apiauth']);



    // Slider
    $routes->get('slider', 'A\Slider::index', ['filter' => 'apiauth']);

    // Dự án
    $routes->get('project', 'A\Project::index2', ['filter' => 'apiauth']);
    $routes->get('project/(:num)', 'A\Project::detail/$1', ['filter' => 'apiauth']);
    $routes->get('project/alias/(:segment)', 'A\Project::detailByAlias/$1');

    // Tỉnh, Huyện, Xã
    $routes->get('provinces', 'A\Provinces::provinces', ['filter' => 'apiauth']);
    $routes->get('districts', 'A\Provinces::districts', ['filter' => 'apiauth']);
    $routes->get('wards', 'A\Provinces::wards', ['filter' => 'apiauth']);

    // Menu
    $routes->get('menu', 'A\Menu::index', ['filter' => 'apiauth']);

    // Validation
    $routes->get('validation', 'A\Validation::index', ['filter' => 'apiauth']);

    // Landing page
    $routes->get('landing', 'A\Landing::index', ['filter' => 'apiauth']);
    $routes->get('landing/(:num)', 'A\Landing::detail/$1', ['filter' => 'apiauth']);

    // Giới thiệu (About)
    $routes->get('about', 'A\About::index', ['filter' => 'apiauth']);
    $routes->get('about/(:num)', 'A\About::show/$1', ['filter' => 'apiauth']);

    // Đối tác (Partner)
    $routes->get('partner', 'A\Partner::index', ['filter' => 'apiauth']);

    // Danh mục sản phẩm
    $routes->get('product-category', 'A\ProductCategory::index', ['filter' => 'apiauth']);
    $routes->get('product-category/(:num)', 'A\ProductCategory::show/$1', ['filter' => 'apiauth']);



    $routes->get('tours', 'A\TourApi::index', ['filter' => 'apiauth']);
    $routes->get('tours/(:num)', 'A\TourApi::show/$1', ['filter' => 'apiauth']);
    $routes->get('tourcategories', 'A\TourApi::category', ['filter' => 'apiauth']);

    $routes->get('tours/category/(:num)', 'A\TourApi::toursByCategory/$1', ['filter' => 'apiauth']);
    $routes->get('tours/search', 'A\TourApi::search', ['filter' => 'apiauth']);
    $routes->get('tours/advanced-search', 'A\TourApi::advancedSearch');
    $routes->post('tours/book', 'A\TourApi::bookTour');


    $routes->get('testimonials', 'A\Testimonial::index', ['filter' => 'apiauth']);
    $routes->get('testimonials/(:num)', 'A\Testimonial::detail/$1', ['filter' => 'apiauth']);



    $routes->post('visa/create', 'A\VisaController::createOrder', ['filter' => 'apiauth']);
    $routes->post('visa/update-detail/(:num)', 'A\VisaController::updateOrderDetail/$1', ['filter' => 'apiauth']);
    $routes->get('visa/order/(:num)', 'A\VisaController::getOrder/$1', ['filter' => 'apiauth']);


    $routes->get('courses', 'A\CourseApi::index', ['filter' => 'apiauth']);
    $routes->get('courses/(:num)', 'A\CourseApi::show/$1', ['filter' => 'apiauth']);


    $routes->get('testimonial', 'A\Testimonial::index', ['filter' => 'apiauth']);
    $routes->get('testimonial/(:num)', 'A\Testimonial::detail/$1', ['filter' => 'apiauth']);

    $routes->get('team', 'A\Team::index', ['filter' => 'apiauth']);
    $routes->get('team/(:num)', 'A\Team::detail/$1', ['filter' => 'apiauth']);

});
