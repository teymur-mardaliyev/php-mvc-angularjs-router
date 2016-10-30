<?php
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Baku');
header('Content-Type: text/html; charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
define('LANGUAGES','MULTI'); // Multi or Not Mutli
define('TEMPLATE','');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'github_router');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_PREFIX','owl');

/*
 *
 * Network ID
 *
 * */

/*
 *
 * TABLES
 *
 * */
define('TBL_ARTICLES','1');
define('TBL_CATEGORY','2');
define('TBL_PAGES','3');

define('SITE_DATETIME',date('Y-m-d G:i:s'));