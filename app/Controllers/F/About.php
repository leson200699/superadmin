<?php

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\SectionModel;
use App\Models\News_Model;
use App\Models\Team_Member_Model;
use App\Models\PartnerModel;
use App\Models\Testimonial_Model;


class About extends BaseFrontendController
{

    public function index()
    {
        $userId = $this->user['id'];
        $news_model = new News_Model();
        $username = $this->user['username'] ?? 'default'; // lấy username
        $sectionModel = new SectionModel();
        $sections = $sectionModel
        ->where('active', 1)
        ->where('author', $userId)
        ->orderBy('position', 'ASC')
        ->findAll();
        $teams_model = new Team_Member_Model();
        $news = $news_model->get_news_by_user($userId);
        $teams = $teams_model->get_team_by_user($userId);

        $partner_model = new PartnerModel();
        $partner = $partner_model->get_partner_by_user($userId);
        $testimonial_model = new Testimonial_Model();
        $testimonials = $testimonial_model->get_testimonial_by_user($userId);

        $data = [
            'title' => "About - " . ucfirst($username),
            'sections' => $sections,
            'username' =>$username,
            'news' => $news,
            'teams' => $teams,
            'partner' => $partner,
            'testimonials' => $testimonials,
        ];

        $viewPath = 'F/' . $username . '/about';
        if (!view_exists($viewPath)) {
            $viewPath = 'F/default/about';
        }

        $html = view($viewPath, $data);


        return $html;
    }
        public function index2()
    {
        $username = $this->user['username'] ?? 'default'; // lấy username
        $cacheKey = "frontend_about_user_" . $username;
        $html = $this->cache->get($cacheKey);

        if (!$html) {
            $data = [
                'page_title' => "About - " . ucfirst($username),
            ];

            $viewPath = 'F/' . $username . '/about';
            if (!view_exists($viewPath)) {
                $viewPath = 'F/default/about';
            }

            $html = view($viewPath, $data);
            $this->cache->save($cacheKey, $html, 3600);
        }

        return $html;
    }
}
