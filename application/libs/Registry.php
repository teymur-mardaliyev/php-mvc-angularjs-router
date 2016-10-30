<?php

/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 7/23/16
 * Time: 01:52
 */
final class Registry {

    static private $data = array();

    public static function get($key) {
        return (isset(self::$data[$key]) ? self::$data[$key] : null);
    }

    public static function set($key, $value) {
        if (!self::has($key)) {
            self::$data[$key] = $value;
        }
    }

    public static function has($key) {
        return isset(self::$data[$key]) ? true : false;
    }
}