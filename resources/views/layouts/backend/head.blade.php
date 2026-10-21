<link rel="icon" type="image/png" sizes="32x32" href="{{asset("assets/frontend/images/favicon/favicon.ico")}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset("assets/frontend/images/favicon/favicon.ico")}}">
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- Csrf Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--  Mobile Viewport Fix -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<!-- Website meta data -->
<meta content="File Manager" name="description">
<meta content="Tejas" name="author">
<!-- Raleway font -->
<link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
<title>
    @yield('title')
</title>

@include('layouts.backend.styles')