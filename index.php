<?php
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');
if($_SERVER['SERVER_ADDR']=='127.0.0.1'){
	define('PROJECT_DIR', '/sun-cashmere/');
}
else{
	define('PROJECT_DIR', '/');
}

//echo 'APP_PATH: ' . APP_PATH . '<br />';
// 开启调试模式
define('APP_DEBUG', true);
//echo $_SERVER['DOCUMENT_ROOT'];
// 加载框架文件
require(APP_PATH.'frameworkCore/FrameWorkCore.php');
// 加载函数库
require(APP_PATH . 'frameworkCore/Common.php');

// 加载配置文件
$config = require(APP_PATH . 'config/config.php');

// 实例化框架类
$fw = new FrameWorkCore($config);
$fw->run();
$dir = $_SERVER['REQUEST_URI'];

