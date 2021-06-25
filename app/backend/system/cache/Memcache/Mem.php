<?php

namespace App\Backend\System\Cache\Memcache;

use Memcache;

class Mem
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
    protected $client = null;

    public function __construct()
    {
        $this->connect();
    }

    protected function connect()
    {
        $this->client = new Memcache();
        $this->client->connect($this->host, $this->port);
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