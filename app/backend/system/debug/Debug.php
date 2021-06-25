<?php

class Debug
{

    public function __construct()
    {

    }

    public function phpInfo()
    {
        return phpinfo();
    }

    public function phpVersion()
    {
        return phpversion();
    }


}