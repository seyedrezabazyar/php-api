<?php

define('CACHE_ENABLED', 1);
define('CACHE_DIR', __DIR__ . '/cache');

include_once 'App/iran.php';

spl_autoload_register(function ($class) {
    // $class_file = __DIR__ . $class . '.php';  #for Windows OS
    $class_file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';  #for Mac OS
    if (!(file_exists($class_file) and is_readable($class_file)))
        die("$class not found!");
    include_once $class_file;
});

//use App\Services\CityService;
//use App\Utilities\Response;
//
//new CityService();
//Response::respond([1,2,3,4],200);
