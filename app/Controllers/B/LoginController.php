<?php
namespace App\Controllers\B;

use CodeIgniter\Controller;
use App\Models\UserSessionModel;
use App\Models\AccessTokenModel;
use Config\Services;

class LoginController extends Controller
{
    private $idpUrl = 'https://id.amx.vn';
    private $clientId = 'admin';
    private $clientSecret = 'secret123';
    private $redirectUri = 'https://admin.amx.vn/admin2/auth2/callback';

    public function index()
    {
        log_message('debug', 'LoginController::index called');
        
        // Kiểm tra parameter force_login để force logout và redirect
        $forceLogin = $this->request->getGet('force_login');
        if ($forceLogin) {
            log_message('debug', 'Force login requested, clearing session');
            session()->destroy();
            
            // Xóa cookies
            $sessionName = session_name();
            $domains = ['.amx.vn', 'admin.amx.vn', 'id.amx.vn', 'amx.vn', 'vinfastanthai.vn', '.vinfastanthai.vn', ''];
            foreach ($domains as $domain) {
                setcookie($sessionName, '', time() - 3600, '/', $domain, false, true);
                setcookie($sessionName, '', time() - 3600, '/', $domain, true, true);
            }
            
            // Redirect lại để tránh cache
            return redirect()->to('/admin2/login2');
        }
        
        // Kiểm tra xem a-superadmin có session không
        $user = session()->get('user');
        log_message('debug', 'User session in index: ' . json_encode($user));
        
        if ($user) {
            log_message('debug', 'User found, checking IDP session');
            
            // Kiểm tra session IDP để đảm bảo tính nhất quán
            $idpSessionValid = false;
            try {
                $client = \Config\Services::curlrequest();
                $response = $client->get($this->idpUrl . '/auth/check-session');
                $idpData = json_decode($response->getBody(), true);
                $idpSessionValid = $idpData['logged_in'] ?? false;
                log_message('debug', 'IDP session check: ' . $response->getStatusCode() . ' - ' . $response->getBody());
            } catch (\Exception $e) {
                log_message('error', 'IDP session check failed: ' . $e->getMessage());
            }
            
            // Nếu IDP session không hợp lệ, xóa local session và redirect
            if (!$idpSessionValid) {
                log_message('debug', 'IDP session invalid, clearing local session');
                session()->destroy();
                
                // Xóa cookies
                $sessionName = session_name();
                $domains = ['.amx.vn', 'admin.amx.vn', 'id.amx.vn', 'amx.vn', 'vinfastanthai.vn', '.vinfastanthai.vn', ''];
                foreach ($domains as $domain) {
                    setcookie($sessionName, '', time() - 3600, '/', $domain, false, true);
                    setcookie($sessionName, '', time() - 3600, '/', $domain, true, true);
                }
                
                // Redirect lại để bắt đầu OAuth flow
                return redirect()->to('/admin2/login2');
            }
            
            // Nếu cả hai session đều hợp lệ, redirect về dashboard
            log_message('debug', 'Both sessions valid, redirecting to dashboard');
            return redirect()->to('/admin2/dashboard');
        }

        log_message('debug', 'No user session, starting OAuth flow');
        $state = bin2hex(random_bytes(16));
        session()->set('oauth_state', $state);

        $authorizeUrl = $this->idpUrl . '/auth/authorize?client_id=' . $this->clientId . '&redirect_uri=' . urlencode($this->redirectUri) . '&state=' . $state;
        log_message('debug', 'Redirecting to IDP: ' . $authorizeUrl);
        return redirect()->to($authorizeUrl);
    }

    public function callback()
    {
        $code = $this->request->getGet('code');
        $state = $this->request->getGet('state');

        if (!$code || $state !== session()->get('oauth_state')) {
            return redirect()->to('/admin2/login2')->with('error', 'Invalid state or code');
        }

        $client = \Config\Services::curlrequest();

        // Exchange code for token
        $response = $client->post($this->idpUrl . '/auth/token', [
            'form_params' => [
                'code' => $code,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            return redirect()->to('/admin2/login2')->with('error', 'Token exchange failed');
        }

        $data = json_decode($response->getBody(), true);
        $token = $data['access_token'];

        // Gọi userinfo
        $userinfoResponse = $client->get($this->idpUrl . '/auth/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        if ($userinfoResponse->getStatusCode() !== 200) {
            return redirect()->to('/admin2/login2')->with('error', 'Userinfo fetch failed');
        }

        $userData = json_decode($userinfoResponse->getBody(), true);

        // Set 'user' as object, merge all fields (clean duplicate)
        $userSessionData = (object) [
            'id' => $userData['user_id'] ?? null,
            'username' => $userData['username'] ?? null,
            'email' => $userData['email'] ?? null,
            'firstname' => $userData['firstname'] ?? null,
            'lastname' => $userData['lastname'] ?? null,
            'role' => $userData['role'] ?? 1,
            'is_admin' => $userData['is_admin'] ?? 0,
            'access_token' => $token,
            // Thêm các field khác từ $userData nếu cần
        ];
        session()->set('user', $userSessionData);

        // Insert vào DB session
        $sessionModel = new UserSessionModel();
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sessionModel->createSession([
            'user_id' => $userData['user_id'] ?? null,
            'access_token' => $token,
            'username' => $userData['username'] ?? null,
            'email' => $userData['email'] ?? null,
            'firstname' => $userData['firstname'] ?? null,
            'lastname' => $userData['lastname'] ?? null,
            'role' => $userData['role'] ?? 1,
            'is_admin' => $userData['is_admin'] ?? 0,
            'expires' => $expires,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin2/dashboard');
    }

    // Trong LoginController::logout() (Client)
    public function logout()
    {
        log_message('debug', '=== LOGOUT START ===');
        
        $user = session()->get('user');
        log_message('debug', 'User session before logout: ' . json_encode($user));
        
        $token = null;
        
        if ($user && isset($user->access_token)) {
            $token = $user->access_token;
            log_message('debug', 'Token found: ' . substr($token, 0, 10) . '...');
            
            // Gọi IDP strong logout với token
            try {
                $client = \Config\Services::curlrequest();
                $response = $client->post($this->idpUrl . '/auth/strong-logout', [
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]);
                log_message('debug', 'IDP strong logout response: ' . $response->getStatusCode() . ' - ' . $response->getBody());
            } catch (\Exception $e) {
                log_message('error', 'IDP strong logout failed: ' . $e->getMessage());
            }
        } else {
            log_message('debug', 'No user or token found');
        }

        // Gọi IDP strong logout không cần token để đảm bảo session IDP được xóa
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->post($this->idpUrl . '/auth/strong-logout');
            log_message('debug', 'IDP strong logout (no token) response: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            log_message('error', 'IDP strong logout (no token) failed: ' . $e->getMessage());
        }

        // Xóa DB session
        if ($token) {
            $sessionModel = new UserSessionModel();
            $deleted = $sessionModel->where('access_token', $token)->delete();
            log_message('debug', 'DB session deleted: ' . $deleted);
        }

        // Xóa tất cả sessions trong DB cho user này
        if ($user && isset($user->id)) {
            $sessionModel = new UserSessionModel();
            $deleted = $sessionModel->where('user_id', $user->id)->delete();
            log_message('debug', 'All DB sessions for user deleted: ' . $deleted);
        }

        // Xóa PHP session
        session()->destroy();
        log_message('debug', 'PHP session destroyed');
        
        // Force xóa tất cả cookies liên quan với nhiều domain
        $sessionName = session_name();
        log_message('debug', 'Session name: ' . $sessionName);
        
        // Danh sách domain cần xóa cookie
        $domains = [
            '.amx.vn',           // Root domain
            'admin.amx.vn',      // Admin subdomain
            'id.amx.vn',         // IDP subdomain
            'amx.vn',            // Without dot
            'vinfastanthai.vn',  // Alternative domain
            '.vinfastanthai.vn', // Alternative root domain
            ''                   // No domain (localhost)
        ];
        
        // Danh sách cookie names cần xóa
        $cookieNames = ['ci_session', 'PHPSESSID', 'session_id'];
        
        foreach ($cookieNames as $cookieName) {
            foreach ($domains as $domain) {
                // Xóa cookie với các flag khác nhau
                setcookie($cookieName, '', time() - 3600, '/', $domain, false, true);
                setcookie($cookieName, '', time() - 3600, '/', $domain, true, true);
                setcookie($cookieName, '', time() - 3600, '/', $domain, false, false);
                setcookie($cookieName, '', time() - 3600, '/', $domain, true, false);
            }
        }
        
        log_message('debug', 'All cookies deleted');

        // Thêm header để ngăn cache
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        header('Clear-Site-Data: "cache", "cookies", "storage"');

        log_message('debug', '=== LOGOUT END ===');
        log_message('debug', 'Redirecting to login2');
        return redirect()->to('/admin2/login2?force_login=1')->with('success', 'Đã đăng xuất thành công');
    }

    public function testSession()
    {
        $user = session()->get('user');
        $sessionData = [
            'user' => $user,
            'session_id' => session_id(),
            'cookies' => $_COOKIE,
            'session_name' => session_name()
        ];
        
        return $this->response->setJSON($sessionData);
    }

    public function simpleLogout()
    {
        log_message('debug', 'Simple logout called');
        
        // Chỉ xóa session local
        session()->destroy();
        
        // Xóa cookie
        $sessionName = session_name();
        setcookie($sessionName, '', time() - 3600, '/');
        
        return $this->response->setJSON(['message' => 'Simple logout done']);
    }

    public function testLogout()
    {
        log_message('debug', '=== TEST LOGOUT START ===');
        
        $user = session()->get('user');
        log_message('debug', 'User session before logout: ' . json_encode($user));
        
        $token = null;
        if ($user && isset($user->access_token)) {
            $token = $user->access_token;
            log_message('debug', 'Token found: ' . substr($token, 0, 10) . '...');
        }
        
        // Test 1: Gọi IDP direct logout
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/direct-logout');
            log_message('debug', 'IDP direct logout response: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            log_message('error', 'IDP direct logout failed: ' . $e->getMessage());
        }
        
        // Test 2: Xóa local session
        if ($token) {
            $sessionModel = new UserSessionModel();
            $deleted = $sessionModel->where('access_token', $token)->delete();
            log_message('debug', 'Local DB session deleted: ' . $deleted);
        }
        
        session()->destroy();
        log_message('debug', 'Local PHP session destroyed');
        
        // Test 3: Xóa cookies
        $sessionName = session_name();
        $domains = ['.amx.vn', 'id.amx.vn', 'amx.vn', 'vinfastanthai.vn', '.vinfastanthai.vn', ''];
        
        foreach ($domains as $domain) {
            setcookie($sessionName, '', time() - 3600, '/', $domain, false, true);
            setcookie($sessionName, '', time() - 3600, '/', $domain, true, true);
        }
        
        log_message('debug', '=== TEST LOGOUT END ===');
        
        return $this->response->setJSON([
            'message' => 'Test logout completed',
            'user_before' => $user,
            'token_found' => $token ? true : false
        ]);
    }

    public function forceLogout()
    {
        log_message('debug', '=== FORCE LOGOUT START ===');
        log_message('debug', 'Force logout method called');
        log_message('debug', 'Request URI: ' . $_SERVER['REQUEST_URI']);
        log_message('debug', 'Session ID: ' . session_id());
        
        // Gọi IDP force logout
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/force-logout');
            log_message('debug', 'IDP force logout response: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            log_message('error', 'IDP force logout failed: ' . $e->getMessage());
        }
        
        // Xóa tất cả sessions trong DB
        $sessionModel = new UserSessionModel();
        $db = \Config\Database::connect();
        $db->table('user_sessions')->emptyTable();
        log_message('debug', 'All DB sessions deleted');
        
        // Xóa PHP session
        session()->destroy();
        log_message('debug', 'PHP session destroyed');
        
        // Xóa tất cả cookies có thể
        $sessionName = session_name();
        $domains = ['.amx.vn', 'id.amx.vn', 'amx.vn', 'vinfastanthai.vn', '.vinfastanthai.vn', ''];
        
        foreach ($domains as $domain) {
            setcookie($sessionName, '', time() - 3600, '/', $domain);
        }
        
        // Xóa các cookie khác có thể liên quan
        $cookiesToDelete = ['PHPSESSID', 'ci_session', 'session_id'];
        foreach ($cookiesToDelete as $cookieName) {
            foreach ($domains as $domain) {
                setcookie($cookieName, '', time() - 3600, '/', $domain);
            }
        }
        
        log_message('debug', 'All cookies deleted');
        
        // Thêm header để ngăn cache
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        log_message('debug', '=== FORCE LOGOUT END ===');
        log_message('debug', 'Redirecting to login2');
        
        return redirect()->to('/admin2/login2')->with('success', 'Đã đăng xuất hoàn toàn');
    }

    public function testLogoutWithIDP()
    {
        log_message('debug', '=== TEST LOGOUT WITH IDP START ===');
        
        $user = session()->get('user');
        log_message('debug', 'User session: ' . json_encode($user));
        
        $results = [];
        
        // Test 1: Check session status at IDP
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/check-session');
            $results['idp_session_check'] = [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()
            ];
            log_message('debug', 'IDP session check: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            $results['idp_session_check'] = ['error' => $e->getMessage()];
            log_message('error', 'IDP session check failed: ' . $e->getMessage());
        }
        
        // Test 2: Test session details at IDP
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/test-session');
            $results['idp_session_details'] = [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()
            ];
            log_message('debug', 'IDP session details: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            $results['idp_session_details'] = ['error' => $e->getMessage()];
            log_message('error', 'IDP session details failed: ' . $e->getMessage());
        }
        
        // Test 3: Perform strong logout at IDP
        $token = null;
        if ($user && isset($user->access_token)) {
            $token = $user->access_token;
        }
        
        try {
            $client = \Config\Services::curlrequest();
            $headers = [];
            if ($token) {
                $headers['Authorization'] = 'Bearer ' . $token;
            }
            $response = $client->post($this->idpUrl . '/auth/strong-logout', ['headers' => $headers]);
            $results['idp_strong_logout'] = [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()
            ];
            log_message('debug', 'IDP strong logout: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            $results['idp_strong_logout'] = ['error' => $e->getMessage()];
            log_message('error', 'IDP strong logout failed: ' . $e->getMessage());
        }
        
        // Test 4: Check session status after logout
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/check-session');
            $results['idp_session_after_logout'] = [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()
            ];
            log_message('debug', 'IDP session after logout: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            $results['idp_session_after_logout'] = ['error' => $e->getMessage()];
            log_message('error', 'IDP session after logout failed: ' . $e->getMessage());
        }
        
        log_message('debug', '=== TEST LOGOUT WITH IDP END ===');
        
        return $this->response->setJSON([
            'message' => 'Test logout with IDP completed',
            'user' => $user,
            'token_found' => $token ? true : false,
            'results' => $results
        ]);
    }

    public function checkAndForceLogout()
    {
        log_message('debug', '=== CHECK AND FORCE LOGOUT START ===');
        
        $user = session()->get('user');
        $localSessionExists = $user !== null;
        
        // Kiểm tra IDP session
        $idpSessionExists = false;
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get($this->idpUrl . '/auth/check-session');
            $idpData = json_decode($response->getBody(), true);
            $idpSessionExists = $idpData['logged_in'] ?? false;
            log_message('debug', 'IDP session check: ' . $response->getStatusCode() . ' - ' . $response->getBody());
        } catch (\Exception $e) {
            log_message('error', 'IDP session check failed: ' . $e->getMessage());
        }
        
        log_message('debug', 'Local session exists: ' . ($localSessionExists ? 'Yes' : 'No'));
        log_message('debug', 'IDP session exists: ' . ($idpSessionExists ? 'Yes' : 'No'));
        
        // Nếu có session local nhưng không có IDP session, hoặc ngược lại
        if ($localSessionExists !== $idpSessionExists) {
            log_message('debug', 'Session mismatch detected, performing force logout');
            
            // Force logout
            $this->forceLogout();
            
            return $this->response->setJSON([
                'message' => 'Session mismatch detected, force logout performed',
                'local_session' => $localSessionExists,
                'idp_session' => $idpSessionExists,
                'action' => 'force_logout'
            ]);
        }
        
        // Nếu cả hai đều có session, kiểm tra token validity
        if ($localSessionExists && $idpSessionExists) {
            $token = $user->access_token ?? null;
            if ($token) {
                try {
                    $client = \Config\Services::curlrequest();
                    $response = $client->get($this->idpUrl . '/auth/userinfo', [
                        'headers' => ['Authorization' => 'Bearer ' . $token]
                    ]);
                    
                    if ($response->getStatusCode() !== 200) {
                        log_message('debug', 'Token invalid, performing force logout');
                        $this->forceLogout();
                        
                        return $this->response->setJSON([
                            'message' => 'Token invalid, force logout performed',
                            'token_status' => 'invalid',
                            'action' => 'force_logout'
                        ]);
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Token validation failed: ' . $e->getMessage());
                }
            }
        }
        
        log_message('debug', '=== CHECK AND FORCE LOGOUT END ===');
        
        return $this->response->setJSON([
            'message' => 'Session check completed',
            'local_session' => $localSessionExists,
            'idp_session' => $idpSessionExists,
            'action' => 'none'
        ]);
    }
}