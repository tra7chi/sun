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
if(!isset($_SESSION)){
	session_start();
}
$originator = mt_rand(0, 1000000);
$_SESSION['originator'] = $originator;
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sun-Cashmere</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $relativePath?>static/img/tab-icon2.jpg"> 
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/general.css"> 
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/fonts.css">
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/be_header.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/be_general.css">
	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/main-page-content.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/media-query-general.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/old.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/jquery-ui.structure.min.css">
   	<link rel="stylesheet" href="<?php echo $relativePath?>static/css/jquery-ui.theme.css">
    <link rel="stylesheet" href="<?php echo $relativePath?>static/css/jquery-ui-timepicker-addon.css">
	<script type="text/javascript" src="<?php echo $relativePath?>static/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="page_container">
<header>
	<div class="header_container">
		<div class="header_element company_logo col-2">
			<a href="/" >
				<img src="<?php echo $relativePath?>static/img/LOGO.png" />
			</a>
		</div>
		<div class="header_element header_navigation col-8">
			<nav>
				<ul class="navigation_wrapper level_1">
					<li class="navigation_element level_1 ">
						<a href="#">Kunden Verwaltung</a>
						<ul class="navigation_wrapper level_2">
							<li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_account/manage">Kunden Hinzuf&uuml;gen</a>
							</li>
                            <li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_account/index">Kunden &Auml;ndrung</a>
							</li>
						</ul>
					</li>
					<li class="navigation_element level_1 ">
						<a href="#">Men&uuml; Verwaltung</a>						
                        <ul class="navigation_wrapper level_2">
                            <li class="navigation_element level_2">
                                <a href="<?php echo PROJECT_DIR?>BE_category/manage1">1-Ebene Men&uuml; Hinzuf&uuml;gen</a>
                            </li>
                            <li class="navigation_element level_2">
                                <a href="<?php echo PROJECT_DIR?>BE_category/index1">1-Ebene Men&uuml; &Auml;nderung</a>
                            </li>
                            <li class="navigation_element level_2">
                                <a href="<?php echo PROJECT_DIR?>BE_category/manage2">2-Ebene Men&uuml; Hinzuf&uuml;gen</a>
                            </li>
                            <li class="navigation_element level_2">
                                <a href="<?php echo PROJECT_DIR?>BE_category/index2">2-Ebene Men&uuml; &Auml;nderung</a>
                            </li>
                        </ul>
					</li>
					<li class="navigation_element level_1 ">
						<a href="#">Produkt Verwaltung</a>
						<ul class="navigation_wrapper level_2 ">
							<li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_product/manage">Produkt Hinzuf&uuml;gen</a>
							</li>
							<li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_product/">Produkt &Auml;nderung</a>
							</li>
                            <li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_product/photo_manage">Produkt Foto &Auml;nderung</a>
							</li>
						</ul>
					</li>
                    <li class="navigation_element level_1 ">
						<a href="#">Bestellungen Verwaltung</a>
						<ul class="navigation_wrapper level_2 ">
							<li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_order/manage">Bestellungen Hinzuf&uuml;gen</a>
							</li>
							<li class="navigation_element level_2">
								<a href="<?php echo PROJECT_DIR?>BE_order/">Bestellungen &Auml;nderung</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		<div class="header_element header_meta_area col-2">
			 <a href="<?php echo PROJECT_DIR?>BE_login/logout" class="multi_language">Abmeldung</a>
		</div>
	</div>
</header>
