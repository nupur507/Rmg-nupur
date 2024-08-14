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
                    <h4 class="section__title mb-0 text-white">@lang('Verification Code')</h4>
                </div>
                <form class="account--form g-4" method="post" action="{{ route('user.password.verify-code') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group">
                        <input type="text" name="code" pattern="[0-9]*" class="form-control" maxlength="6" required >
                    </div>

                    <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                </form>
                <div class="mt-4 text--white">
                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{ route('user.password.request') }}" class="text--base">
                            @lang('Try to send again')
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
@endsection


