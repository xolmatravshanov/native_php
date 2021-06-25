<?php

namespace App\Backend\System\Helper;

class Html
{
    public function __construct()
    {

    }

    public function sanitizeString($input)
    {

        return filter_var($input, FILTER_SANITIZE_STRING);
    }


    public function sanitizeFloat($input)
    {
        //   FILTER_FLAG_ALLOW_THOUSAND
        //   FILTER_FLAG_ALLOW_SCIENTIFIC
        //   FILTER_VALIDATE_FLOAT
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public function sanitizeInt($input)
    {
        /*FILTER_VALIDATE_INT*/
        /*  $options = array(
              'options' => array(
                  'min_range' => 5,
                  'max_range' => 10,
              )
          );
          var_dump(filter_var('5', FILTER_VALIDATE_INT, $options));
          */
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function sanitizeUrl($input)
    {
        /*var_dump(filter_var('example.com', FILTER_VALIDATE_URL));*/
        return filter_var($input, FILTER_SANITIZE_URL);
    }


    public function sanitizeEmail($input)
    {
        /*var_dump(filter_var('john@example.com', FILTER_VALIDATE_EMAIL));*/
        return filter_var($input, FILTER_SANITIZE_EMAIL);
    }

    public function sanitizeBool($input)
    {
        //var_dump(filter_var(true, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)); // true
    }


    public function sanitizeIp($input)
    {
        // var_dump(filter_var('185.158.24.24', FILTER_VALIDATE_IP));
    }

    public function sanitizeMac($input)
    {
        // var_dump(filter_var('FA-F9-DD-B2-5E-0D', FILTER_VALIDATE_MAC));
    }

    /**
     * @param string $url
     * @return array|false|int|string|null
     */
    public function parseUrl(string $url)
    {
        return parse_url($url);
        /*
         *
         *
           [scheme] => http
           [host] => example.com
           [path] => /project/controller/action/param1/param2

         * */
    }
}