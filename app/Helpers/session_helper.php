<?php

//set session data
if (!function_exists('set_session_data')) {
    function set_session_data($session_key, $session_value)
    {
        $session = \Config\Services::session();
        $session->set($session_key, $session_value);
    }
}

//get session data by session key
if (!function_exists('get_session_data')) {
    function get_session_data($session_key)
    {
        $session = \Config\Services::session();
        return $session->get($session_key);
    }
}

//push  session data to session array
if (!function_exists('push_session_data')) {
    function push_session_data($session_key, $array_data)
    {
        $session = \Config\Services::session();
        $session->push($session_key, $array_data);
    }
}

//remove session data by session key
if (!function_exists('remove_session_data')) {
    function remove_session_data($session_key)
    {
        $session = \Config\Services::session();
        $session->remove($session_key);
    }
}

//check session data by session key
if (!function_exists('check_session_data_exist')) {
    function check_session_data_exist($session_key)
    {
        $session = \Config\Services::session();

        if ($session->has($session_key)) {
            return true;
        } else {
            return false;
        }
    }
}

//huy session
if (!function_exists('destroy_session')) {
    function destroy_session()
    {
        $session = \Config\Services::session();
        return  $session->destroy();
    }
}

/**
 * Lấy user data một cách an toàn, hỗ trợ cả array và object
 */
function get_user_data($key = null, $default = null) {
    $user = get_session_data('user');
    
    if (empty($user)) {
        return $default;
    }
    
    if ($key === null) {
        return $user;
    }
    
    if (is_array($user)) {
        return $user[$key] ?? $default;
    } else {
        return $user->$key ?? $default;
    }
}

/**
 * Lấy role của user một cách an toàn
 */
function get_user_role($default = 0) {
    return get_user_data('role', $default);
}

/**
 * Lấy is_admin của user một cách an toàn
 */
function get_user_is_admin($default = 0) {
    return get_user_data('is_admin', $default);
}
