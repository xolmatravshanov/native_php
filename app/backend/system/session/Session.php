<?php

class Session
{
    public function __construct()
    {

    }

    public static function start()
    {

        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start(array(
                    'cache_limiter' => 'private',
                    'read_and_close' => true,
                ));
            }
        } else {
            if (session_id() == '') {
                session_start();
            }
        }

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


    /**
     * close the session, release lock
     * @return bool|void
     */
    public static function close()
    {
        return session_write_close();
    }

    public static function cookieExits()
    {
        if (!isset($_COOKIE[session_name()]))
            return false;

        self::start();
    }

    public static function setName($name)
    {
        session_name($name);
        self::start();
    }

    public static function setCsrf()
    {
        $token = random_bytes(64);

        self::start();

        if (self::exits('csrf'))
            return self::get('csrf');

        self::set('csrf', $token);

        return $token;
    }


    public static function validateCsrf($token)
    {

        if ($token == self::get('csrf'))
            return true;

        self::delete('csrf');

        die("CSRF token validation failed");

    }


}