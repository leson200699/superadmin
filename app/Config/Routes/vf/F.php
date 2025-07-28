<?php

$routes->group('/', ['namespace' => 'App\Controllers\F'], ['filter' => 'subdomainUser'], function($routes) {
    $routes->get('car-detail', 'vf\Home::index');
    $routes->get('dat-lich-dich-vu', 'vf\Home::service');
    $routes->get('tra-gop', 'vf\Home::tragop');
    $routes->get('vf-news', 'vf\Home::news');
    $routes->get('news-detail', 'vf\Home::newsdetail');

});
