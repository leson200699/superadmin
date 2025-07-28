<?php

namespace App\Controllers\F;

use App\Controllers\F\BaseFrontendController;
use App\Models\Slideshow_Model;
use App\Models\News_Model;
use App\Models\Product_Model;
use App\Models\ServiceModel;
use App\Models\AboutModel;
use App\Models\PartnerModel;
use App\Models\Project_Model;
use App\Models\Testimonial_Model;
use App\Models\TourModel;
use App\Models\Car_Model;
use App\Models\TourCategoryModel;
use App\Models\News_Category_Model;

class Home extends BaseFrontendController
{
    public function index()
    {
        $slideshow_model     = new Slideshow_Model();
        $news_model          = new News_Model();
        $services_model      = new ServiceModel();
        $abouts_model        = new AboutModel();
        $partner_model       = new PartnerModel();
        $projects_model      = new Project_Model();
        $product_model       = new Product_Model();
        $testimonial_model   = new Testimonial_Model();
        $tour_model          = new TourModel();
        $tour_category_model = new TourCategoryModel();
        $news_category_model = new News_Category_Model();
        $car_model           = new Car_Model();

        $userId   = $this->user['id'];
        $username = $this->user['username'] ?? 'default';

        $slider         = $slideshow_model->getSlideshows($userId);
        $news           = $news_model->get_news_by_user($userId);
        $services       = $services_model->get_services_by_user($userId);
        $abouts         = $abouts_model->get_about_by_user($userId);
        $partner        = $partner_model->get_partner_by_user($userId);
        $projects       = $projects_model->getAllProjectsByUser($userId);
        $testimonial    = $testimonial_model->get_testimonial_by_user($userId);
        $tour_hot       = $tour_model->getHotToursByAuthor($userId);
        $tour_categories = $tour_category_model->findAll();
        $product        = $product_model->get_product_user($userId);
        $cars           = $car_model->get_car_by_user($userId);

        // Danh mục tin tức và danh sách tin theo danh mục
        $categories_with_news = [];
        $categories = $news_category_model->get_news_category_id($userId);

        foreach ($categories as $category) {
            $category_id = $category['id'];
            $category_news = $news_model->get_news_by_category($category_id, $userId, 10, false, true);
            $categories_with_news[] = [
                'category'   => $category,
                'news_list' => $category_news
            ];
        }

        $data = [
            'title'                => $this->config->seo_title ?? 'Trang chủ',
            'slider'               => $slider,
            'news'                 => $news,
            'services'             => $services,
            'abouts'               => $abouts,
            'partner'              => $partner,
            'projects'             => $projects,
            'product'              => $product,
            'tour_hot'             => $tour_hot,
            'tour_categories'      => $tour_categories,
            'testimonial'          => $testimonial,
            'categories_with_news' => $categories_with_news,
            'cars'                 => $cars,
        ];

        // View path theo tenant
        $viewPath = 'F/' . $username . '/home';
        if (!function_exists('view_exists')) {
            function view_exists(string $path): bool
            {
                return is_file(APPPATH . 'Views/' . $path . '.php');
            }
        }
        if (!view_exists($viewPath)) {
            $viewPath = 'F/default/home';
        }

        return view($viewPath, $data);
    }
} 
