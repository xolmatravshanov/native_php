<?php

use App\Backend\System\Db\BaseDb;

class Sqlite extends BaseDb
{

    /**
     * @var null
     */
    private $driver = null;

    /**
     * @var null
     */
    private $sqliteFile = null;

    /**
     * @var null
     */
    private $result = null;


    public function __construct($sqliteFile)
    {
        $this->sqliteFile = $sqliteFile;
    }

    public function connect()
    {
        $this->driver = new SQLite3($this->sqliteFile);
    }

    public function findOne($query)
    {
        $this->result = $this->driver->querySingle($query);
    }

    public function find($query)
    {
        $this->result = $this->driver->query($query);
    }

    public function toArray()
    {
        return $this->result->fetchArray();
    }


}