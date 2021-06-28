<?php


class Sqlite
{

    /**
     * @var null
     */
    private $driver = null;

    private $sqliteFile = null;

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