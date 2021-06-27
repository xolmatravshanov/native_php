<?php

use App\Backend\System\Cache\CacheInterface\CacheInterface;

class RedisWrapper implements CacheInterface
{

    static $client = null;
    private $host = '127.0.0.1';
    private $port = 6379;


    public function __construct(array $config = [])
    {
        if ($config) {
            $this->host = $config['host'];
            $this->port = $config['port'];
        }

        $this->connect();
    }

    private function connect()
    {
        self::$client = new Redis();
        self::$client->connect($this->host, $this->port);
    }

    public static function get($key)
    {
        self::$client->get($key);
    }

    public static function delete($key)
    {

    }

    public static function exists($key)
    {
        if (!self::get($key))
            return false;

        return true;
    }

    public static function set($key, $value, $expiry)
    {

        self::$client->set($key, $value);
    }

    public static function getKeys(string $startWith = null)
    {
        if ($startWith)
            return self::$client->keys($startWith);

        return self::$client->keys();
    }


}