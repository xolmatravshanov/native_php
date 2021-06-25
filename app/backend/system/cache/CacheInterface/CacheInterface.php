<?php

namespace App\Backend\System\Cache\CacheInterface;

interface CacheInterface
{

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @param $expiry
     * @return mixed
     */
    public function set($key, $value, $expiry);

    /**
     * @param $key
     * @return mixed
     */
    public function delete($key);

    /**
     * @param $key
     * @return mixed
     */
    public function exists($key);
}