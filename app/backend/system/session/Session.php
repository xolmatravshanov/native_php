<?php

class Session
{
    public function __construct()
    {

    }

    public static function start()
    {
        session_start();
    }

    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        if (!self::exits($name))
            return false;

        return $_SESSION[$name];
    }

    public static function delete($name)
    {

        if (self::exits($name))
            unset($_SESSION[$name]);

        return false;
    }

    public static function getAll()
    {
        return $_SESSION;
    }

    public static function deleteAll()
    {
        return session_destroy();
    }

    public static function exits($name)
    {
        if (!isset($_SESSION[$name]))
            return false;

        return true;
    }


}