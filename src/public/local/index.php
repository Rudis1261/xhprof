<?php

// Let's ensure we have optimal performance. Set this simple thing
date_default_timezone_set('Africa/Johannesburg');

// Determine our absolute document root
define('CORE_ROOT', realpath(dirname(__FILE__) . '/../'));
define('DOC_ROOT', realpath(dirname(__FILE__)));
define('SPF', true);

// Let's get started
require(DOC_ROOT . "/classes/class.core_config.php");
require(DOC_ROOT . "/classes/class.config.php");
Config::getConfig();

// Initialize our session
/*try {
    session_name('spfs');
    session_start();
} catch(exception $e) {
    error_log($e->getMessage(), 4);
}*/

require(DOC_ROOT . "/classes/functions.inc.php");
$list_url       = list_url();
$getController  = $list_url['controller'];
define('ACTIVE_CONTROLLER', $getController);
$getMethod      = (!empty($list_url['method'])) ? $list_url['method']   : $getController;
$getValue       = (!empty($list_url['value']))  ? $list_url['value']    : array();

$controllers   = 'controllers/';
$projectPage   = $controllers . 'controller_' . $getController . '.php';
$contollername = 'controller_' . $getController;

$exists = false;
if (file_exists($projectPage)){
    $page = $projectPage;
    $exists = true;
}

// 404
if (!$exists && empty($_GET['profile'])){
    echo "Page not found 404";
    http_response_code(404);
    die();
}

// Some dependency injection
$Error = new spfError();
$db = Database::getDatabase();
$CSS = new Compost('css');
$JS = new Compost('js');

include($page);
$obj = new $contollername($Error, $db, $CSS, $JS);
if (method_exists($obj, $getMethod)){
    $obj->$getMethod($getValue);
} else {
    if (method_exists($obj, $getController)){
        array_unshift($getValue, $getMethod);
        $obj->$getController($getValue);
    } else {
        echo "Something went wrong";
        http_response_code(500);
        die();
    }
}