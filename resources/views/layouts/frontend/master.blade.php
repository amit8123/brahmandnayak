<!DOCTYPE html>
<html lang="en" dir="ltr" xml:lang="en-MR">

<head>
    @include('layouts.frontend.head')
</head>

<body>
    @include('layouts.frontend.navigation')
    @yield('page-content')
    @include('layouts.frontend.footer')

    <!-- partial:partia/__scripts.html -->
        {{-- <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="{{ asset('assets/frontend/js/plugins/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/imagesloaded.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.zoom.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.inview.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/jquery.event.move.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/wow.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/slick.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins/ion.rangeSlider.min.js') }}"></script>

        <script src="{{ asset('assets/frontend/js/main.js') }}?v=3"></script>
        <script src="{{ asset('assets/frontend/js/divine.js') }}?v=2"></script>

        <!-- partial -->
    {{-- <script>
      $(document).ready(function(){
    	
                //Check to see if the window is top if not then display button
                $(window).scroll(function(){
    
                    // Show button after 100px
                    var showAfter = 100;
                    if ($(this).scrollTop() > showAfter) {                 
                        $('.back-to-top').fadeIn();
                    } else {   
                        $('.back-to-top').fadeOut();
                    }
                });
                
                //Click event to scroll to top
                $('.back-to-top').click(function(){
                    $('html, body').animate({scrollTop : 0},800);
                    return false;
                });
                
            });
    </script> --}}

    {{-- <a href="#" class="back-to-top"></a> --}}
    @stack('scripts')

</body>

</html>
