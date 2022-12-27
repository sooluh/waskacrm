<?php

$menus = [
    [
        'title' => 'Ikhtisar',
        'link' => 'overview',
        'icon' => 'dashboard',
    ],
    [
        'title' => 'Account',
        'link' => 'accounts',
        'icon' => 'building',
    ],
    [
        'title' => 'Contact',
        'link' => 'contacts',
        'icon' => 'contact',
    ],
    [
        'title' => 'Lead',
        'link' => 0,
        'icon' => 'users',
    ],
    [
        'title' => 'Opportunity',
        'link' => 'opportunities',
        'icon' => 'sign-dollar',
    ],
    [
        'title' => 'Kampanye',
        'link' => 0,
        'icon' => 'trend-up',
        'children' => [
            [
                'title' => 'Daftar Target',
                'link' => 0,
            ],
            [
                'title' => 'Semua Kampanye',
                'link' => 0,
            ],
        ],
    ],
    [
        'title' => 'Laporan',
        'link' => 0,
        'icon' => 'bar-chart-alt',
    ],
    [
        'title' => 'Pengguna',
        'link' => 'users',
        'icon' => 'user-alt',
        'permission' => ['0', '1'],
    ],
];
