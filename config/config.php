<?php
if($_SERVER['SERVER_ADDR'] == '127.0.0.1' ){
	$config['db']['host'] = '127.0.0.1';
	$config['db']['username'] = 'root';
	$config['db']['password'] = '';
	$config['db']['dbname'] = 'sun_cashmere';
}
else{
	$config['db']['host'] = 'db698300439.db.1and1.com';
	$config['db']['username'] = 'dbo698300439';
	$config['db']['password'] = 'Sun-cash16';
	$config['db']['dbname'] = 'db698300439';
}

// assign default Controller and Action names 
$config['defaultController'] = 'Index';
$config['defaultAction'] = 'index';

return $config;