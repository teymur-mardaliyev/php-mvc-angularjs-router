<?php

class Application {

    public function __construct() {

        if (isset($_GET['url'])) {

            $controller = Router::get('controller') . 'controller';

            $controller_file = Config::get('DEFAULT_PATH_CONTROLLER') . $controller . '.php';

            if (file_exists($controller_file)) {

                require_once $controller_file;

                $controller = new $controller();

                if (method_exists($controller, Router::get('action'))) {
                    $controller->{Router::get('action')}();
                } else {
                    $controller->index();
                }

            } else {

                require Config::get('DEFAULT_PATH_CONTROLLER') . 'errorcontroller.php';
                $home = new ErrorController();
                $home->error404();

            }

        } else {
            require Config::get('DEFAULT_PATH_CONTROLLER') . 'homecontroller.php';
            $home = new HomeController();
            $home->index();
        }
    }

}