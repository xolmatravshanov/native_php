<?php

namespace App\System\Console;

class Console
{

    protected $args = null;

    public function __construct()
    {

    }


    public function getArgs()
    {
        global $argv;
        $this->args = $argv;
    }
}