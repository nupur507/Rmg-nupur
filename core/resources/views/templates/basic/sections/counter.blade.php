@php
    $counterCaption = getContent('counter.content', true);
    $counters = getContent('counter.element');
@endphp

<!-- Counter Section -->
<section class="counter-section bg--title shapes-container">
    <div class="banner-shape shape1">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/1.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape2">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/2.png')}}" alt="@lang('banner-shapes')">
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
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center text-white">
                    <span class="section__cate text-white">{{__(@$counterCaption->data_values->heading)}}</span>
                    <h3 class="section__title text-white">{{__(@$counterCaption->data_values->subheading)}}</h3>
                    <p>
                        {{ __(@$counterCaption->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center g-4">
            @foreach($counters as $counter)
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-item">
                        <div class="counter-header">
                            <h3 class="title rafcounter" data-counter-end="{{ (int) @$counter->data_values->counter_digit }}">00</h3>
                            <h3 class="title">{{ preg_replace('/[0-9]+/', '', @$counter->data_values->counter_digit) }}</h3>
                        </div>
                        <div class="counter-content">
                            {{__(@$counter->data_values->title)}}
                        </div>
                        <div class="icon">
                            @php echo @$counter->data_values->icon; @endphp
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Counter Section -->
