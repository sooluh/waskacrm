<?php

must_login();

$uid = isset($_GET['uid']) ? trim($_GET['uid']) : '';

if (empty($uid)) {
    set_flashdata('error', 'Pengguna tidak dapat ditemukan.');
    go('users');
}

$delete = $db->query("UPDATE `users` SET `deleted_at` = NOW() WHERE `id` = '$uid'");

if (!$delete) {
    set_flashdata('error', 'Pengguna gagal dihapus.');
} else {
    set_flashdata('success', 'Pengguna berhasil dihapus.');
}

go('users');
