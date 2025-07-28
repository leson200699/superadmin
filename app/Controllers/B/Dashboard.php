<?php

namespace App\Controllers\B;

use CodeIgniter\Controller;
use Config\Database;

class Dashboard extends Controller
{
    // private $endpoint = "https://agent-f38af291d8fdaed3094b-8ma3o.ondigitalocean.app/api/v1/";
    // private $apiKey = "Vn_EB8lsQa1UHaG9udoVHZO-agINBJWS";


    private $endpoint = "https://agent-f1f403036f1ed7352b4f-ub237.ondigitalocean.app/api/v1/";
    private $apiKey = "Im0nrAXmbBIor_BGDkJPqOy1xQjDhnig";


    private $page = 'B/pages/dashboard';
    public function __construct()
    {
        helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        // Double-check authentication here as an additional security layer
        $user = get_user_data();
        if (empty($user)) {
            return redirect()->route('admin-auth-login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        
        $db    = \Config\Database::connect();
        $query = $db->table('audit_logs')->orderBy('action_time', 'DESC')->get();
        $logs  = $query->getResult();
        $data  = [
            'title' => lang('validation.dashboard'),
        ];

        if (!$this->request->getPost()) {
            session()->remove('chat_history');
        }

        session()->set('logs', $logs);
        return view($this->page, $data);
    }



    public function sendMessage()
    {
        // Check authentication for API calls
        $user = get_user_data();
        if (empty($user)) {
            return $this->response->setJSON(['error' => 'Unauthorized access']);
        }
        
        $userMessage = $this->request->getPost('message');
        $chatHistory = session('chat_history') ?? [];

      
        $chatHistory[] = ['role' => 'user', 'content' => $userMessage];
        $client = \Config\Services::curlrequest();
        $response = $client->post($this->endpoint . 'chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'n/a',
                'messages' => $chatHistory,
            ],
        ]);

        $result = json_decode($response->getBody(), true);
        $aiMessage = $result['choices'][0]['message']['content'];
        $chatHistory[] = ['role' => 'assistant', 'content' => $aiMessage];
        session()->set('chat_history', $chatHistory);
        $aiMessage = $this->formatMessage($aiMessage);
        return $this->response->setJSON(['message' => $aiMessage]);
    }

    private function formatMessage($text)
    {
       
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
        $text = nl2br($text);

        return $text;
    }

    

    public function checkLogin()
    {
        if (check_session_data_exist('user')) {
            return true;

        } else {
            return false;
        }
    }
    
    public function ajaxGetRecentLogs() 
    {
        // Check authentication for API calls
        $user = get_user_data();
        if (empty($user)) {
            return $this->response->setJSON(['error' => 'Unauthorized access']);
        }
        
        $logs = session('logs') ?? [];
        return $this->response->setJSON(['logs' => array_slice($logs, 0, 10)]);
    }
}





