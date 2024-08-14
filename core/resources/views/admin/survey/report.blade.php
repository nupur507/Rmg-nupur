@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Sl')</th>
                                    <th scope="col">@lang('Category')</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Total Questions')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($all_survey as $item)
                                    <tr>
                                        <td data-label="@lang('SL')">{{$loop->index+1}}</td>
                                        <td data-label="@lang('Category')">{{__($item->category->name)}}</td>
                                        <td data-label="@lang('Name')">{{__($item->name)}}</td>
                                        <td data-label="@lang('Status')">
                                            @if($item->status == 1)
                                                <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Total Questions')">{{ @$item->questions->count() }}</td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.survey.report.question', $item->id) }}" class="icon-btn" data-toggle="tooltip" data-original-title="@lang('Report')">
                                                <i class="las la-chart-bar text--shadow"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $all_survey->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection

@if(request()->routeIs('admin.users.survey'))
    @push('breadcrumb-plugins')
        <a href="{{ route('admin.users.detail', $id) }}" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
    @endpush
@endif
