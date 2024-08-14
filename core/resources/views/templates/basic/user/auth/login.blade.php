@extends($activeTemplate.'layouts.app')

@section('panel')
    <!-- Account Section -->
    <div class="account-section bg_img" data-background="{{getImage('assets/images/frontend/sign_in/' . @$content->data_values->background_image, '1920x1080')}}">
        <div class="account__section-wrapper">
            <div class="account__section-content">
                <div class="w-100">
                    <div class="logo mb-5">
                        <a href="{{route('home')}}">
                            <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}"  alt="@lang('site-logo')">
                        </a>
                    </div>
                    <div class="section__header text-white">
                        <h4 class="section__title mb-0 text-white">@lang('Sign In')</h4>
                    </div>
                    <form class="account--form row g-4" method="post" action="{{route('user.login')}}"
                        onsubmit="return submitUserForm();">
                        @csrf
                        <div class="col-sm-12">
                            <label for="username" class="form--label-2">@lang('User Id')</label>
                            <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="@lang('User Id')" required class="form-control form--control-2">
                        </div>
                        <div class="col-sm-12">
                            <label for="myInputThree" class="form--label-2">@lang('Your Password')</label>
                            <input type="password" id="myInputThree" name="password" placeholder="@lang('Password')" required class="form-control form--control-2">
                        </div>

                        @if(reCaptcha())
                            <div class="form-group my-3">
                                @php echo reCaptcha(); @endphp
                            </div>
                        @endif

                        <div class="col-lg-12 form-group my-3">
                            @include($activeTemplate.'partials.custom-captcha')
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn w-100">@lang('Sign In')</button>
                        </div>
                    </form>
                    <div class="mt-4 text--white">
                        <span class="d-block">
                            @lang('Forget Password') ? <a href="{{ route('user.password.request') }}" class="text--base">@lang('Reset Password')</a>
                        </span>
                        <span class="d-block">
                            @lang('Don\'t Have an Account') ? <a href="{{ route('user.register') }}" class="text--base">@lang('Create New')</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Account Section -->
@endsection

@push('script')
    <script>
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
