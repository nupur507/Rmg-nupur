@php
    $paymentCaption = getContent('payment.content', true);
    $allGateway = \App\Models\Gateway::where('status', 1)->get();
@endphp
<!-- Payment Gateways Section -->
<section class="payment-gateway-section pt-60 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$paymentCaption->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$paymentCaption->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$paymentCaption->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="payment-slider owl-carousel owl-theme">
            @foreach($allGateway as $gateway) 
                <div class="payment__item">
                    <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $gateway->image,imagePath()['gateway']['size']) }}" alt="@lang('payment')">
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Payment Gateways Section -->
