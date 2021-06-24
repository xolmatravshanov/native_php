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
        //TODO
    }
}