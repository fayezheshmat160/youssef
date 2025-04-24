/* -----------------------------------------------
					Js Main
--------------------------------------------------
    Template Name: NoonPost. - Personal Blog HTML Template
--------------------------------------------------

Table of Content

	. Preloader
    . Navigation
    . Search
    . Back-top
    . Carousel-hero

----------------------------------- */

(function ($) {
    "use strict";

    $("[rel=next]").text("").append('<i class="fa-solid fa-angle-left"></i>');
    $("[rel=prev]").text("").append('<i class="fa-solid fa-angle-right"></i>');

    // Toastr Alert
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "3000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    /* -----------------------------------
            Preloader
    ----------------------------------- */
    $(".loading").delay(500).fadeOut(500);

    /*
    |
    | Lazy Load Image
    | Chnage Image src to => data-src
    | And Set Class lazy in img class like
    | Output => <img class="lazy" data-src="" />
    */
    let lazy = $(".lazy");
    if (lazy.length > 0) {
        $(".lazy").lazy();
    }

    /* -----------------------------------
            Navigation
    ----------------------------------- */
    $(window).on("scroll", function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar").addClass("navbar-scroll");
        } else {
            $(".navbar ").removeClass("navbar-scroll");
        }
    });

    $(".navbar-toggler").on("click", function () {
        $(".navbar-collapse").collapse("show");
    });

    /* -----------------------------------
           Search
    ----------------------------------- */
    $(".search-icon").on("click", function () {
        $(".search").addClass("search-open");
    });
    $(".close").on("click", function () {
        $(".search").removeClass("search-open");
    });

    /* -----------------------------------
           Back-top
    ----------------------------------- */
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 250) {
            $(".back-top").fadeIn(300);
        } else {
            $(".back-top").fadeOut(300);
        }
    });

    $(".back-top").on("click", function (event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 300);
        return false;
    });

    /* -----------------------------------
       Carousel-hero
    -----------------------------------*/
    $(".carousel-hero .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 0,
        margin: 0,
        nav: true,
        autoplay: true,
        center: false,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                items: 1,
            },
        },
    });
    /* -----------------------------------
        post-single-gellery
    -----------------------------------*/
    $(".post-single-gallery .owl-carousel").owlCarousel({
        loop: true,
        stagePadding: 5,
        margin: 30,
        nav: false,
        autoplay: true,
        center: false,
        dots: true,
        mouseDrag: true,
        touchDrag: true,
        smartSpeed: 1000,
        autoplayHoverPause: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1200: {
                margin: 30,
                items: 1,
            },
        },
    });
})(jQuery);
