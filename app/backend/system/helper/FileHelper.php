<?php

class FileHelper
{
    public static function normilize(string $path): string
    {
        if (!$path && is_dir($path))
            throw new InvalidArgumentException('Directory does not exists');

        return str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }

    public static function getSubDirs(string $path): string
    {

        return scandir($path);

    }


    public static function scanDir(string $path): string
    {
        $path = self::normilize($path);

        $result = [];

        $cdir = scandir($path);
        foreach ($cdir as $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($path . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = scanDir($path . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }
    }


}