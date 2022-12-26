<?php

must_login();

$draw = input_post('draw');
if (empty($draw)) {
    die('Ini bukan permintaan datatable.');
}

$logged = LOGGED;
$columns = ['id', 'name', 'email', 'type', 'billing_country', 'created_at'];

$from = $db->query("SELECT COUNT(id) AS total FROM accounts WHERE deleted_at IS NULL");
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
            "SELECT id, name, email, type, billing_country, created_at " .
                "FROM accounts WHERE (name LIKE '%$search%' OR email LIKE '%$search%' OR " .
                "billing_country LIKE '%$search%') AND deleted_at IS NULL " .
                "ORDER BY $order $dir LIMIT $limit OFFSET $start"
        );
    } else {
        $query = $db->query(
            "SELECT id, name, email, type, billing_country, created_at " .
                "FROM accounts WHERE (name LIKE '%$search%' OR email LIKE '%$search%' OR " .
                "billing_country LIKE '%$search%') AND deleted_at IS NULL " .
                "ORDER BY $order $dir"
        );
    }

    $from = $db->query(
        "SELECT COUNT(id) AS total FROM accounts WHERE (name LIKE '%$search%' OR " .
            "email LIKE '%$search%' OR billing_country LIKE '%$search%') " .
            "AND deleted_at IS NULL"
    );

    $count = $from->fetch_object();
    $filtered = $count->total;
} else {
    if ($limit != '-1') {
        $query = $db->query(
            "SELECT id, name, email, type, billing_country, created_at " .
                "FROM accounts WHERE deleted_at IS NULL " .
                "ORDER BY $order $dir LIMIT $limit OFFSET $offset"
        );
    } else {
        $query = $db->query(
            "SELECT id, name, email, type, billing_country, created_at " .
                "FROM accounts WHERE deleted_at IS NULL " .
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
            'email' => $row->email,
            'type' => account_type($row->type),
            'billing_country' => $row->billing_country,
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
