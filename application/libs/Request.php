<?php

/**
 * This is under development. Expect changes!
 * Class Request
 * Abstracts the access to $_GET, $_POST and $_COOKIE, preventing direct access to these super-globals.
 * This makes PHP code quality analyzer tools very happy.
 * @see http://php.net/manual/en/reserved.variables.request.php
 */
class Request {
    /**
     * Gets/returns the value of a specific key of the POST super-global.
     * When using just Request::post('x') it will return the raw and untouched $_POST['x'], when using it like
     * Request::post('x', true) then it will return a trimmed and stripped $_POST['x'] !
     *
     * @param mixed $key key
     * @param bool $clean marker for optional cleaning of the var
     * @return mixed the key's value or nothing
     */
    public static function post($key, $clean = false) {
        if (isset($_POST[$key])) {
            // we use the Ternary Operator here which saves the if/else block
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            return ($clean) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
        }
    }

    /**
     * gets/returns the value of a specific key of the GET super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function get($key) {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return false;
        }
    }

    /**
     * gets/returns the value of a specific key of the COOKIE super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function cookie($key) {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return NULL;
        }
    }

    public static function id() {
        if (isset($_GET['id'])) {
            return $_GET['id'];
        }
    }

    public static function data($name = "data") {
        return json_decode(json_encode($_POST[$name]));
    }

    public static function jdata($key) {
        if (self::data()->$key) {
            return self::data()->$key;
        } else {
            return 0;
        }
    }

    public static function file($name) {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
    }

    public static function jende($data) {
        return json_decode(json_encode($data));
    }

    /**
     * Returns true if the request is a XMLHttpRequest.
     *
     * It works if your JavaScript library sets an X-Requested-With HTTP header.
     *
     * $_SERVER['HTTP_X_REQUESTED_WITH'] can be spoofed.
     * @link - https://paulund.co.uk/use-php-to-detect-an-ajax-request
     *
     */
    public static function HttpXRequestedWith() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

}
