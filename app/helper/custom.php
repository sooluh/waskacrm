<?php

if (!function_exists('datenow')) {
    function datenow($time)
    {
        $months = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $now = date('d', time());
        $today = date('d', $time);
        $tomorrow = date('d', $time) + 1;

        $date = date('Y-m-d ', $time);
        $date = explode('-', $date);
        $date = implode(' ', [$date[2], $months[$date[1]], $date[0]]) . ' ';

        if ($now == $today) {
            $date = 'Hari ini ';
        } elseif ($now == $tomorrow) {
            $date = 'Kemarin ';
        }

        return $date . gmdate('H:i:s', $time + 60 * 60 * 7);
    }
}

if (!function_exists('ago')) {
    function ago($time)
    {
        $chunks = [
            [60 * 60 * 24 * 365, 'Tahun'],
            [60 * 60 * 24 * 30, 'Bulan'],
            [60 * 60 * 24 * 7, 'Minggu'],
            [60 * 60 * 24, 'Hari'],
            [60 * 60, 'Jam'],
            [60, 'Menit'],
        ];
        $now = time();
        $since = $now - $time;

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = $count == 1 ? '1 ' . $name : "$count {$name}";

        if ($time > (time() - 60)) {
            return 'Baru saja';
        } else {
            return $print . ' yang lalu';
        }
    }
}

if (!function_exists('phone_type')) {
    function phone_type($value = '')
    {
        $types = [1 => 'Mobile', 'Office', 'Fax', 'Other'];
        return $value !== '' ? ($types[$value] ?? 'Tidak Ada') : $types;
    }
}

if (!function_exists('account_type')) {
    function account_type($value = '')
    {
        $types = [1 => 'Customer', 'Investor', 'Partner', 'Reseller'];
        return $value !== '' ? ($types[$value] ?? 'Tidak Ada') : $types;
    }
}

if (!function_exists('industry_type')) {
    function industry_type($value = '')
    {
        $types = [
            1 => 'Advertising',
            'Aerospace',
            'Agriculture',
            'Apparel & Accessories',
            'Architecture',
            'Automotive',
            'Banking',
            'Biotechnology',
            'Building Materials & Equipment',
            'Chemical',
            'Computer',
            'Construction',
            'Consulting',
            'Creative',
            'Culture',
            'Defense',
            'Education',
            'Electric Power',
            'Electronics',
            'Energy',
            'Entertainment & Leisure',
            'Finance',
            'Food & Beverage',
            'Grocery',
            'Healthcare',
            'Hospitality',
            'Insurance',
            'Legal',
            'Manufacturing',
            'Marketing',
            'Mass Media',
            'Mining',
            'Music',
            'Petroleum',
            'Publishing',
            'Real Estate',
            'Retail',
            'Service',
            'Shipping',
            'Software',
            'Sports',
            'Support',
            'Technology',
            'Telecommunications',
            'Television',
            'Testing, Inspection & Certification',
            'Transportation',
            'Travel',
            'Venture Capital',
            'Water',
            'Wholesale',
        ];
        return $value !== '' ? ($types[$value] ?? 'Tidak Ada') : $types;
    }
}

if (!function_exists('salutation')) {
    function salutation($value = '')
    {
        $data = [1 => 'Mr.', 'Ms.', 'Mrs.', 'Dr.'];
        return $value !== '' ? ($data[$value] ?? 'Tidak Ada') : $data;
    }
}
