<?php

namespace App\Backend\System\Helper;


use Exception;
use InvalidArgumentException;

class FileHelper
{
    public $uploadStatusCodes = [
        UPLOAD_ERR_OK => 'The file uploaded with success.',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive',
        UPLOAD_ERR_PARTIAL => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload',
    ];


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

    public function isWritable($file)
    {
        return is_writable($file);
    }

    public function isReadable($file)
    {
        return is_readable($file);
    }

    public function getModifyTime($file)
    {

        if (!file_exists($file))
            return false;

        return date("Y-m-d", filemtime($file));
    }

    public function getPathInfo($path)
    {
        return pathinfo($path);

        /*
         * Array
                (
                    [dirname] => /var/www
                    [basename] => image.png
                    [extension] => png
                    [filename] => image
                )
         *
         * */
    }

    public function getMemoryUsage($file)
    {
        if (!file_exists($file))
            return false;

        $start = memory_get_usage(true);
        $arr = file($file);
        $end = memory_get_usage(true);
        return $end - $start;

    }

    public function copy($file, $copy)
    {
        if (!file_exists($file))
            return false;

        if (copy($file, $copy))
            return true;

        return false;

    }

    public function getUploadError()
    {


        $fileError = $_FILES["FILE_NAME"]["error"]; // where FILE_NAME is the name attribute of the file input in your form
        if (!$fileError)
            return false;

        return $this->uploadStatusCodes[$fileError];
    }


    public function upload()
    {
        $_FILES['file']['name'];
        $_FILES['file']['type'];
        $_FILES['file']['size'];
        $_FILES['file']['tmp_name'];

    }

    public function nameNormilize($fileName)
    {
        $illegal = array_merge(array_map('chr', range(0, 31)), ["<", ">", ":", '"', "/", "\\", "|", "?", "*", " "]);
        $filename = str_replace($illegal, "-", $_FILES['file']['name']);


        $pathinfo = pathinfo($filename);

        $extension = $pathinfo['extension'] ? $pathinfo['extension'] : '';
        $filename = $pathinfo['filename'] ? $pathinfo['filename'] : '';


        if (!empty($extension) && !empty($filename)) {
            echo $filename, $extension;
        } else {
            die('file is missing an extension or name');
        }
    }

    public function validateMime($mime, $extension, $fileName)
    {
        if ($mime == 'image/jpeg' && $extension == 'jpeg' || $extension == 'jpg') {
            if ($img = imagecreatefromjpeg($fileName)) {
                imagedestroy($img);
            } else {
                die('image failed to open, could be corrupt or the file contains something else.');
            }
        }
    }


    public function isFiletypeAllowed($extension, $mime, array $allowed)
    {

        $allowedFiletypes = [

            'image/png' => ['png'],
            'image/gif' => ['gif'],
            'image/jpeg' => ['jpg', 'jpeg'],

        ];

        return isset($allowed[$mime]) &&
            is_array($allowed[$mime]) &&
            in_array($extension, $allowed[$mime]);

    }


}