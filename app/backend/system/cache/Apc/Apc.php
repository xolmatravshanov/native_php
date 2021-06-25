<?php


use App\Backend\System\Cache\CacheInterface\CacheInterface;

class Apc implements CacheInterface
{

    public function __construct()
    {
        /*APC is nearly 5 times faster than Memcached.*/

    }

    public static function set($key, $value, $expiry)
    {
        return apc_add($key, $value, $expiry);
    }

    public static function get($key)
    {

    }

    public static function exists($key)
    {
        return apc_exists($key);
    }

    public static function delete($key)
    {
        self::exists($key);
    }
}