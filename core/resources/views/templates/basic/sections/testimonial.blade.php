
@php
    $testimonialCaption = getContent('testimonial.content',true);
    $testimonials = getContent('testimonial.element');
@endphp

<!-- Client's Section -->
<section class="clients-section bg--title shapes-container">
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
        <div class="section__title d-flex flex-wrap justify-content-between align-items-center">
            <h3 class="title mb-3 me-2 text-white">{{ __(@$testimonialCaption->data_values->heading) }}</h3>
        </div>
        <div class="row g-3">
            @foreach($testimonials as $testimonial)
                <div class="col-sm-6 col-lg-4">
                    <div class="client__item">
                        <div class="client__item-title">
                            <h6 class="name">{{ __(@$testimonial->data_values->name) }}</h6>
                            <div class="ratings">
                                @for($i = 0; $i < $testimonial->data_values->rating; $i++)
                                    <span>
                                        <i class="las la-star"></i>
                                    </span>
                                @endfor
                            </div>
                        </div>
                        <div class="client__item-body">
                            <p>
                                {{ __(@$testimonial->data_values->say) }}
                            </p>
                            <span class="date">{{ showDateTime($testimonial->created_at) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Client's Section -->
