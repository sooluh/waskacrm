<?php

must_login();

$uid = input_get('uid');
$contact = $db->query("SELECT * FROM contacts WHERE id = '$uid' AND deleted_at IS NULL")->fetch_object();

if (empty($uid) || empty($contact)) {
    set_flashdata('error', 'Contact tidak dapat ditemukan.');
    go('contacts');
}

$salutation = input_post('salutation') ?: 'NULL';
$first_name = input_post('first_name');
$last_name = input_post('last_name');
$account = input_post('account') ?: 'NULL';
$title = input_post('title');
$email = input_post('email');
$phone_type = input_post('phone_type') ?: 'NULL';
$phone_number = input_post('phone_number');
$description = input_post('description');

$street = input_post('street');
$city = input_post('city');
$state = input_post('state');
$zip = input_post('zip');
$country = input_post('country');

$assigned = input_post('assigned') ?: 'NULL';
$role = input_post('role') ?: 'NULL';
$enhancer = LOGGED;

$error = false;

if (empty($first_name) || empty($last_name)) {
    $error = 'Kolom wajib diisi tidak boleh kosong.';
} elseif ($salutation !== 'NULL' && !in_array($salutation, array_keys(salutation()))) {
    $error = 'Panggilan nama tidak valid.';
} elseif (strlen($first_name) > 255 || strlen($last_name) > 255) {
    $error = 'Nama tidak boleh melebihi 255 karakter.';
} elseif (strlen($title) > 64) {
    $error = 'Jabatan tidak boleh melebihi 64 karakter.';
} elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Alamat surel tidak valid.';
} elseif (!empty($email) && strlen($email) > 320) {
    $error = 'Alamat surel tidak boleh melebihi 320 karakter.';
} elseif (!in_array($phone_type, array_keys(phone_type()))) {
    $error = 'Tipe nomor telepon tidak valid.';
} elseif (!empty($phone_number) && (!is_numeric($phone_number) || strlen($phone_number) > 14)) {
    $error = 'Nomor telepon tidak valid.';
} elseif (strlen($city) > 64) {
    $serror = 'Kota alamat tidak boleh melebihi 64 karakter.';
} elseif (strlen($state) > 64) {
    $serror = 'Provinsi alamat tidak boleh melebihi 64 karakter.';
} elseif (strlen($zip) > 16) {
    $error = 'Kode pos alamat tidak boleh melebihi 16 karakter.';
} elseif (strlen($country) > 128) {
    $error = 'Kode pos alamat tidak boleh melebihi 128 karakter.';
}

if ($error) {
    set_flashdata('error', $error);
    go(current_url(true));
}

if (!access_granted(['0', '1'])) {
    $assigned = LOGGED;
    $role = logged('role');
}

$insert = $db->query(
    "UPDATE contacts SET salutation = $salutation, first_name = '$first_name', " .
        "last_name = '$last_name', account = $account, title = '$title', " .
        "email = '$email', phone_type = $phone_type, phone_number = '$phone_number', " .
        "street = '$street', city = '$city', state = '$state', zip = '$zip', " .
        "country = '$country', description = '$description', assigned = $assigned, " .
        "role = $role, enhancer = '$enhancer' WHERE id = '$uid'"
);

if (!$insert) {
    set_flashdata('error', 'Contact gagal diperbarui.');
} else {
    set_flashdata('success', 'Contact berhasil diperbarui.');
}

go('contacts');
