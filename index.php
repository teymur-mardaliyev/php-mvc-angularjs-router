<?php

// load application config (error reporting etc.)

require_once 'config.php';

$url = isset($_GET['url']) ? $_GET['url'] : ""; // site.com/human-readable-url/page-0905

$db = DatabaseFactory::getFactory()->getConnection();

Registry::set('db',$db);

require_once APP . 'config/settings.php';

// load class from libs

function __autoload($class) {
    $class = str_replace('\\', '/', $class);
    $file = APP . 'libs/' . $class . '.php';

    if (file_exists($file)) {
        require_once($file);
    } else {
        echo $file;
    }
}

$app = new Application();
