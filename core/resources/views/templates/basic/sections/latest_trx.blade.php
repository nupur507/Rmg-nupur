@php
    $latestTrx = getContent('latest_trx.content', true);
    $deposits = App\Models\Deposit::latest()->where('status', 1)->take(10)->with('user')->get();
    $withdraws = App\Models\Withdrawal::latest()->where('status', 1)->take(10)->with('user')->get();
@endphp

<!-- Latest Transaction Section -->
<section class="transaction-section pt-120 pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$latestTrx->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$latestTrx->data_values->subheading) }}</h3>
                    <p>
                       {{ __(@$latestTrx->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs nav--tabs">
            <li>
                <a class="active" href="#deposit" data-bs-toggle="tab">@lang('Deposit')</a>
            </li>
            <li>
                <a href="#withdraw" data-bs-toggle="tab">@lang('Withdraw')</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="deposit">
                <table class="table cmn--table">
                    <thead>
                    <tr>
                        <th>@lang('Name')</th>
                        <th>@lang('Plan')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Amount')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($deposits as $deposit)
                            <tr>
                                <td data-label="@lang('Name')">
                                    <div class="author">
                                        <div class="thumb">

                                            <img src="{{getImage('assets/images/user/profile/' . @$deposit->user->image,  null, true)}}" alt="@lang('image')">
                                        </div>
                                        <div class="content">{{@$deposit->user->fullName}}</div>
                                    </div>
                                </td>
                                <td data-label="@lang('Plan')">{{@$deposit->user->plan->name ?? 'No plan'}}</td>
                                <td data-label="@lang('Date')">{{showDateTime($deposit->created_at , $format = 'd F, Y')}}</td>
                                <td data-label="@lang('Amount')">{{getAmount($deposit->amount)}} {{$general->cur_text}}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="100%">
                                @lang('No deposit yet')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="withdraw">
                <table class="table cmn--table">
                    <thead>
                    <tr>
                        <th>@lang('Name')</th>
                        <th>@lang('Plan')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Amount')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($withdraws as $withdraw)
                            <tr>
                                <td data-label="@lang('Name')">
                                    <div class="author">
                                        <div class="thumb">
                                            <img src="{{getImage('assets/images/user/profile/' . @$withdraw->user->image,  null, true)}}" alt="@lang('image')">
                                        </div>
                                        <div class="content">
                                            {{@$withdraw->user->fullName}}
                                        </div>
                                    </div>
                                </td>
                                <td data-label="@lang('Plan')">{{@$deposit->user->plan->name ?? 'No plan'}}</td>
                                <td data-label="@lang('Date')">{{showDateTime($withdraw->created_at , $format = 'd F, Y')}}</td>
                                <td data-label="@lang('Amount')">{{getAmount($withdraw->amount)}} {{$general->cur_text}}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="100%">
                                @lang('No withdrawal yet')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Latest Transaction Section -->
