$(document).ready(function(){

    var header_navigation_html = localStorage.getItem('header_navigation_html') || $('.header_navigation').html();
    $('.header_navigation').html(header_navigation_html);

    $('.header_navigation ul li a').click(function(e){
           e.preventDefault();   
           // clear active class firstly for all navigation elements
           $('.header_navigation ul li a').parent().removeClass('is-active');

           $(this).parent().addClass('is-active');
           localStorage.setItem('header_navigation_html', $('.header_navigation').html());
           window.location = $(this).attr('href');
        });   
});