<?php

header_remove('X-Powered-By');
date_default_timezone_set('Asia/Jakarta');

session_name('waska');
session_start();

include_once './app/config/app.php';
include_once './app/config/database.php';
include_once './app/helper/global.php';

ob_start('html_minifier');

$page = isset($_GET['page']) ? trim($_GET['page']) : '';
$sub = isset($_GET['sub']) ? trim($_GET['sub']) : '';

if ($sub) {
    $file = "./app/pages/$sub/$page.php";
} else {
    $file = "./app/pages/$page.php";
    $subfile = "./app/pages/$page/home.php";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = preg_replace('/.php$/', '.post.php', $file);

    if (!empty($subfile)) {
        $subfile = preg_replace('/.php$/', '.post.php', $subfile);
    }
}

if (file_exists($file)) {
    include_once $file;
} elseif (!empty($subfile) && file_exists($subfile)) {
    include_once $subfile;
} else {
    http_response_code(404);
    include_once './error.php';
}

unset($_SESSION['flash']);
