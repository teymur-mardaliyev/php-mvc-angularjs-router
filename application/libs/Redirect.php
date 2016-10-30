<?php

/**
 * Class Redirect
 *
 * Simple abstraction for redirecting the user to a certain page
 */
class Redirect {
    /**
     * To the homepage
     */
    public static function home() {
        header("location: " . URL);
    }

    /**
     * To the defined page
     *
     * @param $path
     */
    public static function to($path) {
        header("location: " . URL . $path);
    }

    public static function login() {

        header("location: " . URL . 'login/index');
    }

    public static function url($url) {
        header("HTTP/1.1 301 Moved Permanently");
        header("location: " . $url);
    }
}