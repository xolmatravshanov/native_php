<?php

namespace App\Backend\System\Cache\CacheInterface;

interface CacheInterface
{

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key);

    /**
     * @param $key
     * @param $value
     * @param $expiry
     * @return mixed
     */
    public static function set($key, $value, $expiry);

    /**
     * @param $key
     * @return mixed
     */
    public static function delete($key);

    /**
     * @param $key
     * @return mixed
     */
    public static function exists($key);
}