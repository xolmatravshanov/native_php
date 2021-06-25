<?php

class ArrayHelper
{

    public static function keyExists($key, array $array)
    {
        return array_key_exists($key, $array);
    }

    public static function getValue($key, array $array)
    {
        return $array[$key];
    }

    public static function map($from, $to, array $array)
    {
        $result = [];
        foreach ($array as $item)
            $result[$item[$from]] = $to;
        return $result;
    }

    public static function getColumn($column, $array)
    {
        return array_map(function ($item) use ($column) {
            return $item[$column];
        }, $array);
    }




}