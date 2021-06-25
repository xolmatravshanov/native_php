<?php

namespace App\Backend\System\Cache\Memcache;

use App\Backend\System\Cache\CacheInterface\CacheInterface;
use Memcache;

class Mem implements CacheInterface
{
    /**
     * @var int
     */
    protected $port = 11211;

    /**
     * @var string
     */
    protected $host = 'localhost';

    /**
     * @var Memcache
     */
    protected static $client = null;

    public function __construct()
    {
        $this->connect();
    }

    protected function connect()
    {
        self::$client = new Memcache();
        self::$client->connect($this->host, $this->port);
    }


    public static function set($key, $value, $expiry)
    {
        self::$client->set($key, $value, 0, $expiry);
    }

    public static function get($key)
    {
        self::$client->get($key);
    }

    public static function exists($key)
    {
        if (self::$client->get($key))
            return true;

        return false;
    }

    public static function delete($key)
    {
        self::$client->delete($key);
    }


}