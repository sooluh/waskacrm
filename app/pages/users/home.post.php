<?php

must_login();

$draw = isset($_POST['draw']) ? intval($_POST['draw']) : null;
if ($draw === null) {
    die('Ini bukan permintaan datatable.');
}

$columns = ['login', 'name', 'email', 'phone', 'gender', 'role', 'active', 'created_at'];

$from = $db->query("SELECT COUNT(`id`) AS `total` FROM `users` WHERE `deleted_at` IS NULL");
$count = $from->fetch_object();
$total = $filtered = $count->total;

$limit = isset($_POST['length']) ? $_POST['length'] : 10;
$start = isset($_POST['start']) ? $_POST['start'] : 1;
$order = isset($_POST['order']['0']['column']) ? $columns[$_POST['order']['0']['column']] : 'id';
$dir = isset($_POST['order']['0']['dir']) ? strtoupper($_POST['order']['0']['dir']) : 'DESC';

if (isset($_POST['search']['value'])) {
    $search = $_POST['search']['value'];
    $query = $db->query(
        "SELECT `id`, `name`, `login`, `email`, `phone`, `gender`, `role`, `active`, `created_at` " .
            "FROM `users` WHERE (`login` LIKE '%$search%' OR `name` LIKE '%$search%' OR " .
            "`email` LIKE '%$search%' OR `phone` LIKE '%$search%') AND `deleted_at` IS NULL " .
            "ORDER BY `$order` $dir LIMIT $limit OFFSET $start"
    );
    $from = $db->query(
        "SELECT COUNT(`id`) AS `total` FROM `users` WHERE (`login` LIKE '%$search%' OR " .
            "`name` LIKE '%$search%' OR `email` LIKE '%$search%' OR `phone` LIKE '%$search%') " .
            "AND `deleted_at` IS NULL"
    );

    $count = $from->fetch_object();
    $filtered = $count->total;
} else {
    $query = $db->query(
        "SELECT `id`, `name`, `login`, `email`, `phone`, `gender`, `role`, `active`, `created_at` " .
            "FROM `users` WHERE `deleted_at` IS NULL " .
            "ORDER BY `$order` $dir LIMIT $limit OFFSET $offset"
    );
}

$data = [];

if (!empty($query)) {
    $num = $start + 1;
    helper('custom');

    while ($row = $query->fetch_object()) {
        array_push($data, [
            'num' => $num,
            'id' => $row->id,
            'name' => $row->name,
            'login' => $row->login,
            'email' => $row->email,
            // TODO: formatting phone number
            'phone' => preg_replace('/^62/', '0', $row->phone) ?: 'Tidak Ada',
            'value_phone' => $row->phone,
            'gender' => $row->gender === 'M' ? 'Laki-laki' : 'Perempuan',
            'value_gender' => $row->gender,
            'role' => role($row->role),
            'value_role' => $row->role,
            'active' => $row->active ? 'Aktif' : 'Belum Aktif',
            'value_active' => $row->active ? 'true' : 'false',
            'created_at' => datenow(strtotime($row->created_at)),
            'disabled' => 'login',
        ]);
        $num++;
    }
}

$json = [
    'draw' => $draw,
    'recordsTotal' => intval($total),
    'recordsFiltered' => intval($filtered),
    'data' => $data,
];

return response_json($json);
