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

if(!isset($_SESSION)){
	session_start();
}
$originator = mt_rand(0,1000000);
$_SESSION['originator'] = $originator;
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


<link rel="stylesheet" type="text/css" href="<?php echo $relativePath?>static/css/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $relativePath?>static/css/jssocials-theme-flat.css" />
<style>
.cart_view_windows{
	position:absolute;
	width:100%;
	height:100%;
	left:0;
	top:0;
	background-color: rgba(0,0,0,0.1);
	display:none;
}
.cart_product_div{
    display: inline-block;
    width: 10%;
    margin: 1%;
    vertical-align: top;
	
}
.cart_product_div div{
	width:100%;
	font-size:1.2rem;
	text-align:center;	
}
.cart_view_container{
	position: absolute;
    top: 10rem;
    left: 0;
    width: 100%;
	height:20rem;
    z-index: 1000;
	background-color:#FFF;
}
.cart_view_cell1{
    position: absolute;
    left: 0;
    top: 0;
    width: 60%;
    height: 100%;
    font-size: 1.2rem;
    text-align: center;
}
.cart_view_cell2{
	position:absolute;
	left:61%;
	top:0;
	width:39%;
	height:100%;
	font-size:1.2rem;
}
#cart_view_container_close{
	width: 3rem;
	height: 3rem;
	background-color: #000;
	right: 0;
	top: 0;
	position: absolute;
	color: white;
	text-align: center;
	line-height: 3rem;
}
</style>
<script type="text/javascript" src="<?php echo $relativePath?>static/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $relativePath?>static/js/jssocials.min.js"></script>
<script>
$(function(){
	setCart();
	$('#header_cart').click(function(){
		$('.cart_view_windows').show();
	});
	$('#cart_view_container_close').click(function(){
		$('.cart_view_windows').hide();
	});
	$('.to_cart').click(function(){
		window.location.href = $('#PROJECT_DIR').val() + 'order/cart';
	});
	$('#to_check_out').click(function(){
		window.location.href = $('#PROJECT_DIR').val() + 'order/validate';
	});
});	
function setCart(){
	var url = $('#PROJECT_DIR').val() + "Cart/setCartView"; 
	$.post(url,function(data){
		var info = data.split("##^^$$");
		$('#cart_view').html(info[0]);
		$('#header_cart').html(info[1]);
		$('#sum_money').html(info[2]);	
	});
}
</script>
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
                                <ul class="col-6">
                                    <li class="navigation_element level_2">
                                        <a href="<?php echo $project_dir?>product/index/sdfsr32refsa">Damen</a>
                                    </li>
                                    <li class="navigation_element level_2">
                                        <a href="<?php echo $project_dir?>product/index/32refsadfqre">Herren</a>
                                    </li>
                                    <li class="navigation_element level_2">
                                        <a href="<?php echo $project_dir?>product/index/1e78e6af5c86">Kinder</a>
                                    </li>
                                    <li class="navigation_element level_2">
                                        <a href="<?php echo $project_dir?>product/index/2295678a6596">Home</a>
                                    </li>
                                    <li class="navigation_element level_2">
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
<div class="cart_view_windows" >    
<div class="cart_view_container">
    <div class="cart_view_cell1" id="cart_view"></div>
    <div class="cart_view_cell2">
        <div id="cart_view_container_close">X</div>
        GESAMTBETRAG: <span id="sum_money"></span> &euro;
        <div class="button1"><input id="to_cart2" class="black_button to_cart" value="WARENKORB ZEIGEN" /></div>
        <div class="button1"><input id="to_check_out" class="black_button" value="ZUR KASSE" /></div>
    </div>
</div>
</div>
<input type="hidden" id="PROJECT_DIR" name="PROJECT_DIR" value="<?php echo PROJECT_DIR?>">    