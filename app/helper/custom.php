<?php

if (!function_exists('datenow')) {
    function datenow($time)
    {
        $now = date('d', time());
        $today = date('d', $time);
        $tomorrow = date('d', $time) + 1;

        $date = date('F d, Y', $time);

        if ($now == $today) {
            $date = 'Hari ini, ';
        } elseif ($now == $tomorrow) {
            $date = 'Kemarin, ';
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

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}";

        if ($time > (time() - 60)) {
            return 'Baru saja';
        } else {
            return $print . ' yang lalu';
        }
    }
}
