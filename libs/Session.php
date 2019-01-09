<?php

class Session {

    public static function init() {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
        ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
        @session_start();
    }

    public static function set($key, $value) {

        $_SESSION[$key] = $value;
    }

    public static function offset($key) {
        if (isset($_SESSION[$key])) {
            $_SESSION[$key] = "";
            unset($_SESSION[$key]);
        }
    }

    public static function get($key) {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function destroy() {
        // unset($_SESSION);
        session_destroy();
    }

}