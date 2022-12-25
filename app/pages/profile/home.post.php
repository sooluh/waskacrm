<?php

must_login();

$uid = LOGGED;
$name = input_post('name');
$email = input_post('email');
$gender = input_post('gender');

$error = false;

if (empty($name) || empty($email) || empty($gender)) {
    $error = 'Kolom wajib diisi tidak boleh kosong.';
} elseif (strlen($name) <= 5) {
    $error = 'Nama minimal memiliki 5 karakter.';
} elseif (strlen($name) > 255) {
    $error = 'Nama tidak boleh melebihi 255 karakter.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Alamat surel tidak valid.';
} elseif (strlen($email) > 320) {
    $error = 'Alamat surel tidak boleh melebihi 320 karakter.';
} elseif (!in_array($gender, ['M', 'F'])) {
    $error = 'Pilihan gender tidak valid.';
}

if ($error) {
    set_flashdata('error', $error);
    go('profile');
}

$update = $db->query(
    "UPDATE users SET name = '$name', email = '$email', gender = '$gender' WHERE id = '$uid'"
);

if (!$update) {
    set_flashdata('error', 'Profil gagal diperbarui.');
} else {
    set_flashdata('success', 'Profil berhasil diperbarui.');
}

go('profile');
