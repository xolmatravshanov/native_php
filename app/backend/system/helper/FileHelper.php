<?php

namespace App\Backend\System\Helper;


use Exception;
use InvalidArgumentException;

class FileHelper
{
    /**
     * @param string $path
     * @return string
     */
    public static function normilize(string $path): string
    {
        if (!$path && is_dir($path))
            throw new InvalidArgumentException('Directory does not exists');

        return str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }

    /**
     * @param string $path
     * @return string
     */
    public static function getSubDirs(string $path): string
    {

        return scandir($path);

    }


    /**
     * @param string $path
     * @return string
     */
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

    public function delete(string $file)
    {

        if (!file_exists($file))
            return false;

        $success = unlink($file);

        if ($success)
            return $success;

        throw new Exception("Cannot delete $file");
    }


    public function recurse_delete_dir(string $dir): int
    {
        $count = 0;

        // ensure that $dir ends with a slash so that we can concatenate it with the filenames directly
        $dir = rtrim($dir, "/\\") . "/";

        // use dir() to list files
        $list = dir($dir);

        // store the next file name to $file. if $file is false, that's all -- end the loop.
        while (($file = $list->read()) !== false) {
            if ($file === "." || $file === "..") continue;
            if (is_file($dir . $file)) {
                unlink($dir . $file);
                $count++;
            } elseif (is_dir($dir . $file)) {
                $count += $this->recurse_delete_dir($dir . $file);
            }
        }

        // finally, safe to delete directory!
        rmdir($dir);

        return $count;
    }

}