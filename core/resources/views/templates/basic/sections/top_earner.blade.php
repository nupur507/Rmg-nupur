@php
    $teamTitle = getContent('top_earner.content', true);
    $earners = App\Models\User::where('survey_earning', '!=', 0)->orderBy('survey_earning', 'DESC')->take(6)->get();
@endphp

<!-- Team Section -->
<section class="team-section pt-60 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$teamTitle->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$teamTitle->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$teamTitle->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($earners as $data)
                <div class="col-xl-4 col-md-6">
                    <div class="team__item">
                        <div class="team__thumb">
                            <img src="{{ getImage('assets/images/user/profile/'. @$data->image, null, true)}}" alt="@lang('profile')">
                        </div>
                        <div class="team__content">
                            <h6 class="team__title">{{ __(@$data->fullname) }}</h6>
                            <span class="info">{{ $general->cur_sym }}{{ getAmount($data->survey_earning, 2) }}</span>
                            <ul class="social__icons"></ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Team Section -->



