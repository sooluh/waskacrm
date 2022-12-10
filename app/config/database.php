<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'waska_crm');

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($db->errno) {
    die('Koneksi ke database gagal!');
}
