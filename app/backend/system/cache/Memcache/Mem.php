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
        $this->client->set($key, $value, 0, $expiry);
    }

    public static function get($key)
    {
        $this->client->get($key);
    }

    public static function exists($key)
    {
        if ($this->client->get($key))
            return true;

        return false;
    }

    public static function delete($key)
    {
        $this->client->delete($key);
    }


}