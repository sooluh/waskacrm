<?php

must_login();

$uid = input_get('uid');

if (empty($uid)) {
    set_flashdata('error', 'Account tidak dapat ditemukan.');
    go('contacts');
}

$delete = $db->query("UPDATE contacts SET deleted_at = NOW() WHERE id = '$uid'");

if (!$delete) {
    set_flashdata('error', 'Account gagal dihapus.');
} else {
    set_flashdata('success', 'Account berhasil dihapus.');
}

go('contacts');
