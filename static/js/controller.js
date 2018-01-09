var SUN = SUN || {};
// var SUN.CASHMERE = SUN.CASHMERE || {};

(function() {

    $(function() {
        var swiperContainer = $('.about_us_content .page_content_box.static .swiper-container');
        var swiperPagination = $('.about_us_content .page_content_box.static .swiper-container .swiper-pagination');
        var swiperNavPrev = $('.about_us_content .page_content_box.static .swiper-container .swiper-button-prev');
        var swiperNavNext = $('.about_us_content .page_content_box.static .swiper-container .swiper-button-next');
        var mySwiper = new Swiper(swiperContainer, {
            pagination: {
                el: swiperPagination,
                type: 'bullets',
                clickable: true,
            },
            navigation: {
                prevEl: swiperNavPrev,
                nextEl: swiperNavNext,
            },
            speed: 800,
            spaceBetween: 40,
            loop: true,
            centeredSlides: true,
            slidesPerView: 1,
            allowSlidePrev: true,
            allowSlideNext: true,
        });
    });
})(SUN.CASHMERE);