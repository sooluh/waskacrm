<?php

bouncer(['0', '1']);

$draw = input_post('draw');
if (empty($draw)) {
    die('Ini bukan permintaan datatable.');
}

$logged = LOGGED;
$columns = ['id', 'name', 'login', 'role', 'active', 'created_at'];

$from = $db->query("SELECT COUNT(id) AS total FROM users WHERE id != '$logged' AND deleted_at IS NULL");
$count = $from->fetch_object();
$total = $filtered = $count->total;

$limit = input_post('length', null, 10);
$start = input_post('start', null, 1);
$order = $columns[isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : 0];
$dir = isset($_POST['order']['0']['dir']) ? strtoupper($_POST['order']['0']['dir']) : 'DESC';

if (isset($_POST['search']['value'])) {
    $search = $_POST['search']['value'];

    if ($limit != '-1') {
        $query = $db->query(
            "SELECT id, login, name, email, gender, role, active, created_at " .
                "FROM users WHERE (login LIKE '%$search%' OR name LIKE '%$search%' OR " .
                "email LIKE '%$search%') AND id != '$logged' AND deleted_at IS NULL " .
                "ORDER BY $order $dir LIMIT $limit OFFSET $start"
        );
    } else {
        $query = $db->query(
            "SELECT id, login, name, email, gender, role, active, created_at " .
                "FROM users WHERE (login LIKE '%$search%' OR name LIKE '%$search%' OR " .
                "email LIKE '%$search%') AND id != '$logged' AND deleted_at IS NULL " .
                "ORDER BY $order $dir"
        );
    }

    $from = $db->query(
        "SELECT COUNT(id) AS total FROM users WHERE (login LIKE '%$search%' OR " .
            "name LIKE '%$search%' OR email LIKE '%$search%') " .
            "AND id != '$logged' AND deleted_at IS NULL"
    );

    $count = $from->fetch_object();
    $filtered = $count->total;
} else {
    if ($limit != '-1') {
        $query = $db->query(
            "SELECT id, login, name, email, gender, role, active, created_at " .
                "FROM users WHERE id != '$logged' AND deleted_at IS NULL " .
                "ORDER BY $order $dir LIMIT $limit OFFSET $offset"
        );
    } else {
        $query = $db->query(
            "SELECT id, login, name, email, gender, role, active, created_at " .
                "FROM users WHERE id != '$logged' AND deleted_at IS NULL " .
                "ORDER BY $order $dir"
        );
    }
}

$data = [];

if (!empty($query)) {
    $num = $start + 1;

    while ($row = $query->fetch_object()) {
        array_push($data, [
            'num' => $num,
            'id' => $row->id,
            'name' => $row->name,
            'login' => $row->login,
            'email' => $row->email,
            'gender' => $row->gender == 'M' ? 'Laki-laki' : 'Perempuan',
            'value_gender' => $row->gender,
            'role' => role($row->role),
            'value_role' => $row->role,
            'active' => $row->active ? 'Aktif' : 'Belum Aktif',
            'value_active' => $row->active ? 'true' : 'false',
            'created_at' => datenow(strtotime($row->created_at)),
        ]);
        $num++;
    }
}

$json = [
    'draw' => intval($draw),
    'recordsTotal' => intval($total),
    'recordsFiltered' => intval($filtered),
    'data' => $data,
];

return response_json($json);
