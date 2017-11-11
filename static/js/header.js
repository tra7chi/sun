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

        // $('.navigation_element').on({
        // 	'mouseenter': function(){
        // 		if($(this).hasClass('level_1')){
	       //  		$('.navigation_element.active > .navigation_wrapper').addClass('hidden');
	       //  		$(this).addClass('visible');
        // 		}
        // 	},
        // 	'mouseleave': function() {
        // 		$('.navigation_element.active > .navigation_wrapper').removeClass('hidden');
        // 		$(this).removeClass('visible');
        // 	}
        // });
    });


})(SUN.CASHMERE);