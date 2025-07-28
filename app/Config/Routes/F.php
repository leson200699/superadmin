<?php

$routes->group('/', ['namespace' => 'App\Controllers\F'], ['filter' => 'subdomainUser'], function($routes) {
    $routes->get('', 'Home::index');
    $routes->get('abouts', 'About::index');
    $routes->get('services', 'Service::index');
    $routes->get('services/(:segment)', 'Service::detail/$1');
    $routes->get('services-category/(:segment)', 'Service::category/$1');

    $routes->get('projects', 'Project::index');
    $routes->get('projects/(:segment)', 'Project::detail/$1');
    $routes->get('news', 'News::index');
    $routes->get('news/(:segment)', 'News::detail/$1');
    $routes->get('news-category/(:segment)', 'News::category/$1');
    $routes->get('contacts', 'Contact::index');
    $routes->post('contacts/submit', 'Contact::submit');
    $routes->get('products', 'Product::index');
    $routes->get('products/(:segment)', 'Product::detail/$1');
    $routes->get('products-category/(:segment)', 'Product::category/$1');
    $routes->get('custom/(:segment)', 'Custom::detail/$1');
    $routes->get('tours/(:segment)', 'Tour::detail/$1');
    $routes->get('tours-type/(:segment)', 'Tour::categories/$1');
    $routes->get('tours-cate/(:segment)', 'Tour::category/$1');
    $routes->get('download', 'Download::index');

    $routes->get('car', 'Car::index');
    $routes->get('car/(:segment)', 'Car::detail/$1');
    $routes->get('car-form/test-drive', 'CarForm::test_drive');
    $routes->get('car-form/service-appointment', 'CarForm::service_appointment');
    $routes->get('car-form/quote-request', 'CarForm::quote_request');
    $routes->post('car-form/submit', 'CarForm::submit');

    $routes->get('thank-you', 'Contact::thank_you');
});
