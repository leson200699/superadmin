<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;

class CssEditor extends BaseController
{
    private $basePath;

    public function __construct()
    {
        $this->basePath = FCPATH . 'F/'; // Gốc thư mục F chứa theo username
                helper(['filesystem', 'session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function edit()
    {
        $user = get_session_data('user');
        if (!$user) {
            return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
        }

        $username = get_user_data('username');
        $cssPath = $this->basePath . $username . '/assets/style.css';

        if (!file_exists($cssPath)) {
            return redirect()->back()->with('error', 'Không tìm thấy tệp style.css');
        }

        $content = file_get_contents($cssPath);

        return view('B/pages/css_editor/edit', [
            'title' => 'Chỉnh sửa Style.css',
            'content' => $content,
            'username' => $username,
        ]);
    }

public function save()
{
    $user = get_session_data('user');
    if (!$user) {
        return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
    }

    $username = get_user_data('username');
    $newContent = $this->request->getPost('css_content');
    $cssPath = $this->basePath . $username . '/assets/style.css';

    if (!is_writable($cssPath)) {
        return redirect()->back()->with('error', 'Không thể ghi file style.css');
    }

    // 1. Backup file hiện tại
    $backupPath = $cssPath . '.bak_' . date('Ymd_His');
    copy($cssPath, $backupPath);

    // 2. Giới hạn chỉ giữ lại 5 bản backup
    $this->cleanupBackups($username);

    // 3. Ghi file mới
    file_put_contents($cssPath, $newContent);

    return redirect()->to(base_url('admin/css-editor/edit'))
                     ->with('success', 'Đã lưu style.css thành công!');
}

/**
 * Xoá backup cũ, chỉ giữ lại 5 bản mới nhất
 */
private function cleanupBackups($username)
{
    $backupDir = $this->basePath . $username . '/assets/';
    $backupFiles = glob($backupDir . 'style.css.bak_*');

    // Nếu có nhiều hơn 5 bản
    if (count($backupFiles) > 5) {
        // Sắp xếp theo thời gian file
        usort($backupFiles, function($a, $b) {
            return filemtime($a) <=> filemtime($b); // Tăng dần: cũ nhất lên đầu
        });

        // Xoá các file thừa
        $filesToDelete = array_slice($backupFiles, 0, count($backupFiles) - 5);

        foreach ($filesToDelete as $file) {
            @unlink($file);
        }
    }
}


    public function restoreBackup()
{
    $user = get_session_data('user');
    if (!$user) {
        return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
    }

    $username = get_user_data('username');
    $backupFile = $this->request->getPost('backup_file');

    $cssPath = $this->basePath . $username . '/assets/style.css';
    $backupPath = $this->basePath . $username . '/assets/' . $backupFile;

    // Check backup file hợp lệ
    if (!file_exists($backupPath) || strpos($backupPath, realpath($this->basePath . $username)) !== 0) {
        return redirect()->back()->with('error', 'Backup không hợp lệ.');
    }

    // Restore
    copy($backupPath, $cssPath);

    return redirect()->to(base_url('admin/css-editor/edit'))
                     ->with('success', 'Khôi phục thành công từ backup: ' . esc($backupFile));
}

}
