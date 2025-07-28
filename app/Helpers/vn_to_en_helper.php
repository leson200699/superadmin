<?php

if (!function_exists('vn_to_en')) {
    function vn_to_en($str)
    {
        // Bước 1: thay thế thủ công các ký tự "đ" và "Đ"
        $str = str_replace(['đ', 'Đ'], ['d', 'D'], $str);

        // Bước 2: chuẩn hóa chuỗi Unicode (phân tách base + dấu)
        $str = \Normalizer::normalize($str, \Normalizer::FORM_D);

        // Bước 3: loại bỏ toàn bộ dấu (diacritics)
        $str = preg_replace('/\pM/u', '', $str);

        return $str;
    }
}
