@extends($activeTemplate.'layouts.app')

@section('panel')
    <!-- Header -->
    <div class="header-top">
        <div class="container">
            <div class="header__top__wrapper">
                <ul>
                    <li>
                        <span class="name">@lang('Email'): </span><a href="mailto:{{@$contact->data_values->email_address}}" class="text--base">{{@$contact->data_values->email_address}}</a>
                    </li>
                    <li>
                        <span class="name">@lang('Call Us'): </span><a href="tel:{{@$contact->data_values->contact_number}}" class="text--base">{{@$contact->data_values->contact_number}}</a>
                    </li>
                </ul>
                <ul class="social-icons">
                    @foreach($socials as $social)
                        <li><a href="{{@$social->data_values->url}}" target="_blank"
                               title="{{@$social->data_values->title}}">@php echo @$social->data_values->social_icon; @endphp</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom bg--section">
        <div class="header-area">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo me-lg-4 me-auto">
                        <a href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"
                            alt="logo">
                        </a>
                    </div>
                    <div class="menu-area">
                        <div class="menu-close">
                            <i class="las la-times"></i>
                        </div>
                        <ul class="menu">
                            <li><a href="{{route('home')}}">@lang('Home')</a></li>
                            @foreach($pages as $k => $data)
                                <li><a href="{{route('pages',[$data->slug])}}">{{trans($data->name)}}</a></li>
                            @endforeach
                            <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                            <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
                        </ul>
                    </div>
                    <div class="change-language me-3 me-lg-0">
                        <div class="sign-in-up d-sm-block">
                            @auth
                                <span><i class="fas la-user"></i></span>
                                <a href="{{route('user.home')}}">@lang('Dashboard')</a>
                                <a href="{{route('user.logout')}}">@lang('Logout')</a>
                            @else
                                <span><i class="fas la-user"></i></span>
                                <a href="{{route('user.login')}}">@lang('Sign In')</a>
                                <a href="{{route('user.register')}}">@lang('Sign Up')</a>
                                <a href="{{route('franchise.login')}}">@lang('Franchise Login')</a>
                            @endauth
                        </div>
                        {{-- <select class="language langSel">
                            @foreach($language as $item)
                                <option value="{{$item->code}}"
                                    @if(session('lang') == $item->code) selected @endif>{{ __($item->name) }}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>
                    <div class="header-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header -->

    @if(!request()->routeIs('home') && !request()->routeIs('contact'))
        @include($activeTemplate.'layouts.breadcrumb')
    @endif

    @yield('content')

    <!-- Footer Section -->
    <footer class="shapes-container bg--title bottom-shape-0 pb-0">
        <div class="banner-shape shape1">
            <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/1.png')}}" alt="@lang('banner-shapes')">
        </div>
        <div class="banner-shape shape3">
            <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/3.png')}}" alt="@lang('banner-shapes')">
        </div>
        <div class="banner-shape shape4">
            <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/4.png')}}" alt="@lang('banner-shapes')">
        </div>
        <div class="banner-shape shape6">
            <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/6.png')}}" alt="@lang('banner-shapes')">
        </div>
        <div class="container">
            <div class="footer-top pb-4">
                <div class="logo footer-logo">
                    <a href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}" alt="logo"></a>
                </div>
                <div class="footer__txt">
                    <p>{{__(@$footer->data_values->website_footer)}}</p>
                </div>
                <ul class="footer-links">
                    <li><a href="{{route('home')}}">@lang('Home')</a></li>
                    @foreach($pages as $k => $data)
                        <li><a href="{{route('pages',[$data->slug])}}">{{trans($data->name)}}</a></li>
                    @endforeach
                    <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                    <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
                </ul>
            </div>
            <div class="footer-bottom d-flex flex-wrap-reverse justify-content-between align-items-center py-3">
                <div class="copyright">
                    {{__(@$footer->data_values->copyright)}}
                </div>
                <ul class="social-icons">
                    @foreach($socials as $social)
                        <li><a href="{{@$social->data_values->url}}" target="_blank"
                               title="{{@$social->data_values->title}}">@php echo @$social->data_values->social_icon; @endphp</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer Section -->
@endsection
