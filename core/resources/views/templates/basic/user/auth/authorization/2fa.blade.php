@extends($activeTemplate .'layouts.app')
@section('panel')
<!-- Account Section -->
<div class="account-section bg_img" data-background="{{getImage('assets/images/frontend/2fa_verify_page/' . @$content->data_values->background_image, '1920x1080')}}">
    <div class="account__section-wrapper">
        <div class="account__section-content">
            <div class="w-100">
                <div class="logo mb-5">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}"  alt="@lang('site-logo')">
                    </a>
                </div>
                <div class="section__header text-white">
                    <h6 class="section__title mb-0 text-white">@lang('2FA Verification')</h6>
                </div>
                <form class="account--form row g-4" method="post" action="{{ route('user.go2fa.verify') }}">
                    @csrf

                    <div class="col-sm-12">
                        <label for="code" class="form--label-2">@lang('Verification Code')</label>
                        <input type="text" name="code" id="code" placeholder="@lang('Code')" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
@endsection
