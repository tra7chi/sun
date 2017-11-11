var SUN = SUN || {};
// var SUN.CASHMERE = SUN.CASHMERE || {};

(function() {

    $(function() {


        // $('.navi_about_us').on('click', function() {
        //     $('#main_page_content .main_container').load('de/company/about-us.php');

        // });

        //     var counter = 0;
        //     var swiperInit = setInterval(function() {
        //         if (counter < 5) {
        //             var swiperContainer = $('.about_us_content .page_content_box.static .swiper-container');
        //             var mySwiper = new Swiper(swiperContainer, {
        //                 speed: 5000,
        //                 spaceBetween: 0,
        //                 loop: true,
        //                 autoplay: 5,
        //                 autoplayDisableOnInteraction: true,
        //                 slidesPerView: 1,
        //                 paginationClickable: true
        //             });
        //             counter++;
        //         }
        //     }, 500);
        // });

        var swiperContainer = $('.about_us_content .page_content_box.static .swiper-container');
        var mySwiper = new Swiper(swiperContainer, {
            speed: 5000,
            spaceBetween: 0,
            loop: true,
            autoplay: 5,
            autoplayDisableOnInteraction: true,
            slidesPerView: 1,
            paginationClickable: true
        });
    });
})(SUN.CASHMERE);