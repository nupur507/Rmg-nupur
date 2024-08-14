@php
    $about = getContent('about.content',true);
    $aboutData = getContent('about.element', false, null, true);
@endphp

<!-- About Section -->
<section class="about-section pt-120 pb-60">
    <div class="container">
        <div class="row justify-content-between flex-wrap-reverse gy-4">
            <div class="col-lg-6">
                <div class="about__thumb">
                    <div class="thumb">
                        <img src="{{ getImage('assets/images/frontend/about/'.@$about->data_values->background_image, '800x530') }}" alt="@lang('about')">
                        <a href="{{ @$about->data_values->video_link}}" class="video-button" data-lightbox><i class="las la-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-xl-4 ps-xxl-5">
                    <div class="about-content">
                        <div class="section__header">
                            <span class="section__cate">{{ __(@$about->data_values->heading) }}</span>
                            <h3 class="section__title">{{ __(@$about->data_values->subheading) }}</h3>
                            <p>@php echo @$about->data_values->description; @endphp</p>
                        </div>
                        <div class="row g-4">
                            @foreach($aboutData as $data)
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="about__item">
                                        <div class="icon">
                                            @php echo @$data->data_values->icon; @endphp
                                        </div>
                                        <div class="info">
                                            <h6 class="subtitle">{{ __(@$data->data_values->paragraph) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="btn__grp">
                            <a href="{{__(@$about->data_values->left_button_link)}}" class="cmn--btn">{{__(@$about->data_values->left_button)}}</a>
                            <a href="{{__(@$about->data_values->right_button_link)}}" class="cmn--btn">{{__(@$about->data_values->right_button)}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- About Section -->