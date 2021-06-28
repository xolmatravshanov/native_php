<?php

namespace App\Backend\System\Date;

class Date
{


    protected $date = null;


    public function __construct()
    {
        $this->date = new \DateTime();
    }


    public function getTime()
    {

    }


}