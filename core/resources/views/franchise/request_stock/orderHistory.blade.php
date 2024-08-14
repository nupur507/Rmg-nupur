@extends('franchise.layouts.app')

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
                                <th scope="col">@lang('Order Id')</th>
                                <th scope="col">@lang('Order Date')</th>
                                <th scope="col">@lang('Total DP')</th>
                                <th scope="col">@lang('Total BV')</th>
                                <th scope="col">@lang('Final Value')</th>
                                <th scope="col">@lang('Place By')</th>
                                <th scope="col">@lang('Action Date')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count=1;
                            @endphp
                            @forelse($orders as $order)
                            @php
                                $order->action_date =  $order->action_date != null ? date("d/m/Y",strtotime($order->action_date)) : "";
                            @endphp
                            <tr>
                                <td >{{$count}}</td>
                                <td data-label="@lang('Order Id')">{{ $order->id }}</td>
                                <td data-label="@lang('Order Date')">{{ date_format($order->created_at,"d-m-Y H:i:s") }}</td>
                                <td data-label="@lang('Total DP')">{{ $order->total_dp }}</td>
                                <td data-label="@lang('Total BV')">{{ $order->total_bv }}</td>
                                <td data-label="@lang('Final Value')">{{ $order->total_dp }}</td>
                                <td data-label="@lang('Place By')">{{ $orderBy }}</td>
                                <td data-label="@lang('Action Date')">{{ $order->action_date }}</td>
                                <td data-label="@lang('Status')">{{ $order->status }}</td>
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="badge badge-primary bg--orange viewProducts ml-1" data-id="{{ $order->id }}" >
                                        {{ 'View Products' }}
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
                    {{ paginateLinks($orders) }}
                </div>
            </div><!-- card end -->
        </div>


    </div>

    {{-- Remove Franchise MODAL --}}
    <div id="viewProductsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pt-4">
                    <div class="modal-title d-flex justify-content-between w-100">
                        <h5 >@lang('Products List')</h5>
                        <div><span>Order ID: #</span><span id="order-id"></span></div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card b-radius--10 ">
                        <div class="card-body p-0">
                            <div class="table-responsive--md  table-responsive">
                                <table class="table table--light style--two">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('S.No.')</th>
                                        <th scope="col">@lang('Product')</th>
                                        <th scope="col">@lang('Quantity')</th>
                                        <th scope="col">@lang('MRP')</th>
                                        <th scope="col">@lang('DP')</th>
                                        <th scope="col">@lang('BV')</th>
                                        <th scope="col">@lang('Total MRP')</th>
                                        <th scope="col">@lang('Total DP')</th>
                                        <th scope="col">@lang('Total BV')</th>
                                    </tr>
                                    </thead>
                                    <tbody id="order-products">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <form action="{{ route('franchise.request.stock.orderSearch') }}" autocomplete="off" method="GET" class="form-inline float-sm-right bg--white">
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

            function addSerialNumber() {
                $('#order-products tr').each(function(index, tr) {
                    $(this).find('.sr-no').text(index+1);
                });
            }

            $('.viewProducts').on('click', function () {
                var order_id = $(this).data('id');
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url: "{{route('franchise.request.stock.orderHistoryProducts')}}",
                    data: {
                        'order_id': order_id,
                        '_token': token
                    },
                    success: function(data) {
                        if (data.success) {
                            var modal = $('#viewProductsModal');
                            modal.find('#order-products').html(data.data)
                            modal.find('#order-id').text(order_id)
                            modal.modal('show');
                            // Add serial number
                            addSerialNumber();
                        } else {
                                iziToast.show({
                                    position: 'topRight',
                                    color: 'red',
                                    message: data.msg
                                });
                            }
                    }
                });
            });

        })(jQuery)
    </script>
@endpush
