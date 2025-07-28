<?php

if (!function_exists('user_current')) {
    /**
     * Lấy username frontend hiện tại từ session hoặc subdomain
     */
    function user_current(): string
    {
        $session = service('session');
        $username = $session->get('frontend_username');

        if (empty($username)) {
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $parts = explode('.', $host);
            $username = ($parts[0]) ?? 'default';
        }

        return $username;
    }
}

if (!function_exists('user_master_view')) {
    /**
     * Trả về đường dẫn view master theo username
     */
    function user_master_view(): string
    {
        $username = user_current();

        $viewPath = APPPATH . 'Views/F/' . $username . '/master.php';
        if (file_exists($viewPath)) {
            return 'F/' . $username . '/master';
        }

        // Fallback master mặc định
        return 'F/default/master';
    }
}

if (!function_exists('user_partial_include')) {
    /**
     * Include partial view theo username, fallback về default nếu thiếu
     *
     * @param string $partialPath Đường dẫn partial bên trong layouts/ (vd: _head, _header)
     */
    function user_partial_include(string $partialPath): string
    {
        $username = user_current();

        $userPartial = 'F/' . $username . '/layouts/' . $partialPath;
        $defaultPartial = 'F/default/layouts/' . $partialPath;

        // Check nếu user có file partial riêng
        if (view_exists($userPartial)) {
            return view($userPartial);
        }

        // Không có thì load default
        return view($defaultPartial);
    }
}

if (!function_exists('view_exists')) {
    /**
     * Kiểm tra view file có tồn tại hay không
     */
    function view_exists(string $viewPath): bool
    {
        $paths = config('Paths');
        $viewFile = rtrim($paths->viewDirectory, '/') . '/' . str_replace('/', DIRECTORY_SEPARATOR, $viewPath) . '.php';
        return file_exists($viewFile);
    }
}
