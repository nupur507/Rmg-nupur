<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> {{ $general->sitename}} - {{__(@$page_title)}} </title>
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" type="image/x-icon">
    @include('partials.seo')

    <link rel="stylesheet" href="{{asset('assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/owl.min.css')}}">

    @stack('style-lib')

    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'css/main.css')}}">
    @stack('css')

    <link rel="stylesheet" href='{{ asset($activeTemplateTrue."css/color.php?color=".$general->base_color.'&secondColor='.$general->secondary_color)}}'>

    @stack('style')

</head>

<body class="overflow-hidden">

    @stack('facebook')

    <div class="preloader">
        <div class="loader">
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
            <span class="loader-block"></span>
        </div>
    </div>
    <div class="overlay"></div>

    @yield('panel')

    <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/global/js/bootstrap.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/rafcounter.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/lightbox.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue . 'js/owl.min.js')}}"></script>

    @stack('script-lib')

    <script src="{{asset($activeTemplateTrue . 'js/main.js')}}"></script>
    @stack('js')
    @include('partials.notify')
    @include('partials.plugins')

    <script>
        $(document).on("change", ".langSel", function () {
            window.location.href = "{{route('home')}}/change/" + $(this).val();
        });
    </script>
    @stack('script')

</body>

</html>
