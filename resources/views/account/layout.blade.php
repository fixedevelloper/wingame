<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Lotto foot- @yield('title') </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Sites meta Data -->
    <meta name="application-name"
          content="Lotto foot - Crypto, BitCoin, Etheruim">
    <meta name="author" content="Rodrigue julio">
    <meta name="keywords" content="Lotto- paris, game, Propulse4U">
    <meta name="description"
          content="">

    <!-- OG meta data -->
    <meta property="og:title"
          content="">
    <meta property="og:site_name" content=Propulse4U>
    <meta property="og:url" content="https://4ulotto.com/">
    <meta property="og:description"
          content="Welcome to Infinix,">
    <meta property="og:type" content="website">
    <meta property="og:image" content="assets/images/og.png">

    <link rel="shortcut icon" href="{{asset('images/preview.svg')}}" type="image/x-icon">


    <!--Bootstrap Min Css-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!--Glyphter Css-->
    <link rel="stylesheet" href="{{asset('glyphter-font/css/Glyphter.css')}}">
    <!--animation Css-->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!--Fontawsome all min Css-->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <!--Main custom Css-->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- main css for template -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="{{asset('css/checkbutton.scss')}}">
    <link rel="stylesheet" href="{{asset('toast/toastr.css')}}" data-n-g="">
</head>

<body>
<div class="dashboard__body mt__30 pb-60">
    @include('_partials._header')
    <div class="container mt-3">
        <div class="row g-4">
            @include('account.sider_menu')
            <div class="col-xxl-9 col-xl-9 col-lg-8">
                <div class="dashboard__body__wrap">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
</div>
        <!-- vendor plugins -->
            @stack('scripts')
          <!--Jquery min js-->
            <script src="{{asset('js/jquery-3.7.min.js')}}"></script>
            <script src="{{asset("toast/toastr.min.js")}}"></script>
            <!--Bootstrap bundle min js-->
            <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
            <!--jquery ui min-->
            <script src="{{asset('js/jquery-ui.min.js')}}"></script>


            <!--Main js-->
            <script src="{{ asset('lottoJs/lotterie.js') }}"></script>
            <script>
                $('#myform_game_input').change(function () {
                    $('#mygame_form').submit()
                })
                var configs = {
                    routes: {
                        index: "{{\Illuminate\Support\Facades\URL::to('/')}}",
                        home: "{{\Illuminate\Support\Facades\URL::route('home')}}",
                        register_ajax: "{{\Illuminate\Support\Facades\URL::route('register_ajax')}}",
                        postgame_ajax: "{{\Illuminate\Support\Facades\URL::route('postGame')}}",
                        login_next: "{{\Illuminate\Support\Facades\URL::route('login_next')}}",
                        check_register: "{{\Illuminate\Support\Facades\URL::route('check_register')}}",
                    }
                }
                jQuery(document).ready(function() {
                    'use strict';
                  lotto.setBalance();
                });
            </script>
@stack('script')
</body>

</html>

