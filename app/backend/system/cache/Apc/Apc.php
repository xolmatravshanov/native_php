<?php


use App\Backend\System\Cache\CacheInterface\CacheInterface;

class Apc implements CacheInterface
{

    public function __construct()
    {
        /*APC is nearly 5 times faster than Memcached.*/

    }

    /**
     * @param $key
     * @param $value
     * @param $expiry
     * @return bool|mixed
     */
    public static function set($key, $value, $expiry)
    {       //$expiry =  time() + 86400;
        return apc_add($key, $value, $expiry);
    }

    /**
     * @param $key
     * @return false|mixed
     */
    public static function get($key)
    {
        return apc_fetch($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key): bool
    {
        return apc_exists($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function delete($key): bool
    {
        if (!self::exists($key))
            return false;

        return apc_delete($key);

    }
}