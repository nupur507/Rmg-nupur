@php
    $planTitle = getContent('mlm_plan.content', true);
    $plans = \App\Models\Plan::where('status', 1)->get();
@endphp

<div class="cmn--modal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang("Business Volume (BV) info")</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    @lang('When someone from your below tree subscribe this plan, You will get this Business Volume  which will be used for matching bonus')
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

<div class="cmn--modal modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Referral Commission info')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    @lang('When Your Direct-Referred/Sponsored  User Subscribe in') <b> @lang('ANY PLAN') </b>, @lang('You will get this amount')
                </span>
                <p class="text-success mt-4"> @lang('This is the reason You should Choose a Plan With Bigger Referral Commission')</p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

<div class="cmn--modal modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Commission to tree info')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    @lang('When someone from your below tree subscribe this plan, You will get this amount as Tree Commission')
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Plan Section -->
<section class="pricing-section pt-120 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$planTitle->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$planTitle->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$planTitle->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="price-wrapper">

            @foreach($plans  as $plan)
                <div class="pricing-item">
                    <div class="pricing-deco">
                        <div class="wave">&nbsp;</div>
                            <div class="pricing-price"><span class="pricing-currency">{{$general->cur_sym}}</span>{{getAmount($plan->price)}}
                        </div>
                        <h3 class="pricing-title">{{__(@$plan->name)}}</h3>
                    </div>
                    <ul class="pricing-feature-list">
                        <li class="pricing-feature">
                            @lang('Business Volume') (@lang('BV')) : <span class="amount">{{$plan->bv}}
                            <span data-bs-target="#exampleModal" data-bs-toggle="modal"><i class="fas la-question"></i></span>
                        </li>
                        <li class="pricing-feature">
                            @lang('Referral Commission') : <span class="amount">{{$general->cur_sym}} {{getAmount($plan->ref_com)}}
                            <span data-bs-target="#exampleModal2" data-bs-toggle="modal"><i class="fas la-question"></i></span>
                        </li>
                        <li class="pricing-feature">
                            @lang('Commission To Tree') : <span class="amount">{{$general->cur_sym}} {{getAmount($plan->tree_com)}}
                            <span data-bs-target="#exampleModal3" data-bs-toggle="modal"><i class="fas la-question"></i></span>
                        </li>
                    </ul>
                    <div class="text-center pb-4 mb-2">
                        <a class="cmn--btn" href="{{route('user.plan.index')}}">@lang('Subscribe now')</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Pricing Plan Section -->
 