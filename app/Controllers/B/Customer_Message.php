<?php

namespace App\Controllers\B;

use App\Models\Customer_Message_Model;
use CodeIgniter\Controller;

class Customer_Message extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {

        $customer_message_model = new Customer_Message_Model();
        $data                   = [
            'title'            => 'Khách hàng liên hệ',
            'customer_message' => $customer_message_model->get_customer_message()
        ];
        echo view('B/pages/customer/customer_message_list', $data);

    }

}
