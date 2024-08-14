@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Product')</th>
                                <th scope="col">@lang('MRP')</th>
                                <th scope="col">@lang('DP')</th>
                                <th scope="col">@lang('BV')</th>
                                <th scope="col">@lang('GST') </th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td data-label="@lang('Method')">
                                        <div class="user">
                                            <div class="thumb"><img src="{{ getImage(imagePath()['product']['path'].'/'. $product->image,imagePath()['product']['size'])}}" alt="@lang('image')"></div>

                                            <span class="name">{{__($product->name)}}</span>
                                        </div>
                                    </td>

                                    <td data-label="@lang('MRP')"
                                        class="font-weight-bold">{{ __($product->mrp) }}</td>
                                    <td data-label="@lang('DP')"
                                        class="font-weight-bold">{{ __($product->dp) }}</td>
                                    <td data-label="@lang('BV')"
                                        class="font-weight-bold">{{ $product->bv}}</td>
                                    <td data-label="@lang('GST')">{{ $product->gst }} %</td>
                                    <td data-label="@lang('Status')">
                                        @if($product->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                            <span class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('admin.product.edit', $product->id)}}"
                                           class="icon-btn ml-1" data-toggle="tooltip" data-original-title="@lang('Edit')"><i class="las la-pen"></i></a>
                                        {{-- @if($product->status == 1)
                                            <a href="javascript:void(0)" class="icon-btn btn--danger deactivateBtn  ml-1" data-toggle="tooltip" data-original-title="@lang('Disable')" data-id="{{ $product->id }}" data-name="{{ __($product->name) }}">
                                                <i class="la la-eye-slash"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="icon-btn btn--success activateBtn  ml-1"
                                               data-toggle="tooltip" data-original-title="@lang('Enable')"
                                               data-id="{{ $product->id }}" data-name="{{ __($product->name) }}">
                                                <i class="la la-eye"></i>
                                            </a>
                                        @endif --}}
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
            </div><!-- card end -->
        </div>
    </div>


    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdrawal Method Activation Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Activate')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdrawal Method Disable Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Disable')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text--small" href="{{ route('admin.product.create') }}"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush


@push('script')
    <script>
        'use strict';
        (function($){
            $('.activateBtn').on('click', function () {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.deactivateBtn').on('click', function () {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

        })(jQuery)

    </script>
@endpush
