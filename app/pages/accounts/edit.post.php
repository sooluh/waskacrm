<?php

must_login();

$uid = input_get('uid');
$account = $db->query("SELECT * FROM accounts WHERE id = '$uid' AND deleted_at IS NULL")->fetch_object();

if (empty($uid) || empty($account)) {
    set_flashdata('error', 'Account tidak dapat ditemukan.');
    go('accounts');
}

$name = input_post('name');
$website = input_post('website');
$email = input_post('email');
$phone_type = input_post('phone_type') ?: 'NULL';
$phone_number = input_post('phone_number');

$billing_street = input_post('billing_street');
$billing_city = input_post('billing_city');
$billing_state = input_post('billing_state');
$billing_zip = input_post('billing_zip');
$billing_country = input_post('billing_country');

$shipping_street = input_post('shipping_street');
$shipping_city = input_post('shipping_city');
$shipping_state = input_post('shipping_state');
$shipping_zip = input_post('shipping_zip');
$shipping_country = input_post('shipping_country');

$type = input_post('type') ?: 'NULL';
$industry = input_post('industry') ?: 'NULL';
$description = input_post('description');

$assigned = input_post('assigned') ?: 'NULL';
$role = input_post('role') ?: 'NULL';
$enhancer = LOGGED;

$error = false;

if (empty($name)) {
    $error = 'Kolom wajib diisi tidak boleh kosong.';
} elseif (strlen($name) > 255) {
    $error = 'Nama tidak boleh melebihi 255 karakter.';
} elseif (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
    $error = 'Tautan website tidak valid.';
} elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Alamat surel tidak valid.';
} elseif (!empty($email) && strlen($email) > 320) {
    $error = 'Alamat surel tidak boleh melebihi 320 karakter.';
} elseif (!in_array($phone_type, array_keys(phone_type()))) {
    $error = 'Tipe nomor telepon tidak valid.';
} elseif (!empty($phone_number) && (!is_numeric($phone_number) || strlen($phone_number) > 14)) {
    $error = 'Nomor telepon tidak valid.';
} elseif (strlen($billing_city) > 64) {
    $serror = 'Kota alamat tagihan tidak boleh melebihi 64 karakter.';
} elseif (strlen($billing_state) > 64) {
    $serror = 'Provinsi alamat tagihan tidak boleh melebihi 64 karakter.';
} elseif (strlen($billing_zip) > 16) {
    $error = 'Kode pos alamat tagihan tidak boleh melebihi 16 karakter.';
} elseif (strlen($billing_country) > 128) {
    $error = 'Kode pos alamat tagihan tidak boleh melebihi 128 karakter.';
} elseif (strlen($shipping_city) > 64) {
    $serror = 'Kota alamat pengiriman tidak boleh melebihi 64 karakter.';
} elseif (strlen($shipping_state) > 64) {
    $serror = 'Provinsi alamat pengiriman tidak boleh melebihi 64 karakter.';
} elseif (strlen($shipping_zip) > 16) {
    $error = 'Kode pos alamat pengiriman tidak boleh melebihi 16 karakter.';
} elseif (strlen($shipping_country) > 128) {
    $error = 'Kode pos alamat pengiriman tidak boleh melebihi 128 karakter.';
} elseif ($type != 'NULL' && !in_array($type, array_keys(account_type()))) {
    $error = 'Tipe account tidak valid.';
} elseif ($industry != 'NULL' && !in_array($industry, array_keys(industry_type()))) {
    $error = 'Industri tidak valid.';
}

if ($error) {
    set_flashdata('error', $error);
    go(current_url(true));
}

if (!access_granted(['0', '1'])) {
    $assigned = LOGGED;
    $role = logged('role');
}

$update = $db->query(
    "UPDATE accounts SET name = '$name', website = '$website', email = '$email', " .
        "phone_type = $phone_type, phone_number = '$phone_number', " .
        "billing_street = '$billing_street', billing_city = '$billing_city', " .
        "billing_state = '$billing_state', billing_zip = '$billing_zip', " .
        "billing_country = '$billing_country', shipping_street = '$shipping_street', " .
        "shipping_city = '$shipping_city', shipping_state = '$shipping_state', " .
        "shipping_zip = '$shipping_zip', shipping_country = '$shipping_country', " .
        "type = $type, industry = $industry, description = '$description', " .
        "assigned = $assigned, role = $role, enhancer = '$enhancer' WHERE id = '$uid'"
);

if (!$update) {
    set_flashdata('error', 'Account gagal diperbarui.');
} else {
    set_flashdata('success', 'Account berhasil diperbarui.');
}

go('accounts');
