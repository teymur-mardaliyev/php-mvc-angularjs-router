<?php

/**
 * Created by Teymur Lennon Mardaliyev.
 */
class Utils {

    public static function loadModel($model_name) {

        $model = 'application/models/' . strtolower($model_name) . '.php';
        if (file_exists($model)) {
            require_once $model;
            return new $model_name();
        } else {
            echo "Model: ``" . $model_name . "`` Doesn`t exists!";
        }

    }

    public static function loadLibrary($library_name, $args = null) {
        $library = 'application/libs/' . ucfirst(strtolower($library_name)) . '.php';
        if (file_exists($library)) {
            require_once $library;
            return new $library_name($args);
        } else {
            echo "Library: ``" . $library_name . "`` Doesn`t exists!";
        }

    }

    public static function loadPackages($packages_name) {
        $package = Config::get('DEFAULT_PATH_LIBS') . 'packages/' . strtolower($packages_name) . '.php';
        if (file_exists($package)) {
            require_once $package;
        } else {
            echo "Package: ``" . $packages_name . "`` Doesn`t exists!";
        }

    }

}