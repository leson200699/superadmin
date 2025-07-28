<?php
namespace App\Libraries;

class TenantResolverService
{
    protected static $tenant;

    public static function resolve(): ?object
    {
        if (self::$tenant) return self::$tenant;

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $db = db_connect();

        if (preg_match('/^([a-z0-9\-]+)\.amx\.vn$/', $host, $matches)) {
            $subdomain = $matches[1];
            self::$tenant = $db->table('tenants')->where('subdomain', $subdomain)->get()->getRow();
        } else {
            // custom domain
            self::$tenant = $db->table('tenants')->where('custom_domain', $host)->get()->getRow();
        }

        return self::$tenant;
    }

    public static function getUsername(): ?string
    {
        return self::resolve()->username ?? null;
    }
}

