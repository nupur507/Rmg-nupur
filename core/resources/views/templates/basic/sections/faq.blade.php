@php
    $faqTitle = getContent('faq.content', true);
    $faqs = getContent('faq.element');
@endphp

<!-- Faqs Section -->
<section class="faq-section pt-120 pb-120 bg--section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$faqTitle->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$faqTitle->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$faqTitle->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center g-y">

            <div class="col-lg-6">
                <div class="faq__wrapper">
                    @foreach($faqs as $key => $faql)
                        @if($loop->odd)
                            <div class="faq__item">
                                <div class="faq__title">
                                    <h5 class="title">
                                        {{ __(@$faql->data_values->question) }}
                                    </h5>
                                    <span class="right--icon"></span>
                                </div>
                                <div class="faq__content">
                                    <p>
                                        <p>{{ __(@$faql->data_values->answer) }}</p>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq__wrapper">
                    @foreach($faqs as $key => $faql)
                        @if($loop->even)
                            <div class="faq__item">
                                <div class="faq__title">
                                    <h5 class="title">
                                        {{ __(@$faql->data_values->question) }}
                                    </h5>
                                    <span class="right--icon"></span>
                                </div>
                                <div class="faq__content">
                                    <p>
                                        <p>{{ __(@$faql->data_values->answer) }}</p>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Faqs Section -->
