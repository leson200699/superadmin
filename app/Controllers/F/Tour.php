<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\TourModel;
use App\Models\TourCategoryModel;
use App\Models\TourScheduleModel;


class Tour extends BaseFrontendController
{
    protected $tour_model;
    protected $scheduleModel;
    protected $tour_category_model;
    
    public function __construct()
    {
        $this->tour_model = new TourModel();
        $this->scheduleModel = new TourScheduleModel();
        $this->tour_category_model = new TourCategoryModel();

    }


    public function index()
    {
        $tour_model = new TourModel();
        $tour_category_model = new TourCategoryModel();
        
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default';
        $tour_hot = $tour_model->getHotToursByAuthor($userId);
        $tour_international = $tour_category_model->getInternationalTours($userId);
        $tour_domestic = $tour_category_model->getDomesticTours($userId);
        $data = [
            'title' => 'Tour',
            'tour_hot' => $tour_hot,
        ];

        // kiểm tra view tồn tại cho user
        $viewPath = 'F/' . $username . '/tours/index';
        if (!view_exists($viewPath)) {
            $viewPath = 'F/default/home';
        }

        $html = view($viewPath, $data);
        //$this->cache->save($cacheKey, $html, 3600); // cache 1h
    

        return $html;
        //return redirect()->to('/admin'); // <- cái này tạm comment nếu bạn muốn render ra view FE nhé
    }


    public function categories($identifier)
    {
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default';

        $tour_category_model = new TourCategoryModel();
        $result = $tour_category_model->getTourByType($identifier, $userId);

        $data = [
            'title' => 'Tour',
            'tour_categories' => $result['tours'],
            'tour_type' => $result['domestic_type'],
        ];

        $viewPath = 'F/' . $username . '/tours/categories';

        if (!view_exists($viewPath)) {
               $viewPath = 'F/default/home';
        }

        $html = view($viewPath, $data);
        return $html;
    }


    public function detail($identifier)
    {   
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default';

        $data['title'] = 'Tour views';
        $data['tour'] = $this->tour_model->getTourWithSchedules($identifier);
        $data['schedules'] = $this->scheduleModel->getSchedulesByTour($identifier);
        $data['lang'] = session()->get('lang') ?? 'vi';


        $viewPath = 'F/' . $username . '/tours/detail';

        if (!view_exists($viewPath)) {
               $viewPath = 'F/default/home';
        }

        $html = view($viewPath, $data);
        return $html;
    }

    public function category($categoryId)
    {
        $userId = $this->user['id'];
        $username = $this->user['username'] ?? 'default';

        $tour_category_model = new TourCategoryModel();
        $tours = $tour_category_model->getToursByCategory($categoryId, $userId);
        $category = $tour_category_model->find($categoryId);

        $data = [
            'title' => 'Tour theo danh mục',
            'tours' => $tours,
            'category' => $category,
        ];

        $viewPath = 'F/' . $username . '/tours/category';

        if (!view_exists($viewPath)) {
            $viewPath = 'F/default/home';
        }

        $html = view($viewPath, $data);
        return $html;
    }



    


}
