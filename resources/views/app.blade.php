<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Bayview Hotel Mansions.">
    <meta name="keywords" content="Bayview Hotel Mansions.">
    <meta name="author" content="Tunmise">
    <title>Clean Check - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.jpeg') }}">
    <link href="{{ asset('dashboard/assets/css/css2.css?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600') }}" rel="stylesheet">
    
    @yield('head')
    
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('layouts.nav')
    @include('layouts.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        @yield('content-header')
        <div class="content-body">
            @yield('content-body')
        </div>
      </div>
    </div>
    <!-- END: Content-->
    @yield('foot')
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
  </body>
  <!-- END: Body-->
</html>