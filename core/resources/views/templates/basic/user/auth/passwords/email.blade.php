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
                <form class="account--form row g-4" method="post" action="{{ route('user.password.email') }}">
                    @csrf
                    <div class="col-sm-12">
                        <label for="username" class="form--label-2">@lang('Your Name')</label>
                        <select class="form-control form--control-2" name="type">
                            <option value="email">@lang('E-Mail Address')</option>
                            <option value="username">@lang('Username')</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="myInputThree" class="form--label-2 my_value">@lang('Type Here')</label>
                        <input type="text" class=" @error('value') is-invalid @enderror form-control form--control-2 my_value" name="value" value="{{ old('value') }}" required autofocus="off" placeholder="@lang('Type Here...')">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100">@lang('Send Password Reset Code')</button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    @lang('Go to Sign In') <a href="{{ route('user.login') }}" class="text--base">@lang('Sign In')</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
@endsection

@push('script')
<script type="text/javascript">
    $('select[name=type]').change(function(){
        $('.my_value').text($('select[name=type] :selected').text());
    }).change();
</script>
@endpush
