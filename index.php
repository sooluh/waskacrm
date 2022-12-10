<?php

session_start();
date_default_timezone_set('Asia/Jakarta');

ob_start();

include_once './app/config/app.php';
include_once './app/config/database.php';
include_once './app/helper/global.php';

$page = isset($_GET['page']) ? trim($_GET['page']) : '';
$sub = isset($_GET['sub']) ? trim($_GET['sub']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page .= '.post';
}

if ($sub) {
    $file = "./app/pages/$sub/$page.php";
} else {
    $file = "./app/pages/$page.php";
}

if (file_exists($file)) {
    include_once $file;
} else {
    include_once './error.php';
}

unset($_SESSION['flash']);
