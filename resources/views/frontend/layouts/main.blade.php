<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Techno Store - {{ $config['title'] }}</title>

    <meta name="author" content="CreativeLayers">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Boostrap style -->
    <link rel="stylesheet" type="text/css" href="/frontend/stylesheets/bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="/frontend/stylesheets/style.css">

    <!-- Reponsive -->
    <link rel="stylesheet" type="text/css" href="/frontend/stylesheets/responsive.css">

    <link rel="shortcut icon" href="/frontend/favicon/favicon.png">

    <style>
        #mega-menu > ul.menu,
        .top-search form.form-search .cat-wrap .all-categories {
            height: auto !important;
            max-height: 450px !important;
        }
        .logout{
            background: transparent !important;
            color:#333;
            display: block;
            padding: 1px 15px;
            line-height: 24px;
            font-size: 12px !important;
            height: 37px;
            border-radius: 0;
            font-weight: 100;
        }
        .logout:hover{
            color:#f28b00;
        }
        .box-cart.style2 .btn-add-cart button {
            display: inline-block;
            padding: 1px 6px;
            height: 55px;
            line-height: 55px;
            text-align: center;
            color: #fff;
            background-color: #f92400;
            border-radius: 30px;
            width: 220px;
            font-size: 16px;
            font-weight: 600;
        }

        .box-cart.style2 .btn-add-cart button:hover {
            background-color: #2d2d2d;
        }

        .box-cart.style2 .btn-add-cart button img {
            padding-right: 18px;
        }
        .btn-order button {
            width: 100%;
            display: block;
            background-color: #f92400;
            color: #fff;
            font-size: 20px;
            text-align: center;
            height: 60px;
            line-height: 60px;
            border-radius: 30px;
        }
        .btn-order button:hover, .btn-order button:focus {
            color: #FFF;
            text-decoration: none;
            background-color: #2d2d2d;
            outline: 0;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>

    <!-- Javascript -->
    <script type="text/javascript" src="/frontend/javascript/jquery.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/tether.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/waypoints.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery.circlechart.js"></script>
    <script type="text/javascript" src="/frontend/javascript/easing.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery.zoom.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/owl.carousel.js"></script>
    <script type="text/javascript" src="/frontend/javascript/smoothscroll.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
    <script type="text/javascript" src="/frontend/javascript/gmap3.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/waves.min.js"></script>
    <script type="text/javascript" src="/frontend/javascript/jquery.countdown.js"></script>
</head>
<body class="header_sticky">
    <div class="boxed">

        <div class="overlay"></div>

        <!-- Preloader -->
        <div class="preloader">
            <div class="clear-loading loading-effect-2">
                <span></span>
            </div>
        </div><!-- /.preloader -->


        <section id="header" class="header">
            @include('frontend.layouts.header')
            @include('frontend.layouts.navbar')
        </section><!-- /#header -->

        @yield('content')

        @include('frontend.layouts.footer')

    </div><!-- /.boxed -->


    <script type="text/javascript" src="/frontend/javascript/main.js"></script>
    @if (session('alert'))
    {!! session('alert') !!}
    @endif
</body>
</html>
