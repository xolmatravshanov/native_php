<?php

namespace App\Backend\System\Http\Cookie;

class Cookie
{
    public function __construct()
    {

    }

    public function exists($name)
    {
        return $_COOKIE[$name] ? true : false;
    }

    public function set($name, $value, $expiry)
    {
        return setcookie($name, $value, $expiry);
    }

    public function get($name)
    {
        if ($this->exists($name))
            return $_COOKIE[$name];

        return false;
    }

    public function delete($name)
    {

        setcookie($name, '', time() - 3600, '/');

        if ($this->exists($name)) {
            unset($_COOKIE[$name]);
            return true;
        }

        return false;

    }

    public function setForever($name, $value)
    {
        $expiry = time() + (10 * 365 * 24 * 60 * 60);
        return $this->set($name, $value, $expiry);
    }

    public function getAll()
    {
        return $_COOKIE;
    }

}