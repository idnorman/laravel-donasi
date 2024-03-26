<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title ? $title : config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('main/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @stack('head-scripts')
</head>

@include('main.layouts.header')

@yield('content')

@include('main.layouts.footer')

<!-- JS here -->
<script src="{{ asset('main/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('main/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('main/js/popper.min.js') }}"></script>
<script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('main/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('main/js/ajax-form.js') }}"></script>
<script src="{{ asset('main/js/waypoints.min.js') }}"></script>
<script src="{{ asset('main/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('main/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('main/js/scrollIt.js') }}"></script>
<script src="{{ asset('main/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('main/js/wow.min.js') }}"></script>
<script src="{{ asset('main/js/nice-select.min.js') }}"></script>
<script src="{{ asset('main/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('main/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('main/js/plugins.js') }}"></script>
<script src="{{ asset('main/js/gijgo.min.js') }}"></script>

<script src="{{ asset('main/js/main.js') }}"></script>
@stack('body-scripts')
</body>

</html>
