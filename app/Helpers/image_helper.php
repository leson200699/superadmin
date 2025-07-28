<?php

use CodeIgniter\Images\Image;

/**
 * Hàm resize ảnh theo width yêu cầu và tự động lưu trong thư mục con cùng với ảnh gốc.
 *
 * @param string $imagePath Đường dẫn ảnh gốc (tính từ `FCPATH` hoặc `WRITEPATH`)
 * @param int $width Chiều rộng mong muốn (vd: 300, 500)
 * @return string URL của ảnh resize
 */
function resize_image($imagePath, $width)
{
    // Kiểm tra ảnh gốc tồn tại
    if (!file_exists($imagePath)) {
        return null;
    }

    // Lấy thư mục chứa ảnh gốc
    $imageDir = dirname($imagePath);
    $filename = basename($imagePath);

    // Thư mục resize (cùng thư mục gốc, tạo thư mục con theo width)
    $resizeDir = $imageDir . '/' . $width;
    $resizePath = $resizeDir . '/' . $filename;

    // Nếu ảnh đã resize tồn tại, trả về URL
    if (file_exists($resizePath)) {
        return base_url(str_replace(FCPATH, '', $resizePath));
    }

    // Tạo thư mục đích nếu chưa có
    if (!is_dir($resizeDir)) {
        mkdir($resizeDir, 0777, true);
    }

    // Resize ảnh
    $image = \Config\Services::image()
                ->withFile($imagePath)
                ->resize($width, 0, true, 'width')
                ->save($resizePath);

    // Trả về URL ảnh resize
    return base_url(str_replace(FCPATH, '', $resizePath));
}