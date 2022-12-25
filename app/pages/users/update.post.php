<?php

must_login();

$uid = isset($_GET['uid']) ? trim($_GET['uid']) : '';
$user = $db->query("SELECT * FROM users WHERE id = '$uid' AND deleted_at IS NULL")->fetch_object();

if (empty($uid) || empty($user)) {
    set_flashdata('error', 'Pengguna tidak dapat ditemukan.');
    go('users');
}

$login = isset($_POST['login']) ? trim($_POST['login']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$role = isset($_POST['role']) ? trim($_POST['role']) : '';
$active = isset($_POST['active']) ? 'TRUE' : 'FALSE';

$error = false;
$unique = $db->query("SELECT id FROM users WHERE login = '$login' AND id != '$uid'")->num_rows;

if (empty($login) || empty($name) || empty($gender) || empty($role)) {
    $error = 'Kolom wajib diisi tidak boleh kosong.';
} elseif (strlen($login) < 5) {
    $error = 'Nama pengguna minimal memiliki 5 karakter.';
} elseif (strlen($login) > 32) {
    $error = 'Nama pengguna tidak boleh melebihi 32 karakter.';
} elseif (!preg_match('/^\w{5,}$/', $login)) {
    $error = 'Nama pengguna tidak valid.';
} elseif ($unique > 0) {
    $error = 'Nama pengguna sudah digunakan.';
} elseif (strlen($name) <= 5) {
    $error = 'Nama minimal memiliki 5 karakter.';
} elseif (strlen($name) > 255) {
    $error = 'Nama tidak boleh melebihi 255 karakter.';
} elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Alamat surel tidak valid.';
} elseif (!empty($email) && strlen($email) > 320) {
    $error = 'Alamat surel tidak boleh melebihi 320 karakter.';
} elseif (!in_array($gender, ['M', 'F'])) {
    $error = 'Pilihan gender tidak valid.';
} elseif (!in_array(($role - 1), array_keys(role()))) {
    $error = 'Pilihan peran tidak valid.';
}

if ($error) {
    set_flashdata('error', $error);
    go('users');
}

$email = $email ?: 'NULL';

$update = $db->query(
    "UPDATE users SET login = '$login', name = '$name', email = '$email', " .
        "gender = '$gender', role = $role, active = $active WHERE id = '$uid'"
);

if (!$update) {
    set_flashdata('error', 'Pengguna gagal diperbarui.');
} else {
    set_flashdata('success', 'Pengguna berhasil diperbarui.');
}

go('users');
