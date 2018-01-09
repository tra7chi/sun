var SUN = SUN || {};
// var SUN.CASHMERE = SUN.CASHMERE || {};

(function() {

    $(function() {
        let clickedPointLevel2 = localStorage.getItem('clickedPointLevel2');
        if(clickedPointLevel2 !== null && clickedPointLevel2 !== '') {
            // $('header').addClass('nav_is_expanded');
            $('header .level_2.' + clickedPointLevel2).addClass('active');
            $('header .level_2.' + clickedPointLevel2).closest('.level_1').addClass('active');
            $('#main_page_content').addClass('move_down_60px');            
        }
        // else if(clickedPointLevel2 === null || clickedPointLevel2 === '') {
        //     let clickedPointLevel1 = localStorage.getItem('clickedPointLevel1');
        //     if(clickedPointLevel1 !== null && clickedPointLevel1 !== '') {
        //         $('header').removeClass('nav_is_expanded');
        //         $('header .level_1.' + clickedPointLevel2).addClass('active');
        //         $('#main_page_content').removeClass('move_down_60px');  
        //     }
        // }
        let clickedPointLevel1 = localStorage.getItem('clickedPointLevel1');
        if(clickedPointLevel1 !== null && clickedPointLevel1 !== '') {
            // $('header').addClass('nav_is_expanded');
            $('#main_page_content').addClass('move_down_60px'); 
            // $('header').removeClass('nav_is_expanded');
            $('header .level_1.' + clickedPointLevel1).addClass('active');
            // $('#main_page_content').removeClass('move_down_60px');  
        }

        // $('header .navigation_element.level_1').on('click', function() {
        //     let navClass = $(this).attr('class').match(/navi_\w+/);
        //     localStorage.setItem('clickedPointLevel1', navClass);
        //     localStorage.removeItem('clickedPointLevel2');
        // });

        // $('header .navigation_element.level_1').on('click', function(){
        //     $('header').removeClass('nav_is_expanded');
        //     $('#main_page_content').removeClass('move_down_60px');
        // });

        /**
         * if seond-level elements in navigation are clicked, 
         * then keep the navigation being expanded,
         * which menas move the main content downwards by 60px
         */
        // $('header .navigation_element.level_2').on('click', function(e){
        //     let navClass = $(this).attr('class').match(/navi_\w+/);
        //     localStorage.setItem('clickedPointLevel2', navClass);            
        // });

        $('header .navigation_element').on('click', function(e){
            let navClass = $(this).attr('class').match(/navi_\w+/);
            if($(this).hasClass('level_2')) {
                localStorage.setItem('clickedPointLevel2', navClass);
            }
            if($(this).hasClass('level_1')) {
                localStorage.setItem('clickedPointLevel1', navClass);
            }        
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