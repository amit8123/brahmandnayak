<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('assets/backend/line-awesome/css/line-awesome.min.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('assets/backend/css/mdc.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/common.css')}}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/navigation.css')}}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/plugins/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/admin-theme.css')}}">
<style type="text/css">
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu a::after {
        transform: rotate(-90deg);
        position: absolute;
        right: 6px;
        top: .8em;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: .1rem;
        margin-right: .1rem;
    }
</style>
@stack('styles')