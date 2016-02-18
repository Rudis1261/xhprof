<?php

ini_set('memory_limit','5G');

// Rewrite vars
// I want to do it a bit differently
// Var 1 would be the Class / Controller. Var 2 would be the optional method and any subsequent would be the var
function list_url($sep = '/') {

    // No request URI, return
    if (empty($_SERVER['REQUEST_URI'])) {
        return false;
    }

    // Let's check if we are in the root?
    if ($_SERVER['REQUEST_URI'] == '/') {
        return array('controller' => 'home');
    }

    $get = [];
    $urlParts = explode("?", $_SERVER['REQUEST_URI']);
    if (!empty($urlParts[1])) {
        parse_str($urlParts[1], $get);
    }

    // Create the array
    $return = [
        'controller' => [],
        'method' => [],
        'value' => [],
        'get' => $get,
    ];

    // Otherwise let's get the URI and split it up
    $arr = explode($sep, trim($urlParts[0], $sep));
    $arr = array_map('rawurldecode', $arr);

    // Has only a controller
    if (count($arr) > 0) {
        $return['controller'] = strtolower( array_shift($arr) );
    }

    // Has a method and values
    if (count($arr) > 1) {
        $return['method'] = strtolower( array_shift($arr) );
        $return['value']  = $arr;
    }

    // We only have a method, no additional values
    elseif (count($arr) == 1) {
        $return['method']   = strtolower( $arr[0] );
    }

    if (!empty($get) && empty($return['controller'])) {
        $return['controller'] = 'home';
    }

    // Ensure it's not empty
    return (!empty($return)) ? $return : false;
}


// This file gets auto prepended and allows us to profile a run
$processUrl = list_url();
if (!empty($_GET['profile']) || !empty($processUrl['get']['profile'])): ?>
    <div style="background: #bada55; color: #222; padding: 5px; position: absolute; right: 8px; top: 10px; border: 1px solid #999; z-index: 110000;">XHProf Running</div>
<?php else: ?>
    <div style="background: #ccc; color: #white; padding: 5px; position: absolute; right: 8px; top: 10px; border: 1px solid #999; z-index: 110000;">XHProf Not Running</div>
<?php endif; ?>