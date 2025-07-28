<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\ServiceCategoryModel;

class ServiceController extends BaseController
{
    protected $serviceModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->categoryModel = new ServiceCategoryModel();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $userId = get_user_data('id');
        $services = $this->serviceModel->where('author', $userId)->paginate(20);
        $pager = $this->serviceModel->pager;

        $view_data  = [
            'title'     => lang('validation.service_manage'),
            'tab'       => 'tin tuc, tin tuc l',
            'services'  => $services,
            'pager' => $pager
        ];

        return view('B/pages/service/list', $view_data);
    }

    public function create()
    {
        $userId = get_user_data('id');
        $view_data  = [
            'title'     => lang('validation.service_manage'),
            'tab'       => 'tin tuc, tin tuc l',
            'categories' => $this->categoryModel->where('author', $userId)->findAll(),
        ];

        return view('B/pages/service/create', $view_data);
    }

    public function store()
    {
        $userId = get_user_data('id');
        $data = $this->request->getPost();
        $data['author'] = $userId;

        if ($this->serviceModel->save($data)) {
            return redirect()->to('/admin/services')->with('success', 'Service created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create service');
        }
    }


    public function edit($id)
    {
        $userId = get_user_data('id');
        $service = $this->serviceModel->find($id);

        if (!$service || $service['author'] != $userId) {
            return redirect()->to('/admin/services')->with('error', 'Unauthorized access');
        }

        $categories = $this->categoryModel->findAll();

        return view('B/pages/service/edit',[
            'service' => $service,
            'categories' => $categories,
             'title'     => lang('validation.service_manage'),
        ]);
    }


    public function update($id)
    {
        $userId = get_user_data('id');
        $service = $this->serviceModel->find($id);

        if (!$service || $service['author'] != $userId) {
            return redirect()->to('/admin/services')->with('error', 'Unauthorized access');
        }

        $data = $this->request->getPost();

        // Kiểm tra và xử lý file upload (nếu có)
        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid()) {
            $newFileName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/services', $newFileName);
            $data['thumbnail'] = '/uploads/services/' . $newFileName;
        }

        $this->serviceModel->update($id, $data);
        return redirect()->to('/admin/services')->with('success', 'Service updated successfully');
    }


    public function delete($id)
    {
        $userId = get_user_data('id');
        $service = $this->serviceModel->find($id);

        if (!$service || $service['author'] != $userId) {
            return redirect()->to('/admin/services')->with('error', 'Unauthorized access');
        }

        $this->serviceModel->delete($id);
        return redirect()->to('/admin/services')->with('success', 'Service deleted successfully');
    }

}
