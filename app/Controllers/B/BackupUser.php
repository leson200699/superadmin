<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use ZipArchive;
use Config\Services;

class BackupUser extends BaseController
{
    protected $cache;
    protected $tmpPath;

    public function __construct()
    {
        helper(['filesystem', 'session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
        $this->cache = Services::cache();
        $this->tmpPath = WRITEPATH . 'tmp_backup/';
    }

    public function index()
    {
        $user = get_session_data('user');
        $backupPath = ROOTPATH . "public/uploads/" . get_user_data('id') . "/backups/";

        $files = [];

        if (is_dir($backupPath)) {
            $fileList = array_diff(scandir($backupPath), ['.', '..']);
            foreach ($fileList as $file) {
                $filePath = $backupPath . $file;
                if (is_file($filePath)) {
                    $files[] = [
                        'name' => $file,
                        'size' => $this->formatBytes(filesize($filePath)),
                        'time' => date("Y-m-d H:i:s", filemtime($filePath)),
                    ];
                }
            }
        }
        
        return view('B/pages/backup/index', [
            'title' => 'Backup',
            'files' => $files,
            'user' => $user,
        ]);
    }

    // Helper format size
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }


    public function export()
    {
        $username = get_user_data('username');
        $userId = get_user_data('id');
        $uploadPath = ROOTPATH . "public/uploads/{$userId}/backups/";
        $viewsPath = ROOTPATH . "app/Views/F/{$username}";
        $publicPath = ROOTPATH . "public/F/{$username}";

        $customRoutePath = ROOTPATH . "app/Config/Routes/{$username}";
        if (is_dir($customRoutePath)) {
            $this->recursiveCopy($customRoutePath, $this->tmpPath . 'Routes/' . $username);
        }


        if (!is_dir($viewsPath) || !is_dir($publicPath)) {
            return redirect()->back()->with('error', 'Không tìm thấy thư mục user.');
        }

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if (is_dir($this->tmpPath)) {
            $this->deleteDirectory($this->tmpPath);
        }
        mkdir($this->tmpPath, 0755, true);

        $this->recursiveCopy($viewsPath, $this->tmpPath . 'Views/' . $username);
        $this->recursiveCopy($publicPath, $this->tmpPath . 'Public/' . $username);

        file_put_contents($this->tmpPath . 'backup.log', $this->generateFileList($this->tmpPath));

        $backupFile = $uploadPath . $username . '_' . date('Ymd_His') . ".zip";
        $zip = new ZipArchive();

        if ($zip->open($backupFile, ZipArchive::CREATE) !== true) {
            return redirect()->back()->with('error', 'Không thể tạo file backup.');
        }

        $this->addFolderToZip($this->tmpPath, $zip);
        $zip->close();

        $this->deleteDirectory($this->tmpPath);

        return redirect()->back()->with('success', 'Backup thành công.');
    }

       private function addFolderToZip($folder, &$zip)
{
    $folder = rtrim(realpath($folder), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($folder, \FilesystemIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folder));
            $zip->addFile($filePath, $relativePath);
        }
    }
}




    private function recursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst, 0755, true);

        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                if (is_dir("{$src}/{$file}")) {
                    $this->recursiveCopy("{$src}/{$file}", "{$dst}/{$file}");
                } else {
                    copy("{$src}/{$file}", "{$dst}/{$file}");
                }
            }
        }

        closedir($dir);
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            $this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item);
        }

        return rmdir($dir);
    }

    private function generateFileList($dir)
    {
        $output = '';
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isDir()) {
                $relativePath = substr($file->getRealPath(), strlen($dir) + 1);
                $output .= $relativePath . "\n";
            }
        }
        return $output;
    }


public function delete($fileName)
{
    $user = get_session_data('user');

    // Validate tên file để an toàn
    if (!preg_match('/^[a-zA-Z0-9_\-]+\.zip$/', $fileName)) {
        return redirect()->back()->with('error', 'Tên file không hợp lệ.');
    }

    $backupPath = ROOTPATH . "public/uploads/" . get_user_data('id') . "/backups/" . $fileName;

    if (!file_exists($backupPath)) {
        return redirect()->back()->with('error', 'Không tìm thấy file backup.');
    }

    if (unlink($backupPath)) {
        return redirect()->back()->with('success', 'Xóa file backup thành công.');
    } else {
        return redirect()->back()->with('error', 'Không thể xóa file backup.');
    }
}


public function restore($fileName)
{
    $user = get_session_data('user'); // user đăng nhập hiện tại
    $backupFile = ROOTPATH . "public/uploads/" . get_user_data('id') . "/backups/" . $fileName;

    if (!file_exists($backupFile)) {
        return redirect()->back()->with('error', 'Không tìm thấy file backup.');
    }

    // Đường dẫn giải nén tạm
    $restorePath = WRITEPATH . 'tmp_restore/';

    // Dọn thư mục restore tạm
    if (is_dir($restorePath)) {
        $this->deleteDirectory($restorePath);
    }
    mkdir($restorePath, 0755, true);

    $zip = new \ZipArchive();
    if ($zip->open($backupFile) === TRUE) {
        $zip->extractTo($restorePath);
        $zip->close();
    } else {
        return redirect()->back()->with('error', 'Không thể giải nén file backup.');
    }

    $viewsInBackup = glob($restorePath . 'Views/*', GLOB_ONLYDIR);
    $publicInBackup = glob($restorePath . 'Public/*', GLOB_ONLYDIR);
    $routesInBackup = glob($restorePath . 'Routes/*', GLOB_ONLYDIR);


    if (empty($viewsInBackup) || empty($publicInBackup)) {
        $this->deleteDirectory($restorePath);
        return redirect()->back()->with('error', 'Backup không hợp lệ.');
    }

    // Lấy username source trong backup
    $backupUsername = basename($viewsInBackup[0]); // Ví dụ: xoanretreat

    $viewsSource = $restorePath . 'Views/' . $backupUsername;
    $publicSource = $restorePath . 'Public/' . $backupUsername;
    $routesSource = $restorePath . 'Routes/' . $backupUsername;
    
    // 🛬 Đích là user đang đăng nhập
    $viewsDest = ROOTPATH . 'app/Views/F/' . get_user_data('username');
    $publicDest = ROOTPATH . 'public/F/' . get_user_data('username');
    $routesDest = ROOTPATH . 'app/Config/Routes/' . get_user_data('username');

    // XÓA FOLDER hiện tại của user trước khi ghi đè
    if (is_dir($viewsDest)) {
        $this->deleteDirectory($viewsDest);
    }
    if (is_dir($publicDest)) {
        $this->deleteDirectory($publicDest);
    }
    if (is_dir($routesDest)) {
        $this->deleteDirectory($routesDest);
    }


    // Copy từ backup vào user hiện tại
    if (is_dir($viewsSource)) {
        $this->recursiveCopy($viewsSource, $viewsDest);
    }
    if (is_dir($publicSource)) {
        $this->recursiveCopy($publicSource, $publicDest);
    }

    if (is_dir($routesSource)) {
        $this->recursiveCopy($routesSource, $routesDest);
    }

    // Xóa thư mục restore tạm
    $this->deleteDirectory($restorePath);

    return redirect()->back()->with('success', 'Khôi phục thành công.');
}




}