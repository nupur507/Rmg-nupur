@extends($activeTemplate.'layouts.app')

@section('panel')

@php
$policyElements =  getContent('policy_pages.element');
@endphp

<!-- Account Section -->
<div class="account-section bg_img" data-background="{{getImage('assets/images/frontend/sign_up/' . @$content->data_values->background_image, '1920x1080')}}">
    <div class="account__section-wrapper">
        <div class="account__section-content sign-up">
            <div class="w-100">
                <div class="logo mb-4">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}" alt="@lang('site-logo')">
                    </a>
                </div>
                <div class="section__header text-white mb-4">
                    <h5 class="section__title mb-0 text-white">@lang('Sign Up')</h5>
                </div>
                <form class="account--form row gy-3" method="post" action="{{route('user.register')}}" onsubmit="return submitUserForm();">
                    @csrf

                    <div id="ref">

                    </div>
            @if($ref_user == null)
                <div class="col-sm-6">
                    <label for="ref_name" class="form--label-2">@lang('Referral Username')</label>
                    <input type="text" name="referral" class="referral form-control form--control-2" value="{{old('referral')}}" id="ref_name" placeholder="@lang('Enter Referral Username')*" required>
                </div>
                <div class="col-sm-6">
                    <label for="sponsor_name" class="form--label-2">@lang('Sponsor Name')</label>
                    <input type="text" name="sponsor_name" class="sponsor_name form-control form--control-2" value="{{old('sponsor_name')}}" id="sponsor_name"  readonly>
                </div>
                <div class="col-sm-6">
                    <label for="ref_name" class="form--label-2">@lang('Select Position')</label>
                    <select name="position" class="position form-control form--control-2" id="position" required disabled>
                        <option value="">@lang('Select position')*</option>
                        @foreach(mlmPositions() as $k=> $v)
                            <option value="{{$k}}">@lang($v)</option>
                        @endforeach
                    </select>
                    <span id="position-test">
                        <span class="text-danger">
                            @if(!old('position'))
                                @lang('Please enter referral username first')
                            @endif
                        </span>
                    </span>
                </div>
            
            @else
            <div class="col-sm-6">
                <label for="ref_name" class="form--label-2">@lang('Referral Username')</label>
                <input type="text" name="referral" class="referral form-control form--control-2" value="{{$ref_user->username}}" placeholder="@lang('Enter referral username')*" required readonly>
            </div>
            <div class="col-sm-6">
                <label for="sponsor_name" class="form--label-2">@lang('Sponsor Name')</label>
                <input type="text" name="sponsor_name" class="sponsor_name form-control form--control-2" value="{{old('sponsor_name')}}" id="sponsor_name"  readonly>
            </div>
            <div class="col-sm-6">
                <label for="ref_name" class="form--label-2">@lang('Select Position')</label>
                <select class="position form-control" id="position" required disabled>
                    <option value="">@lang('Select position')*</option>
                    @foreach(mlmPositions() as $k=> $v)
                    <option @if($position==$k) selected @endif value="{{$k}}">@lang($v)</option>
                    @endforeach
                </select>
                <input type="hidden" name="position" value="{{$position}}">
                <span id="position-test"><span class="text-success">@php echo $joining; @endphp</span></span>
            </div>
            @endif

           

            <div class="col-sm-6">
                <label for="firstname" class="form--label-2">@lang('First Name')</label>
                <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" autocomplete="off" placeholder="@lang('First Name')*" required class="form-control form--control-2">
            </div>

            <div class="col-sm-6">
                <label for="lastname" class="form--label-2">@lang('Last Name')</label>
                <input type="text" name="lastname" id="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')" class="form-control form--control-2">
            </div>

            <div class="col-sm-6">
                <label for="email" class="form--label-2">@lang('Email')</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="@lang('Email')*" required class="form-control form--control-2">
            </div>

            {{-- <div class="col-sm-6">
                <label for="username" class="form--label-2">@lang('Username')</label>
                <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="@lang('Username')*" required class="form-control form--control-2">
            </div> --}}

            <div class="col-sm-6">
                <label for="email" class="form--label-2">@lang('Phone Number')</label>
                <div class="input-group input-group-custom">
                    <div class="input-group-prepend">
                        <select name="country_code" class="input-group-text form-control form--control-2">
                            @include('partials.country_code')
                        </select>
                    </div>
                    <input type="text" class="form-control form--control-2" name="mobile" placeholder="@lang('Phone Number')" required>
                </div>
            </div>

            <div class="col-sm-6">
                <label for="country" class="form--label-2">@lang('Country')</label>
                <input type="text" name="country" id="country" placeholder="@lang('Country')" readonly class="form-control form--control-2">
            </div>

            <div class="col-sm-12">
                <label for="address" class="form--label-2">@lang('Address')</label>
                <input type="text" name="address" id="address" placeholder="@lang('Address')"  class="form-control form--control-2">
            </div>


            <div class="col-sm-6 hover-input-popup">
                <label for="password" class="form--label-2">@lang('Password')</label>
                <input type="password" id="password" name="password" placeholder="@lang('Password')*" class="form-control form--control-2">
                @if($general->secure_password)
                <div class="input-popup">
                    <p class="text-danger my-1 capital">@lang('At least 1 capital letter is required')</p>
                    <p class="text-danger my-1 number">@lang('At least 1 number is required')</p>
                    <p class="text-danger my-1 special">@lang('At least 1 special character is required')</p>
                </div>
                @endif
            </div>

            <div class="col-sm-6">
                <label for="password_confirmation" class="form--label-2">@lang('Confirm Password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('Confirm Password')*"  class="form-control form--control-2">
            </div>

            @if(reCaptcha())
                <div class="col-lg-12">
                    @php echo reCaptcha(); @endphp
                </div>
            @endif

            <div class="col-lg-12">
                @include($activeTemplate.'partials.custom-captcha')
            </div>

            @if($general->agree_policy)
                <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="checkgroup d-flex flex-wrap align-items-center">
                            <input type="checkbox" class="border-0" id="agree" name="agree">
                            &nbsp;
                            <label for="agree" class="m-0 pl-2 text-white">@lang('I agree with')&nbsp;</label>
                            @foreach ($policyElements as $item)
                                <a href="{{route('policy.details',[slug(@$item->data_values->title),$item->id])}}" class="text--base"> {{__($item->data_values->title)}} </a> @if(!$loop->last) ,&nbsp; @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-sm-12">
                <button type="submit" class="cmn--btn w-100">@lang('Sign Up')</button>
            </div>
            </form>
            <div class="mt-4 text--white">
                <span class="d-block">
                    @lang('Already Have an Account') ? <a href="{{ route('user.login') }}" class="text--base">@lang('Sign In')</a>
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
    (function($) {
        "use strict";

        var oldPosition = '{{ old("position") }}';

        if(oldPosition){
            $('select[name=position]').removeAttr('disabled');
            $('#position').val(oldPosition);
        }

        var not_select_msg = $('#position-test').html();

        $(document).on('blur', '#ref_name', function() {
            var ref_id = $('#ref_name').val();
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{route('check.referral')}}",
                data: {
                    'ref_id': ref_id,
                    '_token': token
                },
                success: function(data) {
                    $("#ref").html(data.msg);

                    if (data.success) {
                        $('select[name=position]').removeAttr('disabled');
                        $('#position-test').text('');
                      var referrer_name = $('#referrer_name').val();
                      console.log(referrer_name);
                      $("#sponsor_name").val(referrer_name);


                    } else {
                        $('select[name=position]').attr('disabled', true);
                        $('#position-test').html(not_select_msg);
                    }
                }
            });
        });

        $(document).on('change', '#position', function() {
            updateHand();
        });

        function updateHand() {
            var pos = $('#position').val();
            var referrer_id = $('#referrer_id').val();
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{route('get.user.position')}}",
                data: {
                    'referrer': referrer_id,
                    'position': pos,
                    '_token': token
                },
                error: function(data) {
                    $("#position-test").html(data.msg);
                }
            });
        }

        @if(@$country_code)
        $(`option[data-code={{ $country_code }}]`).attr('selected', '');
        @endif
        $('select[name=country_code]').change(function() {
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }

        @if($general -> secure_password)
        $('input[name=password]').on('input', function() {
            var password = $(this).val();
            var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
            var capital = capital.test(password);
            if (!capital) {
                $('.capital').removeClass('text--success');
            } else {
                $('.capital').addClass('text--success');
            }
            var number = /[123456790]/;
            var number = number.test(password);
            if (!number) {
                $('.number').removeClass('text--success');
            } else {
                $('.number').addClass('text--success');
            }
            var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            var special = special.test(password);
            if (!special) {
                $('.special').removeClass('text--success');
            } else {
                $('.special').addClass('text--success');
            }

        });
        @endif


    })(jQuery);
</script>

@endpush


@push('style')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: transparent !important;
    }
</style>
@endpush
