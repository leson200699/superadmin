<?php
namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\VisaOrderModel;

class VisaAdmin extends BaseController
{
    protected $visaOrderModel;

    public function __construct()
    {
        $this->visaOrderModel = new VisaOrderModel();
    }

    public function index()
    {
        $data['orders'] = $this->visaOrderModel->findAll();
        return view('backend/visa_orders', $data);
    }

    public function view($orderId)
    {
        $data['order'] = $this->visaOrderModel->where('order_id', $orderId)->first();
        return view('backend/visa_order_detail', $data);
    }
}