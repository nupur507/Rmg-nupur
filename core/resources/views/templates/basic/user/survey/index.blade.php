@extends($activeTemplate . 'user.layouts.app')

@php
    $survey_notice = getContent('notice.content', true);
@endphp

@section('panel')

@if(@$survey_notice->data_values->description)
    <div class="card mt-30">
        <div class="card-header bg--primary text-white">
            <div class="panel-card-title"><i class="las la-exclamation-circle"></i> @lang('Notice Board')</div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-12 col-md-12 col-sm-12 mb-30">
                    <p>{{__(@$survey_notice->data_values->description)}}</p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="card mt-30">
    <div class="card-header bg--primary text-white">
        <div class="panel-card-title"><i class="lar la-question-circle"></i> @lang('Survey List')</div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center mb-30-none">
            @php
                $count = 0;
            @endphp
            @foreach($get_survey as $item)
                @php
                    $count++;
                    $condition = true;
                    if($item->users){
                        $condition = !in_array(Auth::user()->id, $item->users);
                    }
                @endphp

                @if($condition)
                    <div class="col-xl-3 col-md-6 col-sm-6 mb-30 ">
                        <div class="survey-list-item">
                            <div class="survey-list-body">
                                <div class="survey-list-thumb mb-2">
                                    <img src="{{ getImage(imagePath()['survey']['path'].'/'. $item->image,imagePath()['survey']['size']) }}" alt="survey">
                                </div>
                                <div class="survey-list-content">
                                    <div class="survey-list-header d-flex flex-wrap justify-content-between">
                                        <h5 class="title">{{ shortDescription($item->name, 34) }}</h5>
                                    </div>
                                    <p>{{ __($item->category->name) }}</p>
                                    <small class="font-weight-bold text--success">
                                        @lang('Reward'): {{$general->cur_sym}}{{$item->questions->count() * $general->per_question_paid}}
                                    </small>
                                </div>
                            </div>
                            <div class="survey-list-footer">
                                <div class="survey-btn">
                                    <a href="{{route('user.survey.questions', $item->id)}}" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Start Survey')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if(!$count) <p>{{__($empty_message)}}</p>@endif
        </div>
    </div>

    @if($get_survey->hasPages())
        <div class="card-footer py-4">
            {{$get_survey->links()}}
        </div>
    @endif

</div>
@endsection

