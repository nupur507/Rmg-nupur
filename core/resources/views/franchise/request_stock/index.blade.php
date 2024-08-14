@extends('franchise.layouts.app')

@section('panel')

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-3">
                {{-- Add Product form starts --}}
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Product') <span
                                class="text-danger">*</span></label>
                            <select name="product_id" id="product-id" class="form-control">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Quantity') <span
                                class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="quantity" name="quantity" value="{{old('quantity')}}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group pt-1">
                            <button type="button" id="add-product" class="btn btn--primary btn-block btn-lg mt-25">@lang('Add')</button>
                        </div>
                    </div>
                </div>
                {{-- Add Product form ends --}}


                {{-- Order Product Listing --}}
                <div id="product-table" class="table-responsive--md  table-responsive mt-15 d-none">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('S.No.')</th>
                                <th scope="col">@lang('Product ID')</th>
                                <th scope="col">@lang('Product Name')</th>
                                <th scope="col">@lang('DP')</th>
                                <th scope="col">@lang('BV')</th>
                                <th scope="col">@lang('GST')</th>
                                <th scope="col">@lang('Quantity')</th>
                                <th scope="col">@lang('Total DP')</th>
                                <th scope="col">@lang('Total BV')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody id="product_body">

                        </tbody>
                    </table>
                </div>

                {{-- Order Product Listing ends --}}

            </div>
        </div>
    </div>
    {{-- Product card ends --}}
    <div class="col-lg-12 mt-4">
        <div class="card b-radius--10 ">
            <h6 class="card-title p-3 m-0">Billing Details</h6>
            <div class="card-body pt-0">
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <td><b>DP :- </b><span id="billing-dp"></span></td>
                                <td><b>BV :- </b><span id="billing-bv"></span></td>
                                <td><b>Wallet (Rs.) :- </b><span id="wallet" class="d-none">{{ number_format(auth('franchise')->user()->balance, 2, '.','') }}</span></td>
                                <td><b>Net Payable (Rs.) :- </b><span id="net-payable"></span></td>
                            </tr>
                        </thead>
                    </table>
                </div>

                {{-- Order Now Button --}}
                <div class="row">
                    <div class="col-lg-2 col-md-2 ml-auto">
                        <button type="button" id="order_now" class="btn btn--primary btn-block btn-lg mt-25">@lang('Order Now')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('script')
    <script>
        'use strict';
        (function($){

            function updateBillingDetails() {
                var dp_amount = 0;
                var bv_amount = 0;

                $('.product-dp').each(function(index, data) {
                    dp_amount += parseFloat($(this).text());
                });

                $('.product-bv').each(function(index, data) {
                    bv_amount += parseFloat($(this).text());
                });

                $('#billing-dp').text(dp_amount.toFixed(2));
                $('#billing-bv').text(bv_amount.toFixed(2));
                $('#net-payable').text(dp_amount.toFixed(2));

                $('#wallet').removeClass('d-none');
            }

            function addSerialNumber() {
                $('#product_body tr').each(function(index, tr) {
                    $(this).find('.sr-no').text(index+1);
                });
            }

            $(document).on('click', '#add-product', function() {
                var product_id = $('#product-id').val();
                var quantity = $('#quantity').val();
                var token = "{{csrf_token()}}";

                if(product_id === '' || quantity === ''){
                    iziToast.show({
                                position: 'topRight',
                                color: 'red',
                                message: 'Product and quantity both are required!'
                            });
                } else {
                    if($("#product-row-" + product_id).length > 0) {
                        iziToast.show({
                                        position: 'topRight',
                                        color: 'red',
                                        message: 'Product already added!'
                                    });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{route('franchise.request.stock.addProduct')}}",
                            data: {
                                'product_id': product_id,
                                'quantity': quantity,
                                '_token': token
                            },
                            success: function(data) {
                                if (data.success) {
                                    $('#product_body').append(data.data);
                                    iziToast.show({
                                        position: 'topRight',
                                        color: 'green',
                                        message: data.msg
                                    });

                                    $('#product-table').removeClass('d-none');

                                    //reset input values
                                    $('#product-id').val('');
                                    $('#quantity').val('');

                                    // update billing details
                                    updateBillingDetails();

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
                    }
                }
            });

            $(document).on('click','.deleteProduct', function(e) {
                e.preventDefault();
                $('#'+$(this).attr('data-id')).remove();

                //update billing
                updateBillingDetails();
            });


            // $(document).on('click','order_now', function(e) {
            $('#order_now').on('click', function() {
                var wallet_balance = parseFloat($('#wallet').text());
                var net_Payable = parseFloat($('#net-payable').text());

                if(wallet_balance < net_Payable){
                    iziToast.show({
                        position: 'topRight',
                        color: 'red',
                        message: 'Wallet balance is less than Net-payable amount!'
                    });
                } else if(net_Payable == 0 || isNaN(net_Payable)) {
                    iziToast.show({
                        position: 'topRight',
                        color: 'red',
                        message: 'Please add product!'
                    });
                } else {

                    var product_details = [];
                    var order_details = {};
                    var token = "{{csrf_token()}}";

                    $('#product_body tr').each(function(index, tr) {
                        let product_data = {}
                        product_data.product_id = $(this).attr('data-id');
                        product_data.quantity = $(this).attr('data-qty');
                        product_data.dp = $(this).attr('data-dp');
                        product_data.bv = $(this).attr('data-bv');

                        product_details.push(product_data);
                    });

                    order_details.total_dp = $('#billing-dp').text();
                    order_details.total_bv = $('#billing-bv').text();
                    order_details.balance = $('#wallet').text();

                    $.ajax({
                        type: "POST",
                        url: "{{route('franchise.request.stock.placeOrder')}}",
                        data: {
                            'product_details': product_details,
                            'order_details': order_details,
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
                }
            });

        })(jQuery)
    </script>
@endpush
