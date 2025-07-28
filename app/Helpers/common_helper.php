<?php

if (!function_exists('view_exists')) {
    function view_exists(string $viewPath): bool
    {
        return file_exists(APPPATH . 'Views/' . str_replace('/', DIRECTORY_SEPARATOR, $viewPath) . '.php');
    }
}
