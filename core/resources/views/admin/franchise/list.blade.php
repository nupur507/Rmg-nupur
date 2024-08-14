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
                                <th scope="col">@lang('S.No.')</th>
                                <th scope="col">@lang('Franchise ID')</th>
                                <th scope="col">@lang('Franchise Name')</th>
                                <th scope="col">@lang('Parent Franchise')</th>
                                <th scope="col">@lang('Type')</th>
                                <th scope="col">@lang('Request Date')</th>
                                <th scope="col">@lang('Activate Date')</th>
                                <th scope="col">@lang('Phone')</th>
                                <th scope="col">@lang('Adress')</th>
                                <th scope="col">@lang('Create By')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count=1;
                            @endphp
                            @forelse($franchises as $franchise)
                            @php
                                $franchise->activate_date =  $franchise->activate_date != null ? date("d/m/Y",strtotime($franchise->activate_date)) : "";
                            @endphp
                            <tr>
                                <td >{{$count}}</td>
                                <td data-label="@lang('Franchise ID')">{{ $franchise->franchise_id }}</td>
                                <td data-label="@lang('Franchise Name')">{{ $franchise->franchise_name }}</td>
                                <td data-label="@lang('Parent Franchise')">{{ $franchise->parent_franchise }}</td>
                                <td data-label="@lang('Type')">{{ $franchise->franchise_type }}</td>
                                <td data-label="@lang('Request Date')">{{ date_format($franchise->created_at,"d/m/Y") }}</td>
                                <td data-label="@lang('Activate Date')">{{ $franchise->activate_date }}</td>
                                <td data-label="@lang('Phone')">{{ $franchise->phone }}</td>
                                <td data-label="@lang('Adress')">{{ $franchise->address }}</td>
                                <td data-label="@lang('Create By')">{{ $franchise->created_by }}</td>
                                <td data-label="@lang('Status')">{{ $franchise->status }}</td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.franchise.edit', $franchise->id) }}" class="icon-btn" data-toggle="tooltip" data-original-title="@lang('Edit Profile')">
                                        <i class="las la-pen text--shadow"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="icon-btn btn--danger removeFranchise ml-1" data-toggle="tooltip" data-original-title="@lang('Remove')" data-id="{{ $franchise->id }}" data-name="{{ __($franchise->franchise_name) }}">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
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
                    {{ paginateLinks($franchises) }}
                </div>
            </div><!-- card end -->
        </div>


    </div>

    {{-- Remove Franchise MODAL --}}
    <div id="removeFranchiseModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.franchise.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to remove') <span class="font-weight-bold method-name"></span> @lang('franchise')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Remove')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <div class="mb-2">
        <a class="btn btn-sm btn--primary box--shadow1 text--small" href="{{ route('admin.franchise.registration') }}"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
    </div>
    <form action="{{ route('admin.franchise.search') }}" autocomplete="off" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Search')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
    <script>
        'use strict';
        (function($){
            $('.removeFranchise').on('click', function () {
                var modal = $('#removeFranchiseModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

        })(jQuery)
    </script>
@endpush
