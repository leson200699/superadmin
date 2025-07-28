<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;

class Filemanager extends BaseController
{
    private $baseUploadPath;

    public function __construct()
    {
        // Đặt đường dẫn gốc tới thư mục uploads
        $this->baseUploadPath = FCPATH . 'uploads';
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
         $this->uploadBasePath = FCPATH . 'uploads';
    }

    private function getUserDirectory($path = '')
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return false; // Trả về false nếu không có user_id
        }
        
        $userPath = realpath($this->baseUploadPath . '/' . $userId);
        
        if (!$userPath) {
            return false; // Nếu thư mục không tồn tại, chặn truy cập
        }

        // Nếu có đường dẫn con, kết hợp vào thư mục user
        $fullPath = realpath($userPath . '/' . $path);
        
        // Đảm bảo rằng đường dẫn nằm trong thư mục của user
        if ($fullPath === false || strpos($fullPath, $userPath) !== 0) {
            return false;
        }

        return $fullPath;
    }

public function delete()
{
    $fileName = $this->request->getPost('name');
    $currentPath = $this->request->getPost('path');

    // Lấy thư mục người dùng (customize lại nếu không cần per-user)
    $absoluteCurrentPath = $this->getUserDirectory($currentPath);

    if (!$absoluteCurrentPath || !is_dir($absoluteCurrentPath)) {
        return redirect()->back()->with('error', 'Không thể truy cập thư mục.');
    }

    $filePath = $absoluteCurrentPath . '/' . $fileName;

    if (!file_exists($filePath)) {
    die('File không tồn tại: ' . $filePath);
    }

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'Tệp tin không tồn tại: ' . basename($filePath));
    }

    if (!is_file($filePath)) {
        return redirect()->back()->with('error', 'Không phải tệp hợp lệ.');
    }

    if (!is_writable($filePath)) {
        return redirect()->back()->with('error', 'Tệp không có quyền xoá.');
    }

    if (unlink($filePath)) {
        return redirect()->back()->with('success', 'Tệp tin đã được xoá.');
    }

    return redirect()->back()->with('error', 'Không thể xoá tệp tin.');
}



public function deleteMultiple()
{
    $userId = get_user_data('id');
    $selectedFiles = $this->request->getPost('selectedFiles');
    $currentPath = $this->request->getPost('path');

    if (empty($selectedFiles)) {
        return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                        ->with('error', 'Không có tệp tin nào được chọn để xóa');
    }

    $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);
    if (!$absoluteCurrentPath) {
        return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                        ->with('error', 'Đường dẫn không hợp lệ');
    }

    $deletedCount = 0;
    foreach ($selectedFiles as $fileName) {
        $filePath = $absoluteCurrentPath . '/' . $fileName;
        if (is_file($filePath) && unlink($filePath)) {
            $deletedCount++;
        }
    }

    if ($deletedCount > 0) {
        return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                        ->with('success', "Đã xóa thành công $deletedCount tệp tin");
    } else {
        return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                        ->with('error', 'Không thể xóa các tệp tin đã chọn');
    }
}

public function index()
{
    $userId = get_user_data('id');
    if (!$userId) {
        return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
    }

    $userFolderPath = $this->baseUploadPath . '/' . $userId;
    if (!is_dir($userFolderPath)) {
        mkdir($userFolderPath, 0755, true);
    }

    $currentPath = $this->request->getGet('path') ?? '';
    $filterType = $this->request->getGet('filter') ?? 'all'; // Lấy tham số lọc từ URL
    $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);
    $userRealPath = realpath($userFolderPath);

    if ($absoluteCurrentPath === false || $userRealPath === false || strpos($absoluteCurrentPath, $userRealPath) !== 0) {
        return redirect_with_message_url('error', 'Truy cập không hợp lệ', 'dashboard');
    }

    $files = [];
    try {
        $dir = new \DirectoryIterator($absoluteCurrentPath);
        $fileExtensions = [
            'documents' => ['doc', 'docx', 'pdf', 'txt'],
            'images'    => ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
            'videos'    => ['mp4', 'avi', 'mov', 'wmv'],
            'audio'     => ['mp3', 'wav', 'ogg'],
            'zip'       => ['zip', 'rar', '7z']
        ];

        foreach ($dir as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $ext = strtolower(pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION));
                $fileData = [
                    'name'   => $fileInfo->getFilename(),
                    'path'   => ltrim($currentPath . '/' . $fileInfo->getFilename(), '/'),
                    'is_dir' => $fileInfo->isDir(),
                    'size'   => $fileInfo->getSize(),
                    'date'   => date('Y-m-d H:i:s', $fileInfo->getMTime())
                ];

                // Lọc theo loại file
                if ($fileInfo->isDir() || $filterType === 'all') {
                    $files[] = $fileData;
                } elseif (isset($fileExtensions[$filterType]) && in_array($ext, $fileExtensions[$filterType])) {
                    $files[] = $fileData;
                }
            }
        }
    } catch (Exception $e) {
        return redirect_with_message_url('error', 'Lỗi khi truy xuất thư mục', 'dashboard');
    }

    $stats = [
        'total_size'   => $this->getTotalSize($absoluteCurrentPath),
        'file_count'   => $this->getFileCount($absoluteCurrentPath),
        'folder_count' => $this->getFolderCount($absoluteCurrentPath)
    ];

    return view('B/pages/files/file_manager', [
        'title'       => 'Quản lý tệp tin',
        'files'       => $files,
        'currentPath' => $currentPath,
        'stats'       => $stats,
        'filterType'  => $filterType // Truyền filterType để giữ trạng thái
    ]);
}

    public function pop()
{
    $userId = get_user_data('id');
    
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!$userId) {
        return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
    }

    // Định nghĩa thư mục cá nhân của user
    $userFolderPath = $this->baseUploadPath . '/' . $userId;
    
    // Nếu thư mục chưa tồn tại, tự động tạo
    if (!is_dir($userFolderPath)) {
        mkdir($userFolderPath, 0755, true);
    }

    // Lấy đường dẫn hiện tại từ query hoặc rỗng nếu không có
    $currentPath = $this->request->getGet('path') ?? '';
    
    // Chuyển đường dẫn thành đường dẫn tuyệt đối
    $absoluteCurrentPath = rtrim(realpath($this->baseUploadPath . '/' . $currentPath), '/');
    $userRealPath = rtrim(realpath($userFolderPath), '/');

    // Kiểm tra nếu realpath trả về false (lỗi xác định đường dẫn)
    if ($absoluteCurrentPath === false || $userRealPath === false) {
        return redirect_with_message_url('error', 'Không thể xác định đường dẫn thư mục', 'dashboard');
    }

    // Kiểm tra quyền truy cập thư mục
    if (strpos($absoluteCurrentPath, $userRealPath) !== 0) {
        return redirect()->to(base_url('admin/pop_file?path=' . $userId));
    }

    $files = [];
    $dir   = new \DirectoryIterator($absoluteCurrentPath);

    foreach ($dir as $fileInfo) {
        if (!$fileInfo->isDot()) {
            $files[] = [
                'name'   => $fileInfo->getFilename(),
                'path'   => ltrim($currentPath . '/' . $fileInfo->getFilename(), '/'),
                'is_dir' => $fileInfo->isDir(),
                'size'   => $fileInfo->getSize(),
                'date'   => date('Y-m-d H:i:s', $fileInfo->getMTime())
            ];
        }
    }

        $stats = [
            'total_size'   => $this->getTotalSize($absoluteCurrentPath),
            'file_count'   => $this->getFileCount($absoluteCurrentPath),
            'folder_count' => $this->getFolderCount($absoluteCurrentPath)
        ];

        return view('B/pages/files/file_modal', [
            'title'       => 'Quản lý tệp tin',
            'files'       => $files,
            'currentPath' => $currentPath,
            'stats'       => $stats
        ]);
    }


   public function editor()
    {
        $userId = get_user_data('id');

        if (!$userId) {
            return redirect_with_message_url('error', 'Bạn chưa đăng nhập', 'dashboard');
        }

        // Định nghĩa thư mục cá nhân
        $userFolderPath = $this->baseUploadPath . '/' . $userId;

        if (!is_dir($userFolderPath)) {
            mkdir($userFolderPath, 0755, true);
        }

        $currentPath = $this->request->getGet('path') ?? '';
        $absoluteCurrentPath = rtrim(realpath($this->baseUploadPath . '/' . $currentPath), '/');
        $userRealPath = rtrim(realpath($userFolderPath), '/');

        // Kiểm tra tính hợp lệ của đường dẫn
        if ($absoluteCurrentPath === false || $userRealPath === false) {
            return redirect_with_message_url('error', 'Không thể xác định đường dẫn thư mục', 'dashboard');
        }

        // Không cho truy cập vượt ra ngoài thư mục của user
        if (strpos($absoluteCurrentPath, $userRealPath) !== 0) {
            return redirect()->to(base_url('admin/editor_file?path=' . $userId));
        }

        $files = [];
        $dir   = new \DirectoryIterator($absoluteCurrentPath);

        foreach ($dir as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $files[] = [
                    'name'   => $fileInfo->getFilename(),
                    'path'   => ltrim($currentPath . '/' . $fileInfo->getFilename(), '/'),
                    'is_dir' => $fileInfo->isDir(),
                    'size'   => $fileInfo->getSize(),
                    'date'   => date('Y-m-d H:i:s', $fileInfo->getMTime())
                ];
            }
        }

        $stats = [
            'total_size'   => $this->getTotalSize($absoluteCurrentPath),
            'file_count'   => $this->getFileCount($absoluteCurrentPath),
            'folder_count' => $this->getFolderCount($absoluteCurrentPath)
        ];

        return view('B/pages/files/editor_file', [
            'title'       => 'Quản lý tệp tin',
            'files'       => $files,
            'currentPath' => $currentPath,
            'stats'       => $stats
        ]);
    }


    private function getTotalSize($path)
    {
        $totalSize = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
            // Bỏ qua các thư mục '.' và '..'
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            $totalSize += $file->getSize();
        }
        return $totalSize;
    }

    private function getFileCount($path)
    {
        $fileCount = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
            // Bỏ qua các thư mục '.' và '..'
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isFile()) {
                $fileCount++;
            }
        }
        return $fileCount;
    }

    private function getFolderCount($path)
    {
        $folderCount = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
            // Bỏ qua các thư mục '.' và '..'
            if ($file->getFilename() === '.' || $file->getFilename() === '..') {
                continue;
            }
            if ($file->isDir()) {
                $folderCount++;
            }
        }
        return $folderCount;
    }

    public function createFolder()
{
    // Lấy tên thư mục và đường dẫn
    $folderName  = $this->request->getPost('folder_name');
    $currentPath = $this->request->getPost('path');

    // Kiểm tra xem người dùng đã nhập tên thư mục chưa
    if (empty($folderName)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Tên thư mục không được để trống'
        ]);
    }

    // Lấy thư mục người dùng và xác định đường dẫn
    $userId = get_user_data('id');
    $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $userId . '/' . $currentPath);

    if (!$absoluteCurrentPath || !is_dir($absoluteCurrentPath)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Đường dẫn không hợp lệ hoặc không tồn tại'
        ]);
    }

    // Đường dẫn thư mục mới
    $newFolderPath = $absoluteCurrentPath . '/' . $folderName;

    // Kiểm tra xem thư mục đã tồn tại chưa
    if (is_dir($newFolderPath)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Thư mục đã tồn tại'
        ]);
    }

    // Tạo thư mục mới
    mkdir($newFolderPath, 0777, true);

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Thư mục đã được tạo thành công'
    ]);
}



// File: FilemanagerController.php
public function createFolderfull()
{
    $folderName = $this->request->getPost('folder_name');
    $currentPath = $this->request->getPost('path');

    // Xử lý tạo thư mục
    $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);

    if (empty($folderName)) {
        return redirect()->back()->with('error', 'Tên thư mục không được rỗng');
    }

    // Tạo đường dẫn tuyệt đối của thư mục mới
    $newFolderPath = $absoluteCurrentPath . '/' . $folderName;

    if (!is_dir($newFolderPath)) {
        mkdir($newFolderPath, 0777, true);
        return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                         ->with('success', 'Thư mục đã được tạo thành công');
    } else {
        return redirect()->back()->with('error', 'Thư mục đã tồn tại');
    }
}



    public function upload()
    {
        $userId = get_user_data('id');
        $files = $this->request->getFileMultiple('file');
        $currentPath = $this->request->getPost('path');

        // Đảm bảo thư mục đích tồn tại
        $destination = $this->baseUploadPath . '/' . $currentPath;
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $uploadedCount = 0;
        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move($destination);
                $uploadedCount++;
            }
        }

        if ($uploadedCount > 0) {
            return redirect()->to(base_url('admin/filemanager?path=' . $currentPath))
                             ->with('success', "Đã tải lên thành công {$uploadedCount} tệp tin");
        }

        return redirect()->back()->with('error', 'Không thể tải lên các tệp tin');
    }


    public function upload_pop()
    {
        $userId = get_user_data('id');
        $files = $this->request->getFiles(); // lấy tất cả file upload
        $currentPath = $this->request->getPost('path');

        $destination = $this->baseUploadPath . '/' . $userId;
        if ($currentPath) {
            $destination .= '/' . trim($currentPath, '/');
        }

        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $uploadedCount = 0;
        foreach ($files['file'] ?? [] as $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $file->move($destination);
                $uploadedCount++;
            }
        }

        if ($uploadedCount > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "Đã tải lên thành công {$uploadedCount} tệp tin"
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Không thể tải lên các tệp tin'
        ]);
    }




    //  public function delete()
    // {
    //     $fileName = urldecode($this->request->getGet('name')); // Giải mã ký tự đặc biệt từ URL
    //     $currentPath = $this->request->getGet('path');

    //     $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);

    //     // Kiểm tra đường dẫn hợp lệ và tồn tại
    //     if (!$absoluteCurrentPath || !is_dir($absoluteCurrentPath)) {
    //         return redirect()->back()->with('error', 'Đường dẫn không hợp lệ hoặc không tồn tại');
    //     }

    //     $filePath = $absoluteCurrentPath . '/' . $fileName;

    //     // Kiểm tra tệp tin có tồn tại không
    //     if (is_file($filePath)) {
    //         if (unlink($filePath)) {
    //             return redirect()->back()->with('success', 'Tệp tin đã được xóa');
    //         } else {
    //             return redirect()->back()->with('error', 'Không thể xóa tệp tin do lỗi hệ thống');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Tệp tin không tồn tại');
    //     }
    // }

    private function deleteFolderRecursively($folderPath)
    {
        $files = array_diff(scandir($folderPath), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $folderPath . '/' . $file;
            if (is_dir($filePath)) {
                $this->deleteFolderRecursively($filePath); // Xóa thư mục con
            } else {
                unlink($filePath); // Xóa file
            }
        }
        rmdir($folderPath); // Xóa thư mục rỗng
    }

    public function deleteFolder()
    {
        $folderName  = $this->request->getGet('name');
        $currentPath = $this->request->getGet('path');

        $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);
        if (!$absoluteCurrentPath) {
            return redirect()->back()->with('error', 'Đường dẫn không hợp lệ');
        }
        $folderPath = $absoluteCurrentPath . '/' . $folderName;

        if (is_dir($folderPath)) {
            $this->deleteFolderRecursively($folderPath);
            return redirect()->back()->with('success', 'Thư mục đã được xóa');
        } else {
            return redirect()->back()->with('error', 'Thư mục không tồn tại');
        }
    }

    public function renameFile()
    {
        $oldName = $this->request->getPost('old_name');
        $newNameInput = $this->request->getPost('new_name');
        $currentPath = $this->request->getPost('path');

        $absoluteCurrentPath = realpath($this->baseUploadPath . '/' . $currentPath);
        $oldFilePath = $absoluteCurrentPath . '/' . $oldName;

        // Lấy phần mở rộng cũ từ tên file gốc (vd: .jpg, .pdf)
        $oldExtension = pathinfo($oldName, PATHINFO_EXTENSION);
        $newNameInputExtension = pathinfo($newNameInput, PATHINFO_EXTENSION);

        // Nếu người dùng đã nhập tên có đuôi -> giữ nguyên, ngược lại thêm đuôi cũ
        if ($newNameInputExtension) {
            $newName = $newNameInput; // Đã có đuôi
        } else {
            $newName = $newNameInput . '.' . $oldExtension;
        }

        $newFilePath = $absoluteCurrentPath . '/' . $newName;

        if (file_exists($oldFilePath) && !file_exists($newFilePath)) {
            rename($oldFilePath, $newFilePath);
            return redirect()->back()->with('success', 'Tệp tin đã được đổi tên thành ' . esc($newName));
        } else {
            return redirect()->back()->with('error', 'Đổi tên thất bại. Tệp tin không tồn tại hoặc tên mới đã tồn tại.');
        }
    }

 public function listFiles()
{
    $userId = get_user_data('id');
    if (!$userId) {
        return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
    }

    $path = $this->request->getGet('path') ?? '';

    $basePath = realpath($this->baseUploadPath . '/' . $userId);
    $realPath = realpath($basePath . DIRECTORY_SEPARATOR . $path);

    if (!$realPath || strpos($realPath, $basePath) !== 0) {
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid path']);
    }

    $dirs = [];
    $files = [];

    $items = scandir($realPath);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $full = $realPath . DIRECTORY_SEPARATOR . $item;

        if (is_dir($full)) {
            $dirs[] = ['name' => $item];
        } else {
            $files[] = [
                'name' => $item,
                'url' => "/uploads/{$userId}" . ($path ? '/' . $path : '') . '/' . $item,
            ];
        }
    }

    return $this->response->setJSON([
        'path' => $path,
        'dirs' => $dirs,
        'files' => $files,
    ]);
}







}
