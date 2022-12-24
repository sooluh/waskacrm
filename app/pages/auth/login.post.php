<?php

$ref = isset($_GET['ref']) ? trim($_GET['ref']) : '';

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$remember = isset($_POST['remember']) ? true : false;

$username = preg_replace('#([\W]+)#', '', $username);
$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);

$error = false;
$check = $db->query("SELECT * FROM `users` WHERE BINARY `login` = '$username'")->fetch_object();

if (empty($username) || empty($password)) {
    $error = 'Nama pengguna dan kata sandi tidak boleh kosong.';
} elseif (strlen($username) < 3) {
    $error = 'Nama pengguna terlalu pendek.';
} elseif (strlen($username) > 32) {
    $error = 'Nama pengguna terlalu panjang.';
} elseif (!$check) {
    $error = 'Nama pengguna tidak dapat ditemukan.';
} elseif (!$check->active) {
    $error = 'Nama pengguna tersebut belum aktif.';
} elseif (!password_verify($password, $check->password)) {
    $error = 'Kata sandi tidak benar.';
}

if ($error) {
    set_flashdata('error', $error);
    go(current_url(false));
}

if ($remember) {
    setcookie('logged', $check->id, time() + (3600 * 720), '/');
} else {
    setcookie('logged', $check->id, time() + 3600, '/');
}

go(rawurldecode($ref));
