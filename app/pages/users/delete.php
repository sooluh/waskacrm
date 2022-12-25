<?php

bouncer(['0', '1']);

$uid = input_get('uid');

if (empty($uid)) {
    set_flashdata('error', 'Pengguna tidak dapat ditemukan.');
    go('users');
}

$rand = substr(md5(mt_rand()), 0, 7);
$delete = $db->query("UPDATE users SET login = '$rand', deleted_at = NOW() WHERE id = '$uid'");

if (!$delete) {
    set_flashdata('error', 'Pengguna gagal dihapus.');
} else {
    set_flashdata('success', 'Pengguna berhasil dihapus.');
}

go('users');
