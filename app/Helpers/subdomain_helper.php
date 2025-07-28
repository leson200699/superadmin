<?php

use Config\Services;
use Config\Database;

if (!function_exists('detect_username_by_domain')) {
    function detect_username_by_domain(): ?string
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host = preg_replace('/:\d+$/', '', $host);

        $mainDomains = ['localhost', 'admin.amx.vn', 'www.admin.amx.vn'];
        if (in_array($host, $mainDomains) || strpos($host, '.') === false) {
            return null;
        }

        $cache = Services::cache();
        $cacheKey = 'domain-map-' . $host;
        $cached = $cache->get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $db = Database::connect();

        // Trường hợp subdomain: vf.amx.vn → lấy theo cột `subdomain`
        if (preg_match('/^([a-z0-9\\-]+)\\.amx\\.vn$/', $host, $matches)) {
            $subdomain = $matches[1];

            $row = $db->table('tenants')
                      ->select('username')
                      ->where('subdomain', $subdomain)
                      ->get()->getRow();

            if ($row && !empty($row->username)) {
                $cache->save($cacheKey, $row->username, 300);
                return $row->username;
            }

            return null;
        }

        // Trường hợp custom domain: vinfastanthai.vn → lấy theo cột `custom_domain`
        $row = $db->table('tenants')
                  ->select('username')
                  ->where('custom_domain', $host)
                  ->get()->getRow();

        if ($row && !empty($row->username)) {
            $cache->save($cacheKey, $row->username, 300);
            return $row->username;
        }

        return null;
    }
}

