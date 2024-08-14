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
                                <th scope="col">@lang('Order Id')</th>
                                <th scope="col">@lang('Order For')</th>
                                <th scope="col">@lang('Order Date')</th>
                                <th scope="col">@lang('Total MRP')</th>
                                <th scope="col">@lang('Total DP')</th>
                                <th scope="col">@lang('Total BV')</th>
                                <th scope="col">@lang('Discount')</th>
                                <th scope="col">@lang('Final Value')</th>
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
                                $order->action_date =  $order->action_date != null ? date("d-m-Y",strtotime($order->action_date)) : "";
                            @endphp
                            <tr>
                                <td >{{$count}}</td>
                                <td data-label="@lang('Order Id')">{{ $order->id }}</td>
                                <td data-label="@lang('Order For')">{{ $order->franchise->franchise_id. ' ( '.$order->franchise->franchise_name .' )' }}</td>
                                <td data-label="@lang('Order Date')">{{ date_format($order->created_at,"d-m-Y H:i:s") }}</td>
                                <td data-label="@lang('Total MRP')">{{ $order->total_dp }}</td>
                                <td data-label="@lang('Total DP')">{{ $order->total_dp }}</td>
                                <td data-label="@lang('Total BV')">{{ $order->total_bv }}</td>
                                <td data-label="@lang('Discount')">{{ $order->discount }}</td>
                                <td data-label="@lang('Final Value')">{{ $order->net_payable }}</td>
                                <td data-label="@lang('Action Date')">{{ $order->action_date }}</td>
                                <td data-label="@lang('Status')">{{ ucfirst($order->status) }}</td>
                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="badge badge-primary bg--orange viewProducts ml-1 mb-2 p-1" data-id="{{ $order->id }}" data-status="{{$order->status}}" data-fid ="{{$order->franchise->franchise_id}}">
                                        {{ 'View Products' }}
                                    </a></br>
                                    @if ($order->status === 'pending')
                                        <a href="javascript:void(0)" class="badge badge-success approveOrder ml-1 mb-2 p-1" data-id="{{ $order->id }}" >
                                            {{ 'Approve' }}
                                        </a></br>
                                        <a href="javascript:void(0)" class="badge badge-danger bg--pink rejectOrder ml-1 p-1" data-id="{{ $order->id }}" data-fid ="{{$order->franchise->franchise_id}}">
                                            {{ 'Reject' }}
                                        </a>
                                    @endif
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

    {{-- View Product MODAL --}}
    <div id="viewProductsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pt-4">
                    <div class="modal-title d-flex justify-content-between w-100">
                        <h5 >@lang('Products List')</h5>
                        <div class="d-flex">
                            <div class="net-payable-wrapper mr-3 d-none">
                                <span>Net Payable: </span><span id="product-net-payable" class=""></span>
                            </div>
                        </hr>
                            <div class="order-id-wrapper">
                                <span>Order ID: #</span><span id="order-id"></span>
                            </div>

                        </div>
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
                                        <th scope="col">@lang('DP')</th>
                                        <th scope="col">@lang('Total DP')</th>
                                        <th scope="col">@lang('Discount %')</th>
                                    </tr>
                                    </thead>
                                    <tbody id="order-products">
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" id="product-order-id" name="order_id">
                            <input type="hidden" id="franchise-id" name="franchise_id">
                            <div class="text-right mt-3">
                                <button type="submit" id="approve-product-order" class="btn btn--success">@lang('Approve')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Approve Order MODAL --}}
    <div id="approveOrderModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.stock.franchiseOrderApprove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approve') @lang('order Id - ')<span class="font-weight-bold method-name"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Reject Order MODAL --}}
    <div id="rejectOrderModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.stock.franchiseOrderReject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id">
                    <input type="hidden" name="franchise_id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to reject') </span>@lang('order Id - ')<span class="font-weight-bold method-name"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <form action="{{ route('admin.stock.search.orderRequest') }}" autocomplete="off" method="GET" class="form-inline float-sm-right bg--white">
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

            $('.approveOrder').on('click', function () {
                var modal = $('#approveOrderModal');
                modal.find('input[name=order_id]').val($(this).data('id'));
                modal.find('.method-name').text($(this).data('id'));
                modal.modal('show');
            });

            $('.rejectOrder').on('click', function () {
                var modal = $('#rejectOrderModal');
                var franchise_id = $(this).data('fid');
                modal.find('input[name=order_id]').val($(this).data('id'));
                modal.find('input[name=franchise_id]').val(franchise_id);
                modal.find('.method-name').text($(this).data('id'));
                modal.modal('show');
            });

            function addSerialNumber() {
                $('#order-products tr').each(function(index, tr) {
                    $(this).find('.sr-no').text(index+1);
                });
            }

            function calculateNetPayable() {
                var netPayable = 0;
                $('#order-products tr').each(function(index, tr) {
                    let total_dp = parseFloat($(this).find('.total-dp').text().trim());
                    let discount_percent = parseFloat($(this).find('.update-product-discount').val().trim());

                    netPayable += total_dp - (total_dp * (discount_percent/100));
                });

                $('#product-net-payable').text(netPayable);
                $('.net-payable-wrapper').removeClass('d-none');
            }

            function collectProductDiscount() {
                var discountData = [];
                $('#order-products tr').each(function(index, tr) {
                    let discountObj = {};
                    discountObj.product_id = $(this).data('id');
                    discountObj.total_dp = parseFloat($(this).find('.total-dp').text().trim());
                    discountObj.discount_percent = parseFloat($(this).find('.update-product-discount').val().trim());

                    discountData.push(discountObj);
                });

                return discountData;
            }


            $('.viewProducts').on('click', function () {
                var order_id = $(this).data('id');
                var franchise_id = $(this).data('fid');
                var order_status = $(this).data('status');
                $('#product-order-id').val(order_id);
                $('#franchise-id').val(franchise_id);


                if(order_status !== 'pending') {
                    $('#approve-product-order').hide();
                } else {
                    $('#approve-product-order').show();
                }
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url: "{{route('admin.stock.franchiseOrderProducts')}}",
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

                            //disable discount input box
                            if(order_status !== 'pending') {
                                $('#order-products tr').each(function() {
                                    $(this).find('.update-product-discount').prop('disabled',true);
                                });
                            } else {
                                $('#order-products tr').each(function() {
                                    $(this).find('.update-product-discount').prop('disabled',false);
                                });
                            }
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


            $(document).on('blur','.update-product-discount', function(e){
                e.stopPropagation();
                e.preventDefault();

                if($(this).val() > 100) {
                    iziToast.show({
                        position: 'topRight',
                        color: 'red',
                        message: 'Discount value should not be more than 100'
                    });
                } else {
                    calculateNetPayable();
                }
            });

            // Approve Product Order with discount

            $(document).on('click','#approve-product-order', function(){

                var discountData = collectProductDiscount();
                var order_id = $('#product-order-id').val();
                var franchise_id = $('#franchise-id').val();

                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.stock.franchiseOrderDiscountApprove')}}",
                    data: {
                        'franchise_id': franchise_id,
                        'order_id': order_id,
                        'discountData': discountData,
                        '_token': token
                    },
                    success: function(data) {
                        if (data.success) {

                            location.reload();

                            iziToast.show({
                                position: 'topRight',
                                color: 'green',
                                message: data.msg
                            });
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
