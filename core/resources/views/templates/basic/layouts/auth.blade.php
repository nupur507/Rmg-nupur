<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $general->sitename}} - {{__(@$page_title)}} </title>
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png', '128x128')}}" type="image/x-icon">
    @include('partials.seo')

    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/lightcase.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/animate.css')}}">

    @stack('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/custom.css')}}">
    @stack('css')
    <link rel="stylesheet" href='{{ asset($activeTemplateTrue."frontend/css/color.php?color=$general->base_color&color2=$general->secondary_color")}}'>

    @stack('style')
</head>

<body>

@stack('facebook')

<!--~~~~~~~~~~~~~~~~~~~Start Preloader~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-container">
            <div class="cssload-dot bg-white"><i class="fab fa-bitcoin"></i></div>
            <div class="step" id="cssload-s1"></div>
            <div class="step" id="cssload-s2"></div>
            <div class="step" id="cssload-s3"></div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~End Preloader~~~~~~~~~~~~~~~~~~~~~-->



@yield('content')

<!-- ============Footer Section Ends Here============ -->
<script src="{{asset($activeTemplateTrue . 'frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/lightcase.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/swiper.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/viewport.jquery.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/odometer.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/wow.min.js')}}"></script>
@stack('script-lib')
<script src="{{asset($activeTemplateTrue . 'frontend/js/main.js')}}"></script>

@include('partials.notify')
@include('partials.plugins')

@stack('script')

</body>
</html>
