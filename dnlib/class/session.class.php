<?php

class Session
{
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? '';
    }

    public function destroy()
    {
        session_destroy();
    }

    public function setCookie($key, $value, $exp)
    {
        setcookie($key, $value, time() + $exp, '/');
    }

    public function getCookie($key)
    {
        return $_COOKIE[$key] ?? '';
    }

    public function deleteCookie($key)
    {
        setcookie($key, '', time() - (1000 * 30), '/');
    }
}
