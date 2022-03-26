<?php

# cache constants
define('CACHE_ENABLED', 0); // Enable or Disable Cache
define('CACHE_DIR', __DIR__ . '/cache');

# Authentication constants
define('JWT_KEY', 'IranProjectKey_HVggSfNJX+wZQd=%%_##PF^W6G#Hym');
define('JWT_ALG', 'HS256');
include_once 'vendor/autoload.php';
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
