<?php

namespace App\Backend\System\Http\Client;

use const http\Client\Curl\Versions\CURL;

class Client
{

    public function __construct()
    {

    }

    public function configure()
    {

        $init = curl_init();

        $multiInit = curl_multi_init();

        $shareInit = curl_share_init();

        curl_setopt($init, '', '');
    }

    public function getOptions()
    {
        static $return = [
                CURL, // VERSION
                CURL, //
        ];
    }


}