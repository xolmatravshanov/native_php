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

    public static function sort(array $array, $option = SORT_DESC, $deepth = 3)
    {
        $option = [
            'key' => 3,
            'value' => 2,
            'array' => 1,
            'option' => 'option'
        ];


        switch ($option) {
            //  Sort Array in Ascending Order - sort()
            case SORT_ASC && $deepth == 1:
                sort($array);
                break;
            //Sort Array in Descending Order - rsort()
            case SORT_DESC && $deepth == 1:
                rsort($array);
                break;

            //Sort Array (Ascending Order), According to Value - asort()
            case SORT_ASC && $deepth == 2:
                asort($array);
                break;

            //  Sort Array (Descending Order), According to Value - arsort()
            case SORT_DESC && $deepth == 2:
                arsort($array);
                break;


            //Sort Array (Ascending Order), According to Key - ksort()
            case SORT_ASC && $deepth == 3:
                ksort($array);
                break;

            //Sort Array (Descending Order), According to Key - krsort()
            case SORT_DESC && $deepth == 3:
                krsort($array);
                break;

        }

        return $array;

    }

}