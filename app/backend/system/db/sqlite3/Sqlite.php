<?php


class Sqlite
{

    /**
     * @var null
     */
    private $driver = null;

    private $sqliteFile = null;


    public function __construct($sqliteFile)
    {
        $this->sqliteFile = $sqliteFile;
    }

    public function connect()
    {
        $this->driver = new SQLite3($this->sqliteFile);
    }

    public function findOne()
    {
        $this->driver->querySingle('SELECT column1Name FROM table WHERE column2Name=1');
    }




}