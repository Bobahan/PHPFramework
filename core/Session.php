<?php

namespace PHPFramework;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function get($key, $default = null) 
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getFlash($key, $default = null)
    {
        if(isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
        }

        return $value ?? $default;
    }

    public function setFlash($key, $value) {
        $_SESSION['flash'][$key] = $value;
    }

    public function has($key): bool 
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        if($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }
}