<?php

namespace App\Controllers\B;

use CodeIgniter\Controller;
use Config\Database;

class Language extends Controller
{
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }


    public function change($locale)
    {
        // Kiб»ѓm tra ngГґn ngб»Ї cГі Д‘Ж°б»Јc hб»— trб»Ј khГґng
        if (in_array($locale, ['en', 'vi'])) {
            session()->set('locale', $locale); // LЖ°u vГ o session
        } else {
            session()->set('locale', 'vi'); // NgГґn ngб»Ї mбє·c Д‘б»‹nh
        }
        // Quay lбєЎi trang trЖ°б»›c
        return redirect()->back()->with('success', 'Language Changed.');
    }


    public function change_b($locale)
    {
        // Kiб»ѓm tra ngГґn ngб»Ї cГі Д‘Ж°б»Јc hб»— trб»Ј khГґng
        if (in_array($locale, ['en', 'vi'])) {
            session()->set('locale', $locale); // LЖ°u vГ o session
        } else {
            session()->set('locale', 'vi'); // NgГґn ngб»Ї mбє·c Д‘б»‹nh
        }
        return redirect_with_message_url('success', 'Language Changed.', 'dashboard');
    }


}
