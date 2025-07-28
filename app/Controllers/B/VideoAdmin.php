<?php
namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\VideoModel;
use App\Models\User_Model;

class VideoAdmin extends BaseController
{
    protected $videoModel;
    protected $userModel;
    protected $cache;

    public function __construct()
    {
        $this->videoModel = new VideoModel();
        $this->userModel = new User_Model();
        $this->cache = \Config\Services::cache();
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $data['title'] = 'Video';
        $data['videos'] = $this->videoModel->getVideos();
        $data['pager'] = $this->videoModel->pager;

        return view('B/pages/video/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('video_file');
            $thumbnail = $this->request->getFile('thumbnail');

            if ($file->isValid()) {
                $filePath = $file->store('videos/');
                $thumbnailPath = $thumbnail->isValid() ? $thumbnail->store('thumbnails/') : null;
                $userID = session()->has('user') ? session()->get('user')->id : null;
                if (!$userID) {
                    return redirect()->back()->with('error', 'User not authenticated');
                }
                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'file_path' => $filePath,
                    'thumbnail' => $thumbnailPath,
                    'duration' => $this->request->getPost('duration'),
                    'author' => $userID
                ];

                $this->videoModel->save($data);
                $this->cache->deleteMatching('videos_list_*');
                return redirect()->to('/admin/video')->with('success', 'Video added');
            }
        }

        $data['title'] = 'Video';
        return view('B/pages/video/create', $data);
    }


    public function store()
    {
        // Quy tắc validation
        $validationRules = [
            'title'       => 'required|max_length[255]',
            'description' => 'permit_empty',
            'video_file'  => 'required|max_length[255]', // Đường dẫn file video
            'thumbnail'   => 'permit_empty|max_length[255]', // Đường dẫn thumbnail
            'duration'    => 'permit_empty|numeric',
        ];

        // Kiểm tra validation
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Vui lòng kiểm tra lại thông tin nhập.');
        }

        $userID = session()->has('user') ? session()->get('user')->id : null;
        if (!$userID) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        // Lấy dữ liệu từ form
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'file_path'   => $this->request->getPost('video_file'), // Đường dẫn file từ file manager
            'thumbnail'   => $this->request->getPost('thumbnail') ?: null, // Nếu không có thì null
            'duration'    => $this->request->getPost('duration') ?: 0, // Mặc định 0 nếu không nhập
            'author'      => $userID
        ];

        // Lưu dữ liệu vào database
        if ($this->videoModel->save($data)) {
            // Xóa cache liên quan
            $this->cache->deleteMatching('videos_list_*');
            return redirect()->to('/admin/video')->with('success', 'Video đã được tạo thành công!');
        }

        return redirect()->back()->withInput()->with('error', 'Không thể tạo video.');
    }

    public function update($id)
    {

        // Kiểm tra video tồn tại
        $video = $this->videoModel->find($id);
        if (!$video) {
             return redirect_with_message_url('error', 'Video không tồn tại.', 'admin-video');
 
        }

        if ($this->request->getMethod() === 'post') {
            // Quy tắc validation
            $validationRules = [
                'title'       => 'required|max_length[255]',
                'description' => 'permit_empty',
                'duration'    => 'permit_empty|numeric',
            ];

            if (!$this->validate($validationRules)) {
                return redirect_with_message_url('error', 'Vui lòng kiểm tra lại thông tin nhập.', 'admin-video');
             
            }

            $data = $this->request->getPost();
            // Cập nhật dữ liệu
            if ($this->videoModel->update($id, $data)) {
                $this->cache->delete("video_{$id}");
                $this->cache->deleteMatching('videos_list_*');
                return redirect_with_message_url('success', 'Video đã được cập nhật thành công.', 'admin-video');
            }
            return redirect_with_message_url('error', 'Không thể cập nhật video.', 'admin-video');
    
        }


        $data['video'] = $video;
        $data['title'] = 'Edit Video';
        return view('B/pages/video/edit', $data);
    }

    public function delete($id)
    {
        $this->videoModel->delete($id);
        $this->cache->delete("video_{$id}");
        $this->cache->deleteMatching('videos_list_*');
        return redirect()->to('/admin/video')->with('success', 'Video deleted');
    }
}