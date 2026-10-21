(function ($) {
    "use strict";

    /*-------------------------------------------------------------------------------
  Preloader
    -------------------------------------------------------------------------------*/
    // hide as soon as the page structure is ready; images keep loading behind it
    $(function () {
        $(".sigma_preloader").addClass("hidden");
    });

    /*-------------------------------------------------------------------------------
  Subheader Trigger
  -------------------------------------------------------------------------------*/
    $(".subheader-toggler").on("click", function (e) {
        e.preventDefault();
        $(".sigma_subheader-extras").toggleClass("open");
    });

    /*-------------------------------------------------------------------------------
  volunteers Socials Trigger
  -------------------------------------------------------------------------------*/
    $("a.trigger-volunteers-socials").on("click", function (e) {
        e.preventDefault();
        $(this).closest(".sigma_sm").toggleClass("visible");
    });

    /*-------------------------------------------------------------------------------
  Cart Trigger
  -------------------------------------------------------------------------------*/
    $(".sigma_cart-trigger").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("cart-open");
    });

    /*-------------------------------------------------------------------------------
  Search Trigger
  -------------------------------------------------------------------------------*/
    $(".sigma_search-trigger").on("click", function (e) {
        e.preventDefault();
        $(".sigma_search-form-wrapper").toggleClass("open");
    });

    /*-------------------------------------------------------------------------------
  Aside Menu
  -------------------------------------------------------------------------------*/
    $(".aside-trigger-right").on("click", function () {
        var $el = $(".sigma_aside-right-panel");
        $el.toggleClass("open");
        if ($el.hasClass("open")) {
            setTimeout(function () {
                $el.find(".sidebar").fadeIn();
            }, 300);
        } else {
            $el.find(".sidebar").fadeOut();
        }
    });

    $(".aside-trigger-left").on("click", function () {
        $(".sigma_aside-left").toggleClass("open");
    });

    $(".sigma_aside .menu-item-has-children > a").on("click", function (e) {
        var submenu = $(this).next(".sub-menu");
        e.preventDefault();

        submenu.slideToggle(200);
    });

    /*-------------------------------------------------------------------------------
  Sticky Header
    -------------------------------------------------------------------------------*/
    var header = $(".can-sticky");
    var headerHeight = header.innerHeight();

    function doSticky() {
        if (window.pageYOffset > headerHeight) {
            header.addClass("sticky");
        } else {
            header.removeClass("sticky");
        }
    }
    doSticky();

    /*-------------------------------------------------------------------------------
  Tooltips
  -------------------------------------------------------------------------------*/
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    /*-------------------------------------------------------------------------------
  Magnific Popup
  -------------------------------------------------------------------------------*/
    $(".popup-youtube").magnificPopup({ type: "iframe" });
    $(".popup-vimeo").magnificPopup({ type: "iframe" });
    $(".popup-video").magnificPopup({ type: "iframe" });
    $(".gallery-thumb").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });

    /*-------------------------------------------------------------------------------
  ion Range Sliders (Price filter)
  -------------------------------------------------------------------------------*/
    $(".js-range-slider").ionRangeSlider();

    /*-------------------------------------------------------------------------------
  Countdown
  -------------------------------------------------------------------------------*/
    function makeTimer() {
        var endTime = new Date("01 January 2022 00:00:00 GMT+05:30");
        endTime = Date.parse(endTime) / 1000;
        var now = new Date();
        now = Date.parse(now) / 1000;
        var timeLeft = endTime - now;
        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - days * 86400) / 3600);
        var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
        var seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60);
        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }
        $(".days").html(days);
        $(".hours").html(hours);
        $(".minutes").html(minutes);
        $(".seconds").html(seconds);
    }
    setInterval(function () {
        makeTimer();
    }, 1000);

    /*-------------------------------------------------------------------------------
  Counter
  -------------------------------------------------------------------------------*/

    $(".counter").each(function () {
        var $this = $(this);
        $this.one("inview", function (event, isInView) {
            if (isInView) {
                $this.countTo({ speed: 2000 });
            }
        });
    });

    /*-------------------------------------------------------------------------------
  Checkout Notices
  -------------------------------------------------------------------------------*/
    $(".sigma_notice a").on("click", function (e) {
        e.preventDefault();

        $(this).closest(".sigma_notice").next().slideToggle();
    });

    /*-------------------------------------------------------------------------------
  Progress bar on view
  -------------------------------------------------------------------------------*/
    $(".sigma_progress-round").each(function () {
        var animateTo = $(this).data("to"),
            $this = $(this);
        $this.one("inview", function (event, isInView) {
            if (isInView) {
                $this.css({ "stroke-dashoffset": animateTo });
            }
        });
    });

    $(document).ready(function () {
        $(".sigma_progress").each(function () {
            var progressBar = $(this).find(".progress-bar");
            var progressCount = $(this).find(".sigma_progress-count");
            $(progressBar).one("inview", function (event, isInView) {
                if (isInView) {
                    $(progressBar).animate(
                        {
                            width: $(progressBar).attr("aria-valuenow") + "%",
                        },
                        function () {
                            $(progressCount).animate({
                                left: $(progressBar).attr("aria-valuenow") + "%",
                                opacity: 1,
                            });
                        }
                    );
                }
            });
        });
    });

    /*-------------------------------------------------------------------------------
  Testimonials slider
  -------------------------------------------------------------------------------*/
    $(".sigma_testimonial-slider").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $(".testimonial-section .slider-prev"),
        nextArrow: $(".testimonial-section .slider-next"),
        dots: false,
        autoplay: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });

    $(".sigma_testimonial-slider-1").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: true,
    });

    /*-------------------------------------------------------------------------------
  Dots Slider
  -------------------------------------------------------------------------------*/
    $(".basic-dot-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: true,
    });

    /*-------------------------------------------------------------------------------
  Banner slider (Home v3)
  -------------------------------------------------------------------------------*/
    $(".banner-3 .sigma_banner-slider, .banner-1 .sigma_banner-slider, .banner-2 .sigma_banner-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplay: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    arrows: false,
                },
            },
        ],
    });

    /*-------------------------------------------------------------------------------
  Product details slider
  -------------------------------------------------------------------------------*/
    $(".sigma_product-single-thumb .slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: ".sigma_product-single-thumb .slider-nav",
    });

    $(".sigma_product-single-thumb .slider-nav").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: ".sigma_product-single-thumb .slider",
        dots: false,
        centerMode: false,
        arrows: false,
        focusOnSelect: false,
    });

    /*-------------------------------------------------------------------------------
  portfolio slider
  -------------------------------------------------------------------------------*/
    $(".portfolio-slider").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplay: false,
        prevArrow: $(".portfolio-section .slider-prev"),
        nextArrow: $(".portfolio-section .slider-next"),
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });

    /*-------------------------------------------------------------------------------
  Masonry
  -------------------------------------------------------------------------------*/
    $(".masonry").imagesLoaded(function () {
        var isotopeContainer = $(".masonry");
        isotopeContainer.isotope({ itemSelector: ".masonry-item" });
    });

    /*------------------------------------------------------------------------------
  Isotope
  ------------------------------------------------------------------------------*/

    function doIsotope() {
        var $portfolioGrid = "";

        $(".masonry").imagesLoaded(function () {
            $portfolioGrid = $(".portfolio-filter").isotope({
                itemSelector: ".col-lg-4",
                percentPosition: true,
                masonry: {
                    columnWidth: ".col-lg-4",
                },
            });
        });

        $(".option-container").on("click", ".portfolio-trigger", function () {
            var filterValue = $(this).attr("data-filter");
            $portfolioGrid.isotope({ filter: filterValue });
        });

        $(".portfolio-trigger").on("click", function (e) {
            $(this).closest(".option-container").find(".active").removeClass("active");
            $(this).addClass("active");
            Event.preventDefault();
        });
    }

    doIsotope();

    /*-------------------------------------------------------------------------------
  Add / Subtract Quantity
  -------------------------------------------------------------------------------*/
    $(".qty span").on("click", function () {
        var qty = $(this).closest(".qty").find("input");
        var qtyVal = parseInt(qty.val());
        if ($(this).hasClass("qty-add")) {
            qty.val(qtyVal + 1);
        } else {
            return qtyVal > 1 ? qty.val(qtyVal - 1) : 0;
        }
    });

    /*-----------------------------------
    Back to Top
    -----------------------------------*/

    function stickBackToTop() {
        if (window.pageYOffset > 400) {
            $(".sigma_top").addClass("active");
        } else {
            $(".sigma_top").removeClass("active");
        }
    }
    stickBackToTop();

    $("body").on("click", ".sigma_top", function () {
        $("html, body").animate(
            {
                scrollTop: 0,
            },
            600
        );
        return false;
    });

    // init wow js
    new WOW().init();

    //On scroll events
    $(window).on("scroll", function () {
        doSticky();

        // Back to top
        stickBackToTop();
    });

    //On resize events
    $(window).on("resize", function () {});
})(jQuery);

function donation() {
    return {
        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        donationList: [
            {
                image: {
                    src: "assets/img/donation/5.jpg",
                    name: "Protecting children image",
                },
                title: {
                    content: "Protecting Children",
                    url: "donation.html",
                },
                description: "Temple is place where hindu worship consectetur \n adipisicing \nelit, sed do",
                progress: {
                    raised: "52384",
                    goal: "85000",
                },
            },
            {
                image: {
                    src: "assets/img/donation/6.jpg",
                    name: "Donate Ngos image",
                },
                title: {
                    content: "Donate Ngos",
                    url: "donation.html",
                },
                description: "Temple is place where hindu worship consectetur \n adipisicing \nelit, sed do",
                progress: {
                    raised: "49444",
                    goal: "78000",
                },
            },
            {
                image: {
                    src: "assets/img/donation/7.jpg",
                    name: "Feed Poors image",
                },
                title: {
                    content: "Feed Poors",
                    url: "donation.html",
                },
                description: "Temple is place where hindu worship consectetur \n adipisicing \nelit, sed do",
                progress: {
                    raised: "78334",
                    goal: "96400",
                },
            },
        ],
    };
}

// Audio module
window.addEventListener("load", function () {
    var audio = document.getElementById("tah_audio");
    var btn = document.getElementById("dv-audio-btn");
    if (!audio || !btn) return;
    var icon = btn.querySelector(".dv-player-icon i");

    // reflect the real audio state (browsers often block autoplay)
    function render() {
        var playing = !audio.paused;
        btn.classList.toggle("is-playing", playing);
        btn.setAttribute("aria-pressed", playing ? "true" : "false");
        icon.className = playing ? "fas fa-pause" : "fas fa-play";
    }
    audio.addEventListener("play", render);
    audio.addEventListener("pause", render);
    render();

    // start the mantra only after the page has loaded, so the mp3 does not slow it down
    audio.play().catch(function () {});

    btn.addEventListener("click", function () {
        if (audio.paused) {
            audio.play().catch(function () {});
        } else {
            audio.pause();
        }
    });
});
// play/pause button

// Dynamically create and add marquee tag
const marquee_attributes = (ele) => {
    ele.direction = "left";
    // ele.width = "100%";
    // ele.height = "80";

    ele.setAttribute("scrollamount", "5"); // Set the scrollamount.
    // ele.setAttribute("style", "color: red; font-family: Calibri;"); // Set text color and font.

    // Retrieve the text from the h2 element
    const p = document.getElementById("test");
    ele.innerHTML = p.innerHTML; // Assign the text from h2 to the marquee

    let div = document.getElementById("audio-name");
    div.appendChild(ele);
};

// Create marquee element
const create_marquee = () => {
    let el = document.createElement("marquee");
    marquee_attributes(el);
};

create_marquee();
