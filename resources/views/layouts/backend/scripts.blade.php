<!-- Scripts -->
<script type="text/javascript" src="{{ asset("assets/backend/js/jquery.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/backend/js/bootstrap.bundle.min.js") }}"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass('show');
        });

        return false;
    });

</script>
    {{-- <script>
        $(document).ready(function (e) {
                    // $(".media-gallery").lightGallery();
    
                    $(".owl-carousel").owlCarousel({
                        loop: true,
                        margin: 10,
                        nav: false,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        dots: false,
                        responsive: {
                            0: {
                                items: 1,
                            },
                            600: {
                                items: 3,
                            },
                            1000: {
                                items: 5,
                            },
                        },
                    });
    
                });
    </script> --}}
<!-- Custom scripts -->
@stack('scripts')