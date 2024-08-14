@extends('franchise.layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
        @include('franchise.partials.sidenav')
        @include('franchise.partials.topnav')

        <div class="body-wrapper">
            <div class="bodywrapper__inner">

                @include('franchise.partials.breadcrumb')

                @yield('panel')


            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>



@endsection
