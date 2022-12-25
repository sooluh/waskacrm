<?php

$ref = input_get('ref');

$username = input_post('username');
$password = input_post('password');
$remember = input_post('remember', true, false);

$username = preg_replace('#([\W]+)#', '', $username);
$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);

$error = false;
$check = $db->query("SELECT * FROM users WHERE BINARY login = '$username'")->fetch_object();

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
