<?php
if($_SERVER['SERVER_ADDR'] == '127.0.0.1'){
	$project_dir = "/sun-cashmere/";
}
else{
	$project_dir = "/";
}
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
?>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $relativePath?>static/img/tab-icon2.jpg"> 
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/swiper.min.css">
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/media-query-general.css">	
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/media-query-special.css">
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/general.css"> 
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/fonts.css">
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/header.css">
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/main-page-content.css">
<link rel="stylesheet" href="<?php echo $relativePath?>static/css/old.css">

<link rel="stylesheet" type="text/css" href="<?php echo $relativePath?>static/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $relativePath?>static/css/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $relativePath?>static/css/jssocials-theme-flat.css" />

<script type="text/javascript" src="<?php echo $relativePath?>static/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $relativePath?>static/js/jssocials.min.js"></script>
<script type="text/javascript" src="<?php echo $relativePath?>static/js/header.js"></script>
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
                        <li class="navigation_element level_1 navi_collection">
                            <a href="#">Kollektion</a>
                            <ul class="navigation_wrapper level_2">
                                <li class="navigation_element level_2">
                                    <a href="#">2017 Herbst/Winter</a>
                                </li>
                            </ul>
                        </li>
                        <li class="navigation_element level_1 navi_shop">
                             <a href="<?php echo $project_dir?>product/index/">Shop</a>						
                            <div class="navigation_wrapper level_2">
                                <ul class="shop_components_wrapper col-3">
                                    <li class="navigation_element level_2 search">
                                    <a href="#">Search</a>
                                </li>
                                <li class="navigation_element level_2 customer_account">
                                    <a href="#">Ihr Konto</a>
                                    <ul class="navigation_wrapper level_3 account_operation">
                                        <?php if(!isset($_COOKIE['customer_id'])){?>
                                        <li>
                                            <a href="<?php echo $project_dir?>account/index1">Anmelden</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $project_dir?>account/index2">Registerien</a>
                                        </li>
                                        <?php }else{ ?>
                                         <li>
                                            <a href="<?php echo $project_dir?>customer/customer_order">Meine Bestellungen</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $project_dir?>customer/wish_list">Meine Wunschlist</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $project_dir?>customer/">Bestellungensadresse</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $project_dir?>customer/password">Passwort &auml;ndern</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $project_dir?>account/logout">Abmelden</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                </ul>
                                <ul class=" col-6">
                                    <li class="navigation_element level_2 navi_shop_women">
                                        <a href="<?php echo $project_dir?>product/index/sdfsr32refsa">Damen</a>
                                    </li>
                                    <li class="navigation_element level_2 navi_shop_men">
                                        <a href="<?php echo $project_dir?>product/index/32refsadfqre">Herren</a>
                                    </li>
                                    <li class="navigation_element level_2 nav_shop_kids">
                                        <a href="<?php echo $project_dir?>product/index/1e78e6af5c86">Kinder</a>
                                    </li>
                                    <li class="navigation_element level_2 navi_shop_home">
                                        <a href="<?php echo $project_dir?>product/index/2295678a6596">Home</a>
                                    </li>
                                    <li class="navigation_element level_2 navi_shop_sale">
                                        <a href="<?php echo $project_dir?>product/index/038d3e7b8c7a">Sale</a>
                                    </li>
                                </ul>
                                <ul class="shop_components_wrapper col-1">
                                    <li class="navigation_element level_2 shopping_cart">
                                        <a href="#" id="header_cart" class="black_button" >0</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="navigation_element level_1 ">
                            <a href="#">Unternehmen</a>
                            <ul class="navigation_wrapper level_2 ">
                                <li class="navigation_element level_2 navi_about_us ">
                                    <a href="<?php echo $project_dir?>static/de/company/about-us.php">&Uuml;ber uns</a>
                                </li>
                                <li class="navigation_element level_2 navi_fiber ">
                                    <a href="#">Fiber</a>
                                </li>
                                <li class="navigation_element level_2 navi_production ">
                                    <a href="#">Produktion</a>
                                </li>
                                <li class="navigation_element level_2 navi_contact">
                                    <a href="#">Kontak</a>
                                </li>
                            </ul>
                        </li>
                        <li class="navigation_element level_1 ">
                            <a href="#">Presse</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header_element header_meta_area col-2">
                <a href="#" class="multi_language">EN</a>
            </div>
        </div>
    </header>