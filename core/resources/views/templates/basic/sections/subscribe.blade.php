@php
    $subscribe = getContent('subscribe.content', true);
@endphp

<section id="subscribe" class="subscribe-section pt-60 pb-60"
         >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">@lang(@$subscribe->data_values->heading)</span>
                    <h3 class="section__title">@lang(@$subscribe->data_values->subheading)</h3>
                    <p>
                        @lang(@$subscribe->data_values->description)
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="subscribe-content">
                    <form class="subscribe-form" method="post" action="{{route('subscriber.store')}}">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" class=" form-control form--control"  placeholder="@lang('Enter Your email address')" required>
                        <button class="cmn--btn" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
