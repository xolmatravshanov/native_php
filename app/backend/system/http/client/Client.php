<?php

namespace App\Backend\System\Http\Client;

use const http\Client\Curl\Versions\CURL;

class Client
{

    public function __construct()
    {
        $this->checkRequirement();
    }

    public function configure($url)
    {

        $init = curl_init();

        /*  $multiInit = curl_multi_init();

          $shareInit = curl_share_init();*/

        // set the URL and other options
        curl_setopt($init, CURLOPT_URL, $url);

        curl_setopt($init, '', '');
    }

    public function getOptions()
    {
        static $return = [
            CURL, // VERSION
            CURL, //
        ];
    }


    public function checkRequirement()
    {
        // a little script check is the cURL extension loaded or not
        if (!extension_loaded("curl")) {
            die("cURL extension not loaded! Quit Now.");
        }
    }

    public function start()
    {
        curl_init();
    }

    public function run($curl)
    {

        curl_exec($curl);

    }

    public function close($curl)
    {
        curl_close($curl);
    }

    public function post(array $data, $curl)
    {
        // Let's pass POST data
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }


    public function customRequest($curl)
    {
        $method = 'DELETE'; // Create a DELETE request

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        $content = curl_exec($ch);
        curl_close($ch);
    }

    public function setHeaders(array $array, $curl)
    {
        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => array('X-User: admin', 'X-Authorization: 123456'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => 1
        ));
    }

}