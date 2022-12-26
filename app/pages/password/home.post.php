<?php

must_login();

$uid = LOGGED;
$password = input_post('password');
$newpass = input_post('newpass');
$repass = input_post('repass');

$error = false;

if (empty($password) || empty($newpass) || empty($repass)) {
    $error = 'Kolom wajib diisi tidak boleh kosong.';
} elseif (!password_verify($password, logged('password'))) {
    $error = 'Kata sandi lama salah.';
} elseif (password_verify($password, $newpass)) {
    $error = 'Kata sandi lama tidak bisa digunakan kembali.';
} elseif ($newpass != $repass) {
    $error = 'Pengulangan kata sandi baru tidak cocok.';
} elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $repass)) {
    $error = 'Kata sandi tidak valid.';
}

if ($error) {
    set_flashdata('error', $error);
    go('password');
}

$password = password_hash($repass, PASSWORD_BCRYPT);
$update = $db->query("UPDATE users SET password = '$password' WHERE id = '$uid'");

if (!$update) {
    set_flashdata('error', 'Kata sandi gagal diperbarui.');
} else {
    set_flashdata('success', 'Kata sandi berhasil diperbarui.');
}

go('password');
