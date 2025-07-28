<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use Jumbojett\OpenIDConnectClient;

class Auth extends BaseController
{
    public function login()
    {
        log_message('debug', '=== SSO LOGIN START ===');
        try {
            log_message('debug', 'Creating OpenIDConnectClient...');
            $oidc = new OpenIDConnectClient(
                'https://id.amx.vn',
                'superadmin',
                'test1234'
            );

            // Thử với URI khác để xem có phải vấn đề URI không
            $redirectUrl = base_url('admin/auth0/callback');
            log_message('debug', 'Setting redirect URL: ' . $redirectUrl);
            $oidc->setRedirectURL($redirectUrl);
            $oidc->addScope(['openid', 'profile', 'email']);
            
            log_message('debug', 'Starting authentication...');
            $oidc->authenticate();
            log_message('debug', 'Authentication completed successfully');
        } catch (\Exception $e) {
            log_message('error', 'SSO login error: ' . $e->getMessage());
            log_message('error', 'SSO login error trace: ' . $e->getTraceAsString());
            return redirect()->route('admin-auth-login')->with('error', 'SSO login error: ' . $e->getMessage());
        }
    }

public function callback()
{
    log_message('debug', '=== SSO CALLBACK START ===');
    try {
        $oidc = new OpenIDConnectClient(
            'https://id.amx.vn',
            'superadmin',
            'test1234'
        );

        $oidc->setRedirectURL(base_url('admin/auth0/callback'));
        $oidc->addScope(['openid', 'profile', 'email']);

        $oidc->authenticate();

        // ✅ Lấy access token
        $token = $oidc->getAccessToken();
        log_message('debug', 'SSO access token: ' . $token);

        // ✅ Gọi thủ công tới userfullinfo
        $ch = curl_init('https://id.amx.vn/oidc/userfullinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $userData = json_decode($response, true);

        if (!is_array($userData) || isset($userData['error'])) {
            log_message('error', 'Invalid userfullinfo response: ' . $response);
            return redirect()->route('admin-auth-login')->with('error', 'Không lấy được thông tin người dùng SSO.');
        }

        // ✅ Gỡ bỏ các trường nhạy cảm nếu có
        $sensitive = ['password', 'token', 'password_reset_code'];
        $userSessionData = array_diff_key($userData, array_flip($sensitive));

        $userSessionData['auth_method'] = 'sso';
        $userSessionData['is_sso'] = true;

        if (isset($userSessionData['role'])) {
            $userSessionData['role'] = (int)$userSessionData['role'];
        }
        if (isset($userSessionData['is_admin'])) {
            $userSessionData['is_admin'] = (int)$userSessionData['is_admin'];
        }

        // ✅ Lưu session
        helper('session_helper');
        set_session_data('user', $userSessionData);

        // =============================================
        // ✅ GHI HOẶC CẬP NHẬT TENANT DỰA TRÊN OIDC ID
        // =============================================
        $db = db_connect();

        $oidcId       = (int) ($userData['id'] ?? 0);
        $username     = $userData['username'] ?? null;
        $tenantName   = trim(($userData['firstname'] ?? '') . ' ' . ($userData['lastname'] ?? ''));
        $customDomain = trim($userData['domain'] ?? '');
        $customDomain = $customDomain !== '' ? $customDomain : null;

        $subdomain    = $username;

        if ($oidcId > 0 && $username) {
            $existing = $db->table('tenants')->where('id', $oidcId)->get()->getRow();

            if (!$existing) {
                $db->table('tenants')->insert([
                    'id'            => $oidcId,
                    'subdomain'     => $subdomain,
                    'custom_domain' => $customDomain,
                    'username'      => $username,
                    'tenant_name'   => $tenantName ?: $username,
                ]);
            } else {
                $db->table('tenants')->where('id', $oidcId)->update([
                    'subdomain'     => $subdomain,
                    'custom_domain' => $customDomain,
                    'username'      => $username,
                    'tenant_name'   => $tenantName ?: $username,
                ]);
            }
        }

        log_message('debug', 'SSO userSessionData FINAL: ' . print_r($userSessionData, true));
        log_message('debug', '=== SSO CALLBACK END ===');

        return redirect()->route('dashboard')->with('success', 'Đăng nhập SSO thành công!');
    } catch (\Exception $e) {
        log_message('error', 'Auth0 callback error: ' . $e->getMessage());
        log_message('error', 'Auth0 callback error trace: ' . $e->getTraceAsString());
        return redirect()->route('admin-auth-login')->with('error', 'SSO callback error: ' . $e->getMessage());
    }
}



    public function logout()
    {
        try {
            $idToken = session('id_token') ?? null;
            $postLogoutRedirectUri = base_url('admin/auth/login'); // Redirect về trang login nội bộ

            $logoutUrl = 'https://id.amx.vn/oidc/logout';
            $params = [];

            if ($idToken) {
                $params[] = 'id_token_hint=' . urlencode($idToken);
            }

            $params[] = 'post_logout_redirect_uri=' . urlencode($postLogoutRedirectUri);

            $logoutUrl .= '?' . implode('&', $params);

            // Xóa session trước khi redirect
            session()->destroy();

            // Tránh dùng redirect()->to(...) vì sẽ bị CI4 kiểm tra URI
            header('Location: ' . $logoutUrl);
            exit;
            
        } catch (\Exception $e) {
            log_message('error', 'Auth0 logout error: ' . $e->getMessage());
            session()->destroy();
            return redirect()->route('admin-auth-login')->with('success', 'Đã đăng xuất');
        }
    }
}