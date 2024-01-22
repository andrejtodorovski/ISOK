<?php
class CookieWrapper {
    public static function set($name, $value, $expire = 3600) {
        setcookie($name, $value, time() + $expire, "/");
    }

    public static function get($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : false;
    }

    public static function delete($name) {
        setcookie($name, '', time() - 3600, "/");
    }
}

class SessionWrapper {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public static function get($name) {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public static function destroy() {
        session_destroy();
    }
}