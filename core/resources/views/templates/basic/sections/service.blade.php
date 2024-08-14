@php
    $serviceCaption = getContent('service.content',true);
    $services = getContent('service.element');
@endphp

@if($services)
<!-- Service Section -->
<section class="feature-section pt-60 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$serviceCaption->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$serviceCaption->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$serviceCaption->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row g-3 g-sm-4">
            @foreach($services as $k => $data)
                <div class="col-lg-4 col-md-6">
                    <div class="feature__item">
                        <div class="feature__item-icon">
                            @php echo @$data->data_values->icon; @endphp
                        </div>
                        <div class="feature__item-cont">
                            <h6 class="feature__item-cont-title">{{__(@$data->data_values->title)}}</h6>
                            <p>
                                {{__(@$data->data_values->description)}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Service Section -->
@endif