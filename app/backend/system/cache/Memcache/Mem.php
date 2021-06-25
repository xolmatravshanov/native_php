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


}