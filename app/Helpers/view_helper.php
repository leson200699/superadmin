<?php
if (!function_exists('view_exists')) {
    function view_exists(string $path): bool
    {
        return is_file(APPPATH . 'Views/' . $path . '.php');
    }
}