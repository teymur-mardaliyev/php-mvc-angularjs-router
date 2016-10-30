<?php

/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 11/23/14
 * Time: 10:25 PM
 */
class Router {

    protected static $url = null; // www.example.com/best/human-readable/url-09/5
    protected static $separate_url = null;
    protected static $page = null;
    protected static $id = null;
    public static $controller = 'Home'; // default controller
    public static $action = 'index'; // default action in controller
    protected static $routes = array(); //
    protected static $namedRoutes = array();
    public static $params = array();
    protected static $matchTypes = array(
        ":alphabet" => '(\w+)', // only alphabet - /slug
        ":number" => '(\d+)', // only numbers - /6996
        ":slug" => '([a-z0-9_-]+)', // alphabet from A to Z and numbers from 0 to 9 - /human-readable-url-69
        ":page" => '([0-9]+)', // only numbers - 69
        ":username" => '([a-z0-9_.-]{4,40})', // A-Z 0-9 minimum 4 maximum 40 character
        ":keyword" => '(.+)', // all symbols
        ":lang" => '([a-z]{3})', // A-Z max 3 symbol like aze;eng;rus;
    );
    protected static $patterns = array();
    protected static $target_end = false;

    /**
     *  We get url with .htaccess - RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
     *  And Router class calls from /application/config/settings.php
     *
     *  $separate_url = If our url like this
     *  http://www.example.com/best/human-readable/url-09/5
     *  then we separate url to parts
     *  array('best','human-readable','url-09','5'
     *
     */

    function __construct($url) {

        if (strstr($url, '?')) $url = substr($url, 0, strpos($url, '?'));
        $url = rtrim($url, '/');
        self::$url = trim($url);
        self::$separate_url = explode('/', $url);

    }

    /**
     *
     *  There we include terms from /application/config/settings.php
     *
     *  $router->route('send/message', 'home/index', array('page'));
     *  $pattern - for url term
     *  $target - run controller/action
     *  $arg - It create variable from $_GET
     *
     */

    public static function route($pattern, $target = '', $args = array()) {

        if ($pattern) {

            if (!isset(self::$routes[$pattern])) {
                $pattern = rtrim($pattern, '/');

                $pattern = explode('/', $pattern);

                $params = "";

                foreach ($pattern as $val) {
                    $params .= (array_key_exists($val, self::$matchTypes) ? self::$matchTypes[$val] : $val) . "/";
                }

                $pattern = rtrim($params, '/');

                $pattern = '/' . str_replace('/', '\/', $pattern) . '/';

                self::$routes[$pattern] = array('args' => $args, 'target' => $target);

            } else {
                throw new \Exception("Can not redeclare route '{$pattern}' - There is not any `map` with this name");
            }
        }

    }

    /**
     *  Router starts to run from here
     */


    public static function splitUrl() {

        $page = self::$url;

        self::execute();

        if (self::$target_end == false) {
            if (isset(self::$params['slug'])) {
                $dbparams = self::getURLpage(self::$params['slug']);

                if ($dbparams != false) {

                    self::$params["data_id"] = $dbparams->data_id;
                    self::$params["page"] = $page;

                    $page = $dbparams->template;
                }

            }

            self::targetMatch($page);
        }

        self::loadMetodGET();
    }

    /**
     *  Check and create non-database controller/action
     * */

    public static function execute() {

        $url = self::$url;

        $pattern = '/' . str_replace('/', '\/', $url) . '/';

        // If url equals with controller/action target (home/index) then create controller and action

        if (array_key_exists($pattern, self::$routes)) {

            self::targetMatch($pattern, true);

        } else {

            foreach (self::$routes as $pattern => $callback) {

                if (preg_match($pattern, $url)) {

                    /* If there have arguments ($arg) then check arguments */

                    if (!empty($callback['args']) and is_array($callback['args'])) {

                        preg_match_all($pattern, $url, $matches);

                        array_shift($matches);

                        foreach ($matches as $key => $match) {

                            if (array_key_exists(0, $match)) {
                                self::$params[$callback['args'][$key]] = htmlspecialchars($match[0]);
                            }

                        }

                        self::targetMatch($pattern, true);

                    } else {

                        self::targetMatch($url);
                    }

                    return true;
                }
            }
        }
    }

    /**
     *  There we create variables from $_GET if argument ($arg) is 'tag' then it return 'get_tag'
     */

    protected static function loadMetodGET() {

        if (isset($_GET)) {
            foreach ($_GET as $key => $val) {
                if (!is_array($val)) {
                    if (!isset(self::$params["get_" . $key])) {
                        self::$params["get_" . $key] = $val;
                    }
                }
            }
        }

    }

    /**
     *
     */

    private static function targetMatch($target, $before_explode = false) {

        $target = $before_explode == true ? self::$routes[$target]['target'] : $target;

        if ($target != '*') {
            $matches = explode('/', $target);

            if ($matches) {

                self::$page = $target;
                $page = $matches;

                self::$params["controller"] = isset($page[0]) ? $page[0] : 'Home';
                self::$params["action"] = isset($page[1]) ? $page[1] : 'PageNotFound';
                self::$target_end = true;

                return self::$page;
            } else {
                return false;
            }

        } else {
            self::$target_end = false;
        }
    }


    /**
     *  If url has in database then get controller/action (`template` - column)
     */

    public static function getURLpage($url) {

        $q = Registry::get('db')->prepare("SELECT `data_id`,`url`,`template` FROM `" . DB_PREFIX . "_pages` WHERE `url`=:url AND `visible`=:visible LIMIT 0,1");

        $q->execute(array(
            ":url" => $url,
            ":visible" => '1'
        ));

        if ($q->rowCount() > 0) {
            return $q->fetch();
        } else {
            return false;
        }
    }

    public static function get($key) {
        return isset(self::$params[$key]) ? self::$params[$key] : null;
    }

    public static function pageUrl() {
        return self::$url;
    }

}