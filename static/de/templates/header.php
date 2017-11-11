<link rel="shortcut icon" type="image/x-icon" href="./img/tab-icon2.jpg"> 
	<link rel="stylesheet" href="./css/swiper.min.css">
	<link rel="stylesheet" href="./css/media-query-general.css">	
	<link rel="stylesheet" href="./css/media-query-special.css">
	<link rel="stylesheet" href="./css/general.css"> 
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/header.css">
	<link rel="stylesheet" href="./css/main-page-content.css">
	<link rel="stylesheet" href="./css/old.css">
	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
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
						<a href="#">Shop</a>						
						<div class="navigation_wrapper level_2">
							<ul class="shop_components_wrapper col-3">
								<li class="navigation_element level_2 search">
								<a href="#">Search</a>
							</li>
							<li class="navigation_element level_2 customer_account">
								<a href="#">Ihr Konto</a>
								<ul class="navigation_wrapper level_3 account_operation">
									<li>
										<a href="<?php echo $project_dir?>account/index1">Anmelden</a>
									</li>
									<li>
										<a href="<?php echo $project_dir?>account/index2">Registerien</a>
									</li>
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
									<a href="#">Kinder</a>
								</li>
								<li class="navigation_element level_2">
									<a href="#">Home</a>
								</li>
								<li class="navigation_element level_2">
									<a href="#">Sale</a>
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