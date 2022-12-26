<?php

spl_autoload_register(function ($class) {
    include_once "./app/libraries/$class.class.php";
});

define('LOGGED', isset($_COOKIE['logged']) ? $_COOKIE['logged'] : false);

if (APP_PRODUCTION) {
    @error_reporting(E_ALL ^ E_NOTICE);
    @ini_set('display_errors', false);
    @ini_set('html_errors', false);
    @ini_set('error_reporting', E_ALL ^ E_NOTICE);
} else {
    @error_reporting(E_ALL);
    @ini_set('display_errors', true);
    @ini_set('html_errors', true);
    @ini_set('error_reporting', E_ALL);
    @mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}

if (!function_exists('render')) {
    function render($name)
    {
        include "./app/pages/$name.php";
    }
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

if (!function_exists('logged')) {
    function logged($key = '')
    {
        if (!LOGGED) return null;

        global $db;

        $userdata = Waska::retrieve('userdata');
        if (empty($userdata)) {
            $uid = LOGGED;

            $userdata = $db
                ->query("SELECT * FROM users WHERE id = '$uid' AND deleted_at IS NULL")
                ->fetch_object();

            if (!$userdata) go('auth/logout');

            Waska::store('userdata', $userdata);
        }

        return $key == '' ? $userdata : ($userdata->{$key} ?? '');
    }
}

if (!function_exists('role')) {
    function role($id = '')
    {
        $roles = ['Developer', 'Admin', 'Sales Department', 'Support', 'Top Management'];
        return $id == '' ? $roles : ($roles[$id] ?? 'Unknown');
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

if (!function_exists('access_granted')) {
    function access_granted($role = [])
    {
        $roleid = logged('role');
        if (count($role) <= 0 || (is_array($role) && in_array($roleid, $role))) return true;
        return $role == $roleid ? true : false;
    }
}

if (!function_exists('bouncer')) {
    function bouncer($permission = [])
    {
        must_login();

        if (!access_granted($permission)) {
            go('403');
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

if (!function_exists('set_flashdata')) {
    function set_flashdata($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
        return true;
    }
}

if (!function_exists('input_post')) {
    function input_post($key, $true = null, $false = '')
    {
        return isset($_POST[$key]) ? ($true ?? trim($_POST[$key])) : $false;
    }
}

if (!function_exists('input_get')) {
    function input_get($key)
    {
        return isset($_GET[$key]) ? trim($_GET[$key]) : '';
    }
}

if (!function_exists('title')) {
    function title($page = '')
    {
        $page = trim($page);
        return !empty($page) ? ($page . ' - ' . APP_NAME) : APP_NAME;
    }
}

if (!function_exists('sidebar')) {
    function sidebar()
    {
        include_once './app/config/sidebar.php';

        $sidebars = [];
        foreach (json_decode(json_encode($menus)) as $menu) {
            $item = [];

            if ((property_exists($menu, 'permission')
                    && property_exists($menu, 'children') == false)
                || (property_exists($menu, 'permission') == false
                    && property_exists($menu, 'children') == false)
            ) {
                $item = [
                    'title' => $menu->title,
                    'icon' => $menu->icon,
                    'link' => base_url($menu->link),
                    'permission' => $menu->permission ?? [],
                ];
            }

            if (property_exists($menu, 'children')) {
                $parent = [
                    'title' => $menu->title,
                    'icon' => $menu->icon,
                    'link' => 'javascript:void(0)',
                    'permission' => $menu->permission ?? [],
                ];

                foreach ($menu->children as $children) {
                    $child = [
                        'title' => $children->title,
                        'link' => base_url($children->link),
                        'permission' => $children->permission ?? [],
                    ];
                    $parent['children'][] = $child;
                }

                if (array_key_exists('children', $parent)) {
                    $item = $parent;
                }
            }

            $sidebars[] = $item;
        }

        return json_decode(json_encode($sidebars));
    }
}

if (!function_exists('response_json')) {
    function response_json($data = [])
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}

if (!function_exists('html_minifier')) {
    function html_minifier($buffer)
    {
        if (!APP_PRODUCTION) return $buffer;
        if (strpos($buffer, '<!DOCTYPE html>') == false) return $buffer;

        $replace = [
            '/\t(\s+)?/' => '',
            '/\n(\s+)?/' => '',
            '/\>[^\S ]+/s' => '>',
            '/[^\S ]+\</s' => '<',
            '/(\s)+/s' => '\\1',
            '/<!--(.|\s)*?-->/' => '',
            '/\>\s+\</s' => '><',
            '/\<script type="text\/javascript"\>\<\/script\>/s' => '',
            '/\s+type="text\/javascript"/s' => '',
            '/\s+\</s' => '<',
            '/\s+\=\s+/s' => '=',
            '/\:\s+(\'|\"|\[)/s' => ':$1',
            '/\},\s+\{/s' => '},{',
        ];

        return trim(preg_replace(
            array_keys($replace),
            array_values($replace),
            $buffer
        ));
    }
}
