<?php

if (!function_exists('clone_user_assets')) {
    /**
     * Clone thư mục assets từ default sang user mới
     *
     * @param string $username Tên username mới (trùng subdomain)
     * @return bool
     */
    function clone_user_assets(string $username): bool
    {
        $sourcePath = FCPATH . 'F/default/assets';
        $targetPath = FCPATH . 'F/' . $username . '/assets';

        if (!is_dir($sourcePath)) {
            log_message('error', 'Default assets folder not found at: ' . $sourcePath);
            return false;
        }

        if (is_dir($targetPath)) {
            log_message('info', 'User assets already exist at: ' . $targetPath);
            return true;
        }

        // Tạo folder F/{username}/assets nếu chưa có
        if (!is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0755, true);
        }

        // Copy folder
        $dirIterator = new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $dest = $targetPath . DIRECTORY_SEPARATOR . $files->getSubPathName();
            if ($file->isDir()) {
                mkdir($dest, 0755, true);
            } else {
                copy($file, $dest);
            }
        }

        return true;
    }
}

//clone_user_assets('xoanretreat');
//Nó sẽ tự copy toàn bộ /public/F/default/assets → thành /public/F/{username}/assets cho bạn.
