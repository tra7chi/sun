$(document).ready(function() {
	
	//$('body').delay(200).fadeTo(1300, 1);
	
	var page = $("html, body");
	
	page.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function(){
		page.stop();
	});
    
    initCookieInfo();
    initNav();
    initHotline();
    initNewsletter();
    initSpecialLayer();
    
	var $to = false;
	
	if ($(window).width() < 768) {
		$(window).scroll(function(){
			$('.hl_open').fadeOut();
			clearTimeout($to);
			$to = setTimeout(function(){
				$('.hl_open').fadeIn();
			}, 1000);
		});
	}
});

function initSpecialLayer() {
	if ($('.load_layer').length) {
	    
	    var $show_it = true;
	    
	    if ($('.load_layer').data('expires')) {
		    if ($.cookie('special_layer_shown') == 1) {
			    $show_it = false;
		    }
	    }
	    
	    if ($show_it) {
		    
		    if ($('.load_layer').find('img').length) {
			    $('.load_layer').addClass('load_layer_img');
		    }
		    
			$('.load_layer').lightbox_me({
				centered: true,
				overlayCSS: {
					background: 'black', 
					opacity: .7
				},
				onLoad: function(){
					$.cookie('special_layer_shown', 1, { path: '/' });
				}
			});
		}
	}
}

function initCookieInfo() {
	
	function openCookieInfo() {
		
		$.cookie('cookie_info_shown', 1, { path: '/' });
		
		$('.cookie_info').css({
			height: 'auto'
		});
		
		var $ci_height = $('.cookie_info').outerHeight();
		
		$('.cookie_info').delay(300).animate({
			height: $ci_height,
			opacity: 1
		}, 300);
		
		$('header, .main_nav > ul > li > ul, .header_cart_btn').animate({
			marginTop: $ci_height
		}, { duration: 500, queue: false });
		
		$('.header_placeholder').animate({
			paddingTop: $ci_height
		}, { duration: 500, queue: false });
	}
	
	function closeCookieInfo() {
		
		$.cookie('cookie_info_closed', 1, { expires: 365, path: '/' });
		
		$('.cookie_info').animate({
			opacity: 0,
			height: 0
		}, 300);
		
		$('header, .main_nav > ul > li > ul, .header_cart_btn').animate({
			marginTop: 0
		}, { duration: 500, queue: false });
		
		$('.header_placeholder').animate({
			paddingTop: 0
		}, { duration: 500, queue: false });
	}
	
	if ($.cookie('cookie_info_shown') != 1 && $.cookie('cookie_info_closed') != 1) {
		setTimeout(function(){
			openCookieInfo();
		}, 1000);
	}
	
	$('.close_cookie_info').click(function(){
		
		closeCookieInfo();
	});
}

function initNewsletter() {
	
	var $timeout = 5000;
	if ($.cookie('cookie_info_shown') != 1 && $.cookie('cookie_info_closed') != 1) {
		$timeout = 30000;
	}
	
	if ($.cookie('newsletter_layer_shown') != 1 && $.cookie('dont_show_newsletter_layer') != 1 && $('.load_layer').length == 0) {
		setTimeout(function(){
			openNewsletterLayer()
		}, $timeout);
	}
	
	function openNewsletterLayer() {
		$('.newsletter_layer').lightbox_me({
			centered: true,
			overlayCSS: {
				background: 'black', 
				opacity: .7
			},
			onLoad: function(){
				$.cookie('newsletter_layer_shown', 1, { path: '/' });
			}
		});
		
	}
	
	$('#hide_next').change(function(){
		if ($('#hide_next').prop('checked')) {
			$.cookie('dont_show_newsletter_layer', 1, { expires: 365, path: '/' });
		} else {
			$.cookie('dont_show_newsletter_layer', 0, { expires: 365, path: '/' });
		}
	});
	
	$('.open_newsletter_layer').click(function(){
		openNewsletterLayer();
		closeMobileNav();
		return false;
	});
	
	if ($.cookie('dont_show_newsletter_layer') == 1) {
		$('#hide_next').prop('checked', true);
	}
	
	var $form = $('.newsletter_form');
	$form.validate({
		errorPlacement: function(error, element) {
	    	return true;
		},
		submitHandler: function(form){
			$('.newsletter_layer').trigger('close');
			form.submit();
			
		}
	});
}

function initNav() {
	
	window.addEventListener("orientationchange", function() {
		location.reload();
	}, false);
	
/*
	var $img_load = imagesLoaded( 'body');
	$img_load.on('always', function() {
		$('.main_loader').delay(800).fadeOut(400);
	});
*/
	
	initCurrent();
	
	if ($(window).width() > 1023) {
		
		$('.main_nav > ul > li.current > ul, .main_nav > ul > li.current > .specials').stop(true, true).delay(200).fadeIn(300);
		
		$('.main_nav > ul > li').hover(function(){
			$('.main_nav > ul > li.current > ul, .main_nav > ul > li.current .specials').stop(true, true).delay(200).fadeOut(300);
			$(this).children('ul, .specials').stop(true, true).delay(400).fadeIn(300);
		},function(){
			$(this).children('ul, .specials').stop(true, true).delay(600).fadeOut(500);
			$('.main_nav > ul > li.current > ul, .main_nav > ul > li.current .specials').stop(true, true).delay(200).fadeIn(300);
		});
		
		$('.specials > ul > li').hover(function(){
			$(this).children('ul').delay(100).slideDown(200);
		},function(){
			$(this).children('ul').slideUp(200);
		});
		
		$('.main_nav > ul > li > ul > li').hover(function(){
			$(this).children('ul').stop(true, true).delay(400).slideDown(300);
		},function(){
			$(this).children('ul').stop(true, true).delay(200).slideUp(300);
		});
	} else {
		
		$('.main_nav > ul li').each(function(){
			var $link = $(this).children('a');
			$(this).children('ul').prepend('<li><a href="'+ $link.attr('href') +'">Start</a></li>')
		});
		
		function setNhTitle($clicked_element, $dir) {
			
			function getNhTitleLink($element) {
				return '<a href="'+ $element.attr('href') +'">'+ $element.html() +'</a>';
			}
				
			var $title = '<strong>' + getNhTitleLink($clicked_element) + '</strong>';
			
			if ($clicked_element.parents('.ul_open').length) {
				$title = '<strong>' + getNhTitleLink($clicked_element.parents('.ul_open').prev('a')) + '</strong> / ' + getNhTitleLink($clicked_element);
			}
			
			
			
			if (!$clicked_element.length) {
				$title = '<strong>Menu</strong>';
				$('.nh_back').fadeOut();
			} else {
				$('.nh_back').fadeIn();
			}
			
			$('.nh_title').animate({
				marginLeft: -60 * $dir,
				opacity: 0
			}, 200, function(){
				
				$('.nh_title').html($title);
				
				$('.nh_title').css({
					marginLeft: 60 * $dir
				});
				$('.nh_title').animate({
					marginLeft: 0,
					opacity: 1
				}, 200);
			});
			
			if ($clicked_element.next('ul').find('.header_search').length || $clicked_element.parents('ul#navigation').find('.header_search').length) {
				$('.nh_search').fadeIn();
			} else {
				$('.nh_search').fadeOut();
			}
		}
		
		$('.specials').each(function(){
			var $specials = $(this);
			$(this).find('ul li ul li').each(function(){
				$(this).addClass('regular');
				$specials.parent('li').find('ul#navigation').append($(this));
			});
			
			$specials.parent('li').find('ul#navigation').prepend($specials.find('.header_search'));
		});
		
		$('.main_nav ul li a').click(function(){

			if ($(this).next('ul').length) {
				
				setNhTitle($(this), 1);
				
				$(this).parents('ul').animate({
					marginLeft: -60
				}, 300);
				
				$('.meta_nav ul').animate({
					marginLeft: -60
				}, 300);
				
				$(this).next('ul').addClass('ul_open');
				
				$(this).next('ul').animate({
					left: 0
				}, 500, 'easeInOutQuart');
				
				return false;
			}
		});
		
		$('.nh_back').click(function(){
			var $last_ul = $('.ul_open');
			
			if ($last_ul.find('.ul_open').length) {
				$last_ul = $('.ul_open .ul_open');
			}
			
			setNhTitle($last_ul.parents('ul').prev('a'), -1);
			
			$last_ul.removeClass('ul_open');
			
			$last_ul.parent('li').parent('ul').animate({
				marginLeft: 0
			}, 300);
			$('.meta_nav ul').animate({
				marginLeft: 0
			}, 300);
			
			$last_ul.animate({
				left: '110%'
			}, 500, 'easeInOutQuart');
			return false;
		});
		
		$('.nh_close').click(function(){
			closeMobileNav();
		});
		
		$('.nh_search').click(function(){
			if($(this).hasClass('hs_open')) {
				$(this).removeClass('hs_open')
				$('.header_search').slideUp();
			} else {
				$(this).addClass('hs_open')
				$('.header_search').slideDown();
			}
		});
	}
	
	$('.header_search input').focus(function(){
		$('.header_search').addClass('header_search_active');
		$('.mobile_menu_btn').addClass('mobile_menu_btn_black');
	});
	
	$('.header_search input').focusout(function(){
		$('.header_search').removeClass('header_search_active');
		$('.mobile_menu_btn').removeClass('mobile_menu_btn_black');
	});
	

	$('.mobile_menu_btn').click(function(){
		
		if (!$(this).hasClass('mobile_menu_open')) {
			
			$(this).addClass('mobile_menu_open');
			
			$('.navis, .navi_header').animate({
				left: 0
			}, 700, 'easeInOutQuart');
			
			$('body,html').css({
				overflow: 'hidden'
			});
		}
		return false;
	});

}

function closeMobileNav() {
	$('.mobile_menu_btn').removeClass('mobile_menu_open');
	
	$('.navis, .navi_header').animate({
		left: '110%'
	}, 700, 'easeInOutQuart');
	
	$('body,html').css({
		overflow: ''
	});
}

function initCurrent() {
	var $path = window.location.href;
	
	if ($path.length > 4) {
	
		$('.main_nav ul li').each(function(){
			var $active = false;
			$(this).find('ul li').each(function(){
				var $link = $(this).find('a').attr('href');
				if ($link == $path) {
					
					$(this).addClass('current');
					$active = true;
				}
			});
			
			var $link = $(this).find('a').attr('href');
			if ($link == $path) {
				$(this).addClass('current');
			}
			
			if ($active) {
				$(this).addClass('current');
			}
		});
	}
	
	var $pathname = window.location.pathname;
	
	if ($pathname.length <= 3) {
		$('body').addClass('closed_subnav');
	}
}

function initHotline() {
	
	$('.hotline').css({
		right: - $('.hotline').width() - 50,
		display: 'block'
	});
	
	$('.hl_open').click(function(){
		$('.hotline').animate({
			right: 0
		});
	});
	$('.hl_close').click(function(){
		$('.hotline').animate({
			right: - $('.hotline').width() - 50
		});
	});
	
	$(window).resize(function(){
		if ($(window).width() > 1024) {
			$('.hotline').css({
				right: - 350
			});
		} else {
			$('.hotline').css({
				right: - $(window).width()
			});
		}

	});
}