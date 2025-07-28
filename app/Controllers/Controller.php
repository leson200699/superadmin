<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $user;

    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->user = session()->get('user');
    }
}
