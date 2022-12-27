<?php

must_login();

$draw = input_post('draw');
if (empty($draw)) {
    die('Ini bukan permintaan datatable.');
}

$logged = LOGGED;
$columns = [
    'contacts.id',
    'contacts.first_name',
    'accounts.name',
    'contacts.email',
    'contacts.phone_number',
    'contacts.created_at'
];

$from = $db->query("SELECT COUNT(id) AS total FROM contacts WHERE deleted_at IS NULL");
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
            "SELECT contacts.id, contacts.first_name, contacts.last_name, accounts.name, " .
                "contacts.email, contacts.phone_number, contacts.created_at FROM contacts " .
                "LEFT JOIN accounts ON accounts.id = contacts.account " .
                "WHERE (contacts.first_name LIKE '%$search%' OR " .
                "contacts.last_name LIKE '%$search%' OR accounts.name LIKE '%$search%' OR " .
                "contacts.email LIKE '%$search%' OR contacts.phone_number LIKE '%$search%') AND " .
                "contacts.deleted_at IS NULL ORDER BY $order $dir LIMIT $limit OFFSET $start"
        );
    } else {
        $query = $db->query(
            "SELECT contacts.id, contacts.first_name, contacts.last_name, accounts.name, " .
                "contacts.email, contacts.phone_number, contacts.created_at FROM contacts " .
                "LEFT JOIN accounts ON accounts.id = contacts.account " .
                "WHERE (contacts.first_name LIKE '%$search%' OR " .
                "contacts.last_name LIKE '%$search%' OR accounts.name LIKE '%$search%' OR " .
                "contacts.email LIKE '%$search%' OR contacts.phone_number LIKE '%$search%') AND " .
                "contacts.deleted_at IS NULL ORDER BY $order $dir"
        );
    }

    $from = $db->query(
        "SELECT COUNT(contacts.id) AS total FROM contacts LEFT JOIN accounts " .
            "ON accounts.id = contacts.account WHERE (contacts.first_name LIKE '%$search%' OR " .
            "contacts.last_name LIKE '%$search%' OR accounts.name LIKE '%$search%' OR " .
            "contacts.email LIKE '%$search%' OR contacts.phone_number LIKE '%$search%') " .
            "AND contacts.deleted_at IS NULL"
    );

    $count = $from->fetch_object();
    $filtered = $count->total;
} else {
    if ($limit != '-1') {
        $query = $db->query(
            "SELECT contacts.id, contacts.first_name, contacts.last_name, accounts.name, " .
                "contacts.email, contacts.phone_number, contacts.created_at FROM contacts " .
                "LEFT JOIN accounts ON accounts.id = contacts.account " .
                "WHERE contacts.deleted_at IS NULL ORDER BY $order $dir LIMIT $limit OFFSET $start"
        );
    } else {
        $query = $db->query(
            "SELECT contacts.id, contacts.first_name, contacts.last_name, accounts.name, " .
                "contacts.email, contacts.phone_number, contacts.created_at FROM contacts " .
                "LEFT JOIN accounts ON accounts.id = contacts.account " .
                "WHERE contacts.deleted_at IS NULL ORDER BY $order $dir"
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
            'name' => $row->first_name . ' ' . $row->last_name,
            'account' => $row->name,
            'email' => $row->email,
            'phone' => $row->phone_number,
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
