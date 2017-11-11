<?php
$dir = $_SERVER['REQUEST_URI'];
//echo $dir;
$relativePath = "";
//echo substr_count($dir, '/')."<br>";
if(PROJECT_DIR == '/')
	$slant_count = 1;
else
	$slant_count = 2;
for($i=0 ;$i<substr_count($dir, '/') -  $slant_count;$i++)// root is /,so we need minus 1.
	$relativePath = $relativePath."../";
//echo $relativePath;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sun-Cashmere</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $relativePath?>static/img/tab-icon2.jpg"> 
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/media-query-general.css">	
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/general.css"> 
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/fonts.css">
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/be_header.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/be_general.css">
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/main-page-content.css">
	<script type="text/javascript" src="<?php echo $relativePath?>static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="page_container">

