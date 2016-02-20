<?php

require_once('templates/partials/auto_prepend.php');

// Let's ensure we have optimal performance. Set this simple thing
date_default_timezone_set('Africa/Johannesburg');

// Some overrides
ini_set('memory_limit','5G');
ini_set('highlight.comment', '#B3B3B3; font-style: italic;');
ini_set('highlight.html', '#333;');

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


// Determine whether to enable / disable profiling
$processUrl = list_url();
if (!empty($_GET['profile']) || !empty($processUrl['get']['profile'])) {
    $_xhprofEnable = true;
} else {
    $_xhprofEnable = false;
}

define('XHPROF_ENABLED', $_xhprofEnable);

// Ensure that the run directory exists
$xhprofDir = dirname(__FILE__) . '/xhprof/runs';
if (!file_exists($xhprofDir)) {
    mkdir($xhprofDir);
}


// Set the path
//ini_set('output_buffering', true);
ini_set('xhprof.output_dir', $xhprofDir);
if (!extension_loaded('xhprof')) {
    return;
}

if (!$_xhprofEnable || !is_dir($xhprofDir) || !is_writeable($xhprofDir)) {
    return;
}

$_xhprofLibDir = dirname(__FILE__).'/xhprof/xhprof_lib';
include_once($_xhprofLibDir.'/utils/xhprof_lib.php');
include_once($_xhprofLibDir.'/utils/xhprof_runs.php');
register_shutdown_function(function() {
    $namespace = isset($_SERVER['HTTP_HOST']) ? str_replace(".","_",$_SERVER['HTTP_HOST']) : "cli";
    $xhprof_data = xhprof_disable();
    $xhprof_runs = new XHProfRuns_Default();
    $run_id = $xhprof_runs->save_run($xhprof_data, $namespace);
    file_put_contents("/tmp/xhprof_runs.log",$run_id."\n",FILE_APPEND);
    //echo "<div align=right><b>View Run at:</b> <a href='http://localhost/xhprof/index.php?run=$run_id&source=$namespace'> Click here </a></div>";
});

xhprof_enable(XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);

