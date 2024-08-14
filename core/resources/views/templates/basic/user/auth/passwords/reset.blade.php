@extends($activeTemplate.'layouts.app')

@section('panel')
<!-- Account Section -->
<div class="account-section bg_img" data-background="{{getImage('assets/images/frontend/reset_password/' . @$content->data_values->background_image, '1920x1080')}}">
    <div class="account__section-wrapper">
        <div class="account__section-content">
            <div class="w-100"> 
                <div class="logo mb-5">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}"  alt="@lang('site-logo')">
                    </a>
                </div>
                <div class="section__header text-white">
                    <h4 class="section__title mb-0 text-white">@lang('Reset Password')</h4>
                </div>
                <form class="account--form row g-4" method="post" action="{{ route('user.password.update') }}">
                    @csrf 
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="col-sm-12">
                        <label for="username" class="form--label-2">@lang('New Password')</label>
                        <input type="Password" name="password" placeholder="@lang('Password')" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <label for="username" class="form--label-2">@lang('Confirm Password')</label>
                        <input type="Password" name="password_confirmation"  placeholder="@lang('Confirm Password')" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100">@lang('Change Password')</button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    @lang('Go to Sign In') 
                        <a href="{{ route('user.login') }}" class="text--base">
                            @lang('Sign In')
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
@endsection
