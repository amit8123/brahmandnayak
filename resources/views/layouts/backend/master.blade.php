<!DOCTYPE html>
<html>
    <head>
        @include('layouts.backend.head')
    </head>
    @if(Auth::check() && Auth::user()->role == 'admin')
    <body class="admin-body">
        @include('layouts.backend.navigation.admin-navigation')

        @yield('page-content')

            </div><!-- /admin-content -->
            <footer class="admin-footer">
                &copy; {{ date('Y') }} BSSSP Mandir Trust &middot; Developed by
                <a href="http://ashhwa.in/" target="_blank">Ashhwa Enterprises</a>
            </footer>
        </div><!-- /admin-main -->

        @include('layouts.backend.scripts')
        <script>
            document.getElementById('sidebar-toggle').addEventListener('click', function () {
                document.getElementById('admin-sidebar').classList.toggle('open');
            });
        </script>
    </body>
    @else
    <body class="login-body">
        @yield('page-content')

        @include('layouts.backend.scripts')
    </body>
    @endif
</html>
