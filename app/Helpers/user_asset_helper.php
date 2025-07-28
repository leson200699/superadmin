<?php

if (!function_exists('user_asset_url')) {
    /**
     * Trả về URL asset theo user, tự động thêm ?v=timestamp, nếu không tồn tại thì trả về ''
     *
     * @param string $file File asset cần load (vd: style.css, js/main.js, images/logo.png)
     * @param string|null $username Username của user (optional)
     * @return string
     */
    function user_asset_url(string $file, ?string $username = null): string
    {
        if (empty($username)) {
            $session = service('session');
            $username = $session->get('frontend_username');

            if (empty($username)) {
                $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                $parts = explode('.', $host);
                $username = ($parts[0]) ?? 'default';
            }
        }

        $path = FCPATH . 'F/' . $username . '/assets/' . $file;

        if (file_exists($path)) {
            $timestamp = filemtime($path); // lấy thời gian sửa file
            return base_url('F/' . $username . '/assets/' . $file) . '?v=' . $timestamp;
        }

        // Nếu không có file asset, trả về chuỗi rỗng
        return '';
    }
}
