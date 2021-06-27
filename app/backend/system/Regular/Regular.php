<?php

class Regular
{

    public function __construct()
    {

    }

    public function isEmail()
    {

    }


    public function isPhone()
    {

    }


    /**
     *
     *
     * Array
        (
            [0] => <a href="http://example.org">My Link</a>
            [1] => http://example.org
            [2] => My Link
        )
     *
     * @param $string
     * @return false|int
     */
    public function getDataFromLink($string)
    {
        $pattern = "/<a href=\"(.*)\">(.*)<\/a>/";

        $result = preg_match($pattern, $string, $matches);

        if (!$result) {
            return $result;
        }

        return $matches;

    }

}