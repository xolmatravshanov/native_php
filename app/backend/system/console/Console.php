<?php

namespace App\System\Console;

class Console
{
    /**
     * @var
     * STDIN = fopen("php://stdin", "r");
     * STDOUT = fopen("php://stdout", "w");
     * STDERR = fopen("php://stderr", "w");
     */
    protected $args = null;
    protected $ini = null;

    public function __construct()
    {

    }

    public function getArgs()
    {
        global $argv;
        $this->args = $argv;
    }

    public function normilize()
    {
        // console argumetn escaping
        $escape = "\\";
        $oneQuote = "\\";
    }

    public static function isCli()
    {
        if (php_sapi_name() === 'cli')
            return true;
        return false;
    }

}