$(function ($) {
    "use strict";

    jQuery(document).ready(function () {
        /*------addClass/removeClass categories-------*/
        var w = window.innerWidth;

        if (w > 991) {
            /*categories slideToggle*/
            $(".categories_menu").on("mouseover", function () {
                $(this).addClass('active');
                $('.categories_menu_inner').stop().slideDown('medium');
            });
            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner > ul > li").on("mouseover", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').addClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });

            $(document).on('mouseover', function (e) {
                var container = $(".categories_menu_inner, .categories_mega_menu, .categories_title");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_title").removeClass('active');
                }
            });
        }

        /*------addClass/removeClass categories-------*/
        if (w <= 991) {
            $(".categories_title").on("click", function () {
                $(this).toggleClass('active');
                $('.categories_menu_inner').stop().slideToggle('medium');
            });
            /*------addClass/removeClass categories-------*/
            $(".categories_menu_inner > ul > li").on("click", function () {
                $(this).find('.link-area a').toggleClass('open').parent().parent().find('.categories_mega_menu, categorie_sub').toggleClass('open');
                $(this).siblings().find('.categories_mega_menu, .categorie_sub').removeClass('open');
            });

            $(document).on('click', function (e) {
                var container = $(".categories_menu_inner, .categories_mega_menu, .categories_title");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.categories_menu_inner').stop().slideUp('medium');
                    $('.categories_mega_menu, .categorie_sub').removeClass('open');
                    $(".categories_mega_menu").removeClass('open');
                    $(".categories_title").removeClass('active');
                }
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").on('click', function () {
                $(this).find('i').toggleClass('fa-plus').toggleClass('fa-minus');
            });

            $(".categories_menu_inner > ul > li.dropdown_list .link-area > a").each(function () {
                $(this).html('<i class="fas fa-plus"></i>');
            });
        }

        $(document).on('click','.hide-close',function(){
            $(this).parent().hide();
        });


        // Toggle Coupon Area
        $('#apply-coupon').on('click', function(){
            $('.coupon-form').addClass('d-block');
            $(this).addClass('d-none');
        });

        //   magnific popup activation Strat
        $('.video-play-btn, .play-video').magnificPopup({
            type: 'video'
        });

        $('.img-popup').magnificPopup({
            type: 'image'
        });
        //   magnific popup activation End

        

        // product-slider Start
        var $product_slider = $('.product-slider2');
        $product_slider.owlCarousel({
            loop: true,
            nav: true,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            dots: false,
            autoplay: false,
            margin: 30,
            autoplayTimeout: 4000,
            smartSpeed: 2000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 2
                }
            }
        });

      
       

   

    // back to top Start
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });
    // back to top End

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        if ($window.scrollTop() > 0) {
            $(".mainmenu-area").addClass('nav-fixed');
        } else {
            $(".mainmenu-area").removeClass('nav-fixed');
        }

        // back to top show / hide
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {

        // Preloader
        var preLoder = $("#preloader");
        preLoder.addClass('hide');
        var backtoTop = $('.back-to-top');

        // back to top
        var backtoTop = $('.bottomtotop');
        backtoTop.fadeOut(100);
    });

$('.language').on('change',function(){
    window.location = $(this).val();
})


    });

     });