<?php

class Waska
{
    private static $data = [];

    public static function multiple(array $data)
    {
        foreach ($data as $key => $value) {
            self::$data[$key] = $value;
        }
    }

    public static function store(string $key, $data)
    {
        self::$data[$key] = $data;
    }

    public static function retrieve(string $key)
    {
        return self::$data[$key] ?? null;
    }

    public static function dump()
    {
        return self::$data;
    }
}
