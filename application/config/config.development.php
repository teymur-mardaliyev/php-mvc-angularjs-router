<?php

/**
 * Configuration for DEVELOPMENT environment
 * To create another configuration set just copy this file to config.production.php etc. You get the idea :)
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard / no errors in production.
 * It's a little bit dirty to put this here, but who cares. For development purposes it's totally okay.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Returns the full configuration.
 * This is used by the core/Config class.
 */
return array(
	/**
	 * Configuration for: Base URL
	 * This detects your URL/IP incl. sub-folder automatically. You can also deactivate auto-detection and provide the
	 * URL manually. This should then look like 'http://192.168.33.44/' ! Note the slash in the end.
	 */
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])).'/',
	'PAGE_URL' => 'http://' . $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
	/**
	 * Configuration for: Folders
	 * Usually there's no reason to change this.
	 */
	'DEFAULT_PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
	'DEFAULT_PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/views/',
	'DEFAULT_PATH_LIBS' => realpath(dirname(__FILE__).'/../../') . '/application/libs/',
	/**
	 * Configuration for: Default controller and action
	 */
	'DEFAULT_CONTROLLER' => 'home',
	'DEFAULT_ACTION' => 'index',
	/**
	 * Configuration for: Cookies
	 * 1209600 seconds = 2 weeks
	 * COOKIE_PATH is the path the cookie is valid on, usually "/" to make it valid on the whole domain.
	 * @see http://stackoverflow.com/q/9618217/1114320
	 * @see php.net/manual/en/function.setcookie.php
	 *
	 * COOKIE_DOMAIN: The domain where the cookie is valid for. Usually this does not work with "localhost",
	 * ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
	 * When using real domains make sure you have a dot (!) in front of the domain, like ".mydomain.com". This is
	 * strange, but explained here:
	 * @see http://stackoverflow.com/questions/2285010/php-setcookie-domain
	 * @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
	 * @see http://php.net/manual/en/function.setcookie.php#73107
	 *
	 * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection.
	 * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
	 * SESSION_RUNTIME: How long should a session cookie be valid by seconds, 604800 = 1 week.
	 */
	'COOKIE_RUNTIME' => 1209600,
	'COOKIE_PATH' => '/',
	'COOKIE_DOMAIN' => "",
	'COOKIE_SECURE' => false,
	'COOKIE_HTTP' => true,
	'SESSION_RUNTIME' => 604800,
    'ARTICLE_RATE_COOKIE'  => strtotime("+1 week"),
	'LANG_RATE_COOKIE'	=> strtotime("+1 week"),
	'ONLY_TODAY_COOKIE'	=> time() + strtotime(date("Y-m-d") . " 23:59:59"),
    'DATETIME' => date("Y-m-d G:i:s")
);
