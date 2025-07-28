<?php

$currentHost = $_SERVER['HTTP_HOST'] ?? '';
$currentUri  = $_SERVER['REQUEST_URI'] ?? '';
$clientIp    = $_SERVER['REMOTE_ADDR'] ?? '';

error_reporting(E_ALL);
ini_set('display_errors', '1');

$allowedIps = [
    '127.0.0.1',
    '::1',
    '192.168.',
    '10.',
];

$isAllowedIp = false;
foreach ($allowedIps as $allowed) {
    if (str_starts_with($clientIp, $allowed)) {
        $isAllowedIp = true;
        break;
    }
}

// Kiểm tra tên miền admin
$isAdminDomain = in_array($currentHost, ['admin.amx.vn']);

// Comment out the following lines to disable the debug toolbar icon
// if ($isAllowedIp && $isAdminDomain) {
//     \CodeIgniter\Debug\Toolbar\Toolbar::respond();
// }

defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', true);
defined('CI_DEBUG') || define('CI_DEBUG', true);
