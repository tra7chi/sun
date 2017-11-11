<?php
// apply the current directory
define('APP_PATH', __DIR__ . '/');

if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
	define('PROJECT_DIR', '/sun-cashmere/');
}
else{
	define('PROJECT_DIR', '/');
}

// echo 'APP_PATH: ' . APP_PATH . '<br />';

// open debug mode
define('APP_DEBUG', true);
//echo $_SERVER['DOCUMENT_ROOT'];

// load framework file
require(APP_PATH.'frameworkCore/FrameWorkCore.php');

// load function library
require(APP_PATH . 'frameworkCore/Common.php');

// load configuration file
$config = require(APP_PATH . 'config/config.php');

// instantiate FrameworkCore class
$fw = new FrameWorkCore($config);
$fw->run();
$dir = $_SERVER['REQUEST_URI'];

