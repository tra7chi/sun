var SUN = SUN || {};
// var SUN.CASHMERE = SUN.CASHMERE || {};

(function() {

    $(function() {
        $('.navigation_element').on('click', function() {

            if($(this).hasClass('level_1')){
            	$('.navigation_element').removeClass('active');
            	
            }
            // else if($(this).hasClass('level_2') || $(this).hasClass('level_3')){
            // 	$(this).closest('.navigation_element').addClass('active');
            // }
            $(this).addClass('active');
        });

        // $('header .navigation_element.level_1').on('click', function(){
        //     $('header').removeClass('nav_is_expanded');
        //     $('#main_page_content').removeClass('move_down_60px');
        // });

        /**
         * if seond-level elements in navigation are clicked, 
         * then keep the navigation being expanded,
         * which menas move the main content downwards by 60px
         */
        $('header .navigation_element.level_2').on('click', function(){
            // $('header').addClass('nav_is_expanded');
            // $('#main_page_content').addClass('move_down_60px');
            if($(this).find('a').attr('href') == window.location.href){

            }
            console.log(window.location.href);
            console.log($(this).find('a').attr('href'));
            $('header').attr('class', 'nav_is_expanded');
            $('#main_page_content').attr('class', 'move_down_60px');
        });
        

        /**
         * if navigation is expanded via Mouse Hover, then move the main content 
         * downwards by 60px
         */
        // $('header .navigation_element.level_1').on({
        // 	'mouseenter': function(){
        //         $('#main_page_content').addClass('move_down_60px');
        // 		// if($(this).hasClass('level_1')){
	    //     	// 	$('.navigation_element.active > .navigation_wrapper').addClass('hidden');
	    //     	// 	$(this).addClass('visible');
        // 		// }
        // 	},
        // 	'mouseleave': function() {
        //         /**
        //          * only if the navigation is not clicked, then move up the main page content
        //          */
        //         if(!$('header').hasClass('nav_is_expanded')){
        //             $('#main_page_content').removeClass('move_down_60px');
        //         }
                
        // 		// $('.navigation_element.active > .navigation_wrapper').removeClass('hidden');
        // 		// $(this).removeClass('visible');
        // 	}
        // });

        
        
    });


})(SUN.CASHMERE);