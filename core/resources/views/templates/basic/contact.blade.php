@extends($activeTemplate.'layouts.master')

@section('content')
<!-- Contact -->
<section class="contact-section pt-120 pb-120 pb-lg-0">
    <div class="container">
        <div class="contact-area">
            <div class="contact-content">
                <div class="section__header">
                    <h3 class="section__title">{{ __(@$contact->data_values->title) }}</h3>
                    <p>
                        {{ __(@$contact->data_values->short_details) }}
                    </p>
                </div>
                <div class="contact-content-botom">
                    <h5 class="subtitle">@lang('More Information')</h5>
                    <ul class="contact-info">
                        <li>
                            <div class="icon">
                                <i class="las la-map-marker-alt"></i>
                            </div>
                            <div class="cont">
                                <h6 class="name">@lang('Address')</h6>
                                <span class="info">{{@$contact->data_values->contact_details}}</span>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="las la-envelope"></i>
                            </div>
                            <div class="cont">
                                <h6 class="name">@lang('Email')</h6>
                                <span class="info"><a href="Mailto:{{@$contact->data_values->email_address}}">{{@$contact->data_values->email_address}}</a></span>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <div class="cont">
                                <h6 class="name">@lang('Phone')</h6>
                                <span class="info">
                                    <a href="tel:{{@$contact->data_values->contact_number}}">
                                        {{@$contact->data_values->contact_number}}
                                    </a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="contact-wrapper bg--section">
                <div class="section__header">
                    <h3 class="section__title">@lang('Contact US')</h3>
                </div>
                <form class="contact-form" method="post" action="">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form--label text--title">@lang('Name')</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control form--control" placeholder="@lang('Your Name')" id="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email" class="form--label text--title">@lang('Email')</label>
                                <input type="email" name="email"  value="{{old('email')}}" id="email" placeholder="@lang('Enter E-Mail Address')" required class="form-control form--control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="subject" class="form--label text--title">@lang('Subject')</label>
                                <input type="text" name="subject" placeholder="@lang('Write your subject')" value="{{old('subject')}}" id="subject" required class="form-control form--control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="message" class="form--label text--title">@lang('Message')</label>
                                <textarea name="message" id="message" class="form-control form--control" placeholder="@lang('Write your message')">{{old('message')}}</textarea>
                            </div>
                        </div>

                        @php
                            $reCpatcha = reCaptcha();
                        @endphp

                        @if($reCpatcha)
                            <div class="col-lg-12">
                                <div class="form-group">
                                    @php echo $reCpatcha @endphp
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            @include($activeTemplate.'partials.custom-captcha')
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="cmn--btn">@lang('Send Message')</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact -->

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
