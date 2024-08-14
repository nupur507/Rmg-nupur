@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-20">@lang('New Product Form')</h6>
                        <div class="payment-method-item">
                            <div class="payment-method-header d-flex flex-wrap">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{getImage('/',imagePath()['product']['size'])}})"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="form-group">
                                        <label class="font-weight-bold">@lang('Product Name')</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="font-weight-bold">@lang('MRP') <span class="text-danger">*</span></label>

                                               <div class="input-group">
                                                   <input type="text" name="mrp" class="form-control border-radius-5" value="{{ old('mrp') }}"/>
                                               </div>
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('DP')  <span class="text-danger">*</span></label>
                                                <input type="text" name="dp" class="form-control border-radius-5" value="{{ old('dp') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border--primary mb-2">
                                            <h5 class="card-header bg--primary">@lang('Business')</h5>
                                            <div class="card-body">

                                                <label class="font-weight-bold">@lang('BV') <span class="text-danger">*</span></label>
                                                <div class="input-group has_append mb-3">
                                                    <input type="text" class="form-control" name="bv" placeholder="0" value="{{ old('bv') }}"/>
                                                    
                                                </div>

                                                <label class="font-weight-bold">@lang('PV') <span class="text-danger">*</span></label>
                                                <div class="input-group has_append">
                                                    <input type="text" class="form-control" placeholder="0" name="pv" value="{{ old('pv') }}"/>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary">@lang('Tax')</h5>
                                            <div class="card-body">
                                                <label class="font-weight-bold">@lang('GST') <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="0" name="gst" value="{{ old('gst') }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> % </div>
                                                    </div>
                                                </div>
                                                <label class="font-weight-bold">@lang('HSN Code') <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="0" name="hsn_code" value="{{ old('hsn_code') }}">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark my-2">

                                            <h5 class="card-header bg--dark">@lang('Product Details') </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction">{{ old('instruction') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Save')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn--dark box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Go Back')
    </a>
@endpush

@push('script')
    <script>
        'use strict';
        (function($){
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });

            $('.addUserData').on('click', function () {
                var html = `
                    <div class="col-md-12 user-data">
                        <div class="form-group">
                            <div class="input-group mb-md-0 mb-4">
                                <div class="col-md-4">
                                    <input name="field_name[]" class="form-control" type="text" value="" required placeholder="@lang('Field Name')">
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="type[]" class="form-control">
                                        <option value="text" > @lang('Input Text') </option>
                                        <option value="textarea" > @lang('Textarea') </option>
                                        <option value="file"> @lang('File upload') </option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="validation[]"
                                            class="form-control">
                                        <option value="required"> @lang('Required') </option>
                                        <option value="nullable">  @lang('Optional') </option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-md-0 mt-2 text-right">
                                    <span class="input-group-btn">
                                        <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            @if(old('currency'))
                $('input[name=currency]').trigger('input');
            @endif
        })(jQuery)


    </script>
@endpush
