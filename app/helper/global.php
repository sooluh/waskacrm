<?php

define('LOGGED', isset($_COOKIE['logged']) ? $_COOKIE['logged'] : false);

if (APP_DEBUG) {
    @error_reporting(E_ALL);
    @ini_set('display_errors', true);
    @ini_set('html_errors', true);
    @ini_set('error_reporting', E_ALL);
} else {
    @error_reporting(E_ALL ^ E_NOTICE);
    @ini_set('display_errors', false);
    @ini_set('html_errors', false);
    @ini_set('error_reporting', E_ALL ^ E_NOTICE);
}

if (!function_exists('base_url')) {
    function base_url($segment = '')
    {
        $segment = trim($segment);
        return APP_URL . (!preg_match('/^\//i', $segment) ? "/$segment" : $segment);
    }
}

if (!function_exists('current_url')) {
    function current_url($withHost = true)
    {
        $path = parse_url(APP_URL)['path'];
        $uri =  str_replace($path, '', $_SERVER['REQUEST_URI']);
        return $withHost ? base_url($uri) : $uri;
    }
}

if (!function_exists('go')) {
    function go($url)
    {
        $parse = parse_url($url);
        $url = isset($parse['host']) ? $url : base_url($url);

        header('Location: ' . $url);
        exit();
    }
}

if (!function_exists('title')) {
    function title($page = '')
    {
        $page = trim($page);
        $title = APP_NAME;

        if (!empty($page)) {
            $title = $page . ' - ' . $title;
        }

        return $title;
    }
}

if (!function_exists('must_login')) {
    function must_login($inverse = false)
    {
        if (!LOGGED && !$inverse) {
            $ref = rawurlencode(current_url(false));
            go(APP_URL . '/auth/login?ref=' . $ref);
        }

        if (LOGGED && $inverse) {
            $ref = isset($_GET['ref']) ? trim($_GET['ref']) : '%2F';
            go(rawurldecode($ref));
        }
    }
}

if (!function_exists('flashdata')) {
    function flashdata($key = null)
    {
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
        return $key ? (isset($flash[$key]) ? $flash[$key] : null) : $flash;
    }
}
