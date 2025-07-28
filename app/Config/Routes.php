<?php

use CodeIgniter\Router\RouteCollection;

helper('subdomain'); // đúng tên file: Subdomain_helper.php

/**
 * @var RouteCollection $routes
 */

define('BACKEND_NAMESPACE', 'App\Controllers\B');
define('FRONTEND_NAMESPACE', 'App\Controllers\F');

$routes->set404Override(function () {
    echo view('errors/html/error_404');
});

/// F FOLDER ROUTES ///
require APPPATH . 'Config/Routes/F.php';

/// B FOLDER ROUTES ///
require APPPATH . 'Config/Routes/B.php';

/// API //
require APPPATH . 'Config/Routes/A.php';

/// API ver 2//
$routes->group('api/v2', function ($routes) {
    // Tin tức (News API)
    $routes->get('news', 'A\News::index', ['filter' => 'apiauth']);
});


$username = detect_username_by_domain() ?? 'default';
$routeFile = APPPATH . "Config/Routes/{$username}/F.php";

if (is_file($routeFile)) {
    $fn = require $routeFile;
    if (is_callable($fn)) {
        $fn($routes);
    }
}
