<?php

namespace App\Controllers\B;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Files\UploadedFile;

class EditorController extends Controller
{
    protected $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    protected $maxSize = 5120; // 5MB in KB

    public function __construct()
    {
        helper(['session_helper', 'response_helper']);
    }

    /**
     * Upload ảnh từ rich text editor
     */
    public function uploadImage()
    {
        // Kiểm tra người dùng đã đăng nhập
        $userId = get_user_data('id');
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }

        // Kiểm tra request method
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Method không được phép'
            ]);
        }

        // Lấy file upload
        $image = $this->request->getFile('image');
        
        if (!$image || !$image->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Không có file được upload hoặc file không hợp lệ'
            ]);
        }

        // Kiểm tra loại file
        if (!in_array($image->getExtension(), $this->allowedTypes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Loại file không được hỗ trợ. Chỉ chấp nhận: ' . implode(', ', $this->allowedTypes)
            ]);
        }

        // Kiểm tra kích thước file
        if ($image->getSizeByUnit('kb') > $this->maxSize) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File quá lớn. Kích thước tối đa: ' . ($this->maxSize / 1024) . 'MB'
            ]);
        }

        try {
            // Tạo thư mục upload nếu chưa có
            $uploadPath = WRITEPATH . 'uploads/editor/' . date('Y/m/');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Tạo tên file mới
            $fileName = $this->generateUniqueFileName($image);
            
            // Upload file
            $image->move($uploadPath, $fileName);

            // Tạo URL public
            $publicPath = 'writable/uploads/editor/' . date('Y/m/') . $fileName;
            $imageUrl = base_url($publicPath);

            // Lưu thông tin vào database (tùy chọn)
            $this->saveImageInfo($userId, $fileName, $imageUrl, $image);

            return $this->response->setJSON([
                'success' => true,
                'url' => $imageUrl,
                'fileName' => $fileName,
                'message' => 'Upload ảnh thành công'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Editor upload error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi upload file: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Tạo tên file duy nhất
     */
    private function generateUniqueFileName(UploadedFile $file): string
    {
        $extension = $file->getExtension();
        $baseName = pathinfo($file->getName(), PATHINFO_FILENAME);
        
        // Làm sạch tên file
        $baseName = preg_replace('/[^a-zA-Z0-9_-]/', '', $baseName);
        if (empty($baseName)) {
            $baseName = 'image';
        }
        
        return $baseName . '_' . time() . '_' . uniqid() . '.' . $extension;
    }

    /**
     * Lưu thông tin ảnh vào database (tùy chọn)
     */
    private function saveImageInfo($userId, $fileName, $imageUrl, UploadedFile $file)
    {
        // Có thể lưu vào bảng editor_images hoặc bảng tương tự
        $db = \Config\Database::connect();
        
        $data = [
            'user_id' => $userId,
            'file_name' => $fileName,
            'file_url' => $imageUrl,
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'upload_date' => date('Y-m-d H:i:s')
        ];

        // Kiểm tra xem bảng có tồn tại không
        if ($db->tableExists('editor_images')) {
            $db->table('editor_images')->insert($data);
        }
    }

    /**
     * Xóa ảnh đã upload
     */
    public function deleteImage()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }

        $fileName = $this->request->getPost('fileName');
        if (!$fileName) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Thiếu tên file'
            ]);
        }

        try {
            // Tìm file và xóa
            $uploadPath = WRITEPATH . 'uploads/editor/';
            $filePath = $this->findFileInUploads($uploadPath, $fileName);
            
            if ($filePath && file_exists($filePath)) {
                unlink($filePath);
                
                // Xóa record trong database nếu có
                $this->deleteImageRecord($userId, $fileName);
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Xóa ảnh thành công'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Không tìm thấy file'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Editor delete error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa file'
            ]);
        }
    }

    /**
     * Tìm file trong thư mục uploads
     */
    private function findFileInUploads($basePath, $fileName)
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basePath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getFilename() === $fileName) {
                return $file->getPathname();
            }
        }

        return null;
    }

    /**
     * Xóa record ảnh trong database
     */
    private function deleteImageRecord($userId, $fileName)
    {
        $db = \Config\Database::connect();
        
        if ($db->tableExists('editor_images')) {
            $db->table('editor_images')
               ->where('user_id', $userId)
               ->where('file_name', $fileName)
               ->delete();
        }
    }

    /**
     * Lấy danh sách ảnh đã upload của user
     */
    public function getImages()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }

        try {
            $db = \Config\Database::connect();
            
            if ($db->tableExists('editor_images')) {
                $images = $db->table('editor_images')
                            ->where('user_id', $userId)
                            ->orderBy('upload_date', 'DESC')
                            ->limit(50)
                            ->get()
                            ->getResultArray();
                
                return $this->response->setJSON([
                    'success' => true,
                    'images' => $images
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => true,
                    'images' => [],
                    'message' => 'Chưa có ảnh nào được upload'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Editor get images error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách ảnh'
            ]);
        }
    }

    /**
     * Resize ảnh nếu cần
     */
    public function resizeImage()
    {
        $userId = get_user_data('id');
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }

        $imageUrl = $this->request->getPost('imageUrl');
        $width = (int)$this->request->getPost('width');
        $height = (int)$this->request->getPost('height');

        if (!$imageUrl || $width <= 0 || $height <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Thông số không hợp lệ'
            ]);
        }

        try {
            // Load Image Manipulation Library
            $image = \Config\Services::image();
            
            // Chuyển URL thành path
            $imagePath = str_replace(base_url(), FCPATH, $imageUrl);
            
            if (!file_exists($imagePath)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Không tìm thấy file ảnh'
                ]);
            }

            // Tạo tên file mới cho ảnh đã resize
            $pathInfo = pathinfo($imagePath);
            $newFileName = $pathInfo['filename'] . '_' . $width . 'x' . $height . '.' . $pathInfo['extension'];
            $newPath = $pathInfo['dirname'] . '/' . $newFileName;

            // Resize ảnh
            $image->withFile($imagePath)
                  ->resize($width, $height, true, 'center')
                  ->save($newPath);

            // Tạo URL mới
            $newUrl = str_replace(FCPATH, base_url(), $newPath);

            return $this->response->setJSON([
                'success' => true,
                'url' => $newUrl,
                'message' => 'Resize ảnh thành công'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Editor resize error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi resize ảnh: ' . $e->getMessage()
            ]);
        }
    }
}
