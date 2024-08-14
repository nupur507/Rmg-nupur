@extends('admin.layouts.app')

@section('panel')
    <form action="{{ route('admin.franchise.update', $franchise->id) }}" autocomplete="off"  method="POST">
        @csrf
        <div class="row mb-none-30">
            <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                {{-- Franchise Details --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title border-bottom pb-2">@lang('Franchise Details')</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Franchise ID') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="franchise_id" value="{{ $franchise->franchise_id }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Franchise Type')<span
                                            class="text-danger">*</span></label>
                                    <select name="franchise_type" class="form-control" disabled>
                                        <option value="">Select Type</option>
                                        <option value="store" {{ $franchise->franchise_type == 'store' ? "selected" : "" }} >Store</option>
                                    </select>

                                    @error('franchise_Type')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Parent Franchise') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="parent_franchise" value="{{ $franchise->parent_franchise }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('GST Registration Status') <span
                                            class="text-danger">*</span></label>
                                    <select name="gst_registration_status" id="gst-registration-status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="registered" {{ $franchise->gst_registration_status == 'registered' ? "selected" : "" }} >Registered</option>
                                        <option value="unregistered" {{ $franchise->gst_registration_status == 'unregistered' ? "selected" : "" }}>Unregistered</option>
                                    </select>
                                    @error('gst_registration_status')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class= {{ $franchise->gst_registration_status == "registered" ? "col-md-12" : "d-none" }} id="gst-number-parent">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('GST No.') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="gst_number" value="{{ $franchise->gst_number }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Sponsor Distributor Id') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="sponsor_distributor_id" name="sponsor_distributor_id" value="{{ $franchise->sponsor_distributor_id }}">
                                    @error('sponsor_distributor_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Sponsor Distributor Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="sponsor_distributor_name" name="sponsor_distributor_name"
                                        value="{{ $franchise->sponsor_distributor_name }}" readonly>
                                        @error('sponsor_distributor_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Direct Seller ID') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="direct_seller_id" name="direct_seller_id" value="{{ $franchise->direct_seller_id }}">
                                    @error('direct_seller_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Direct Seller') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="direct_seller" name="direct_seller" value="{{ $franchise->direct_seller }}" readonly>
                                    @error('direct_seller')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Franchise Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="franchise_name" value="{{ $franchise->franchise_name }}">
                                    @error('franchise_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Phone No.') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" maxlength="15" name="phone" value="{{ $franchise->phone }}">
                                    @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Email Address') </label>
                                    <input class="form-control" type="email" name="email" value="{{ $franchise->email }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('PAN') </label>
                                    <input class="form-control" type="text" name="pan" value="{{ $franchise->pan }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Password')</label>
                                    <input class="form-control" type="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Confirm Password')</label>
                                    <input class="form-control" type="password" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="row">
                    {{-- Franchise Bank Details --}}
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-30">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title border-bottom pb-2">@lang('Franchise Bank Details')</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('Bank Name')</label>
                                            <input class="form-control" type="text" name="bank_name" value="{{ $franchise->bank_name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('Branch Name')</label>
                                            <input class="form-control" type="text" name="branch_name"
                                                value="{{ $franchise->branch_name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('Account Number')</label>
                                            <input class="form-control" type="text" name="account_number"
                                                value="{{ $franchise->account_number }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('IFSC Code')</label>
                                            <input class="form-control" type="text" name="ifsc_code" value="{{ $franchise->ifsc_code }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Address Details --}}
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title border-bottom pb-2">@lang('Address Details')</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('Address') <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="address" cols="20" rows="2">{{ $franchise->address }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('State') <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="state" id="seleted-state" data-select="{{ $franchise->state }}" >
                                                @include('partials.state')
                                            </select>
                                            @error('state')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('City') <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="city" value="{{ $franchise->city }}">
                                            @error('city')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label  font-weight-bold">@lang('Pin Code') <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="pin_code" value="{{ $franchise->pin_code }}">
                                            @error('pin_code')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-4 ml-auto mt-3">
                                        <div class="form-group mb-3">
                                            <button type="submit"
                                                class="btn btn--primary btn-block btn-lg">@lang('Update')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Row End --}}
        </div>

    </form>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.franchise.list') }}" class="btn btn-sm btn--dark box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Go Back')
    </a>
@endpush

@push('script')
    <script>
        'use strict';
        (function($){
            $('#gst-registration-status').on('change', function () {
                let status = $(this).val()
                if(status === 'registered'){
                    $('#gst-number-parent').removeClass('d-none').addClass('col-md-12');
                } else {
                    $('#gst-number-parent').addClass('d-none');
                }
            });

            $(document).on('blur', '#sponsor_distributor_id', function() {
                var dist_id = $('#sponsor_distributor_id').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('check.username')}}",
                    data: {
                        'username': dist_id,
                        '_token': token
                    },
                    success: function(data) {
                        if (data.success) {
                            $("#sponsor_distributor_name").val(data.data.username);
                        } else {
                            $("#sponsor_distributor_name").val('');
                        }
                    }
                });
            });

            $(document).on('blur', '#direct_seller_id', function() {
                var seller_id = $('#direct_seller_id').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('check.username')}}",
                    data: {
                        'username': seller_id,
                        '_token': token
                    },
                    success: function(data) {
                        if (data.success) {
                            $("#direct_seller").val(data.data.username);
                        } else {
                            $("#direct_seller").val('');
                        }
                    }
                });
            });

            //select current state
            var selectedState = $("#seleted-state").attr('data-select');
            $('#seleted-state option[value="'+selectedState+'"]').prop('selected', true);

        })(jQuery)
    </script>
@endpush


