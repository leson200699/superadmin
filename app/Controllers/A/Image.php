<?php

namespace App\Controllers\A;

use CodeIgniter\RESTful\ResourceController;

class Image extends ResourceController
{
    public function index($width = 300, $height = 200)
    {
        $width = intval($width);
        $height = intval($height);

        // Tạo ảnh với GD Library
        $image = imagecreatetruecolor($width, $height);

        // Màu nền tươi sáng hơn nhưng đơn giản
        $bgColor = imagecolorallocate($image, 230, 126, 34); // Màu cam sáng
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

        // Màu chữ trắng để nổi bật
        $textColor = imagecolorallocate($image, 255, 255, 255);
        $text = "AM EXPERIENCE - IMAGE API {$width} x {$height}";
        $fontSize = max(10, $width / 10);

        // Vẽ chữ lên ảnh
        imagestring($image, 5, $width / 3, $height / 3, $text, $textColor);

        // Trả về ảnh dạng PNG
        header("Content-Type: image/png");
        imagepng($image);
        imagedestroy($image);
        exit;
    }
}
