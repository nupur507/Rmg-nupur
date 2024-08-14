@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <img id="output" src="{{ getImage('assets/images/user/profile/'. auth()->user()->image,  null, true)}}" alt="@lang('profile-image')" class="b-radius--10 w-100">
                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>@lang('Name')</span> {{auth()->user()->fullname}}
                            </li>
                            <li class="list-group-item rounded-0 d-flex justify-content-between">
                                <span>@lang('Username')</span> {{auth()->user()->username}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Update KYC Details')</h5>
                    <form action="{{ route('user.update-kyc') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Adhaar Number') <span
                                class="text-danger">*</span></label></label>
                            <div class="col-lg-9">
                                <input class="form-control form-control-lg" type="text" name="adhaar_no" value="{{$kyc?$kyc->adhaar_no:''}}" required minlength="12">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Adhaar File') <span
                                class="text-danger">*</span></label></label>
                            <div class="col-lg-9">
                                @if($kyc && $kyc->is_approved !=2)
                                <a href="{{route('user.adhaar.download',encrypt($kyc->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('Adhaar File')</a>

                                @else
                                <input class="form-control form-control-lg" type="file" accept="image/*" name="adhaar_file" required>
                               @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('PAN Number') <span
                                class="text-danger">*</span></label></label>
                            <div class="col-lg-9">
                                <input class="form-control form-control-lg" type="text" name="pancard" required minlength="10" value="{{$kyc?$kyc->pancard:''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Pan File') <span
                                class="text-danger">*</span></label></label>
                            <div class="col-lg-9">
                                @if($kyc && $kyc->is_approved !=2)
                                <a href="{{route('user.pan.download',encrypt($kyc->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('PAN File')</a>

                                @else
                                <input class="form-control form-control-lg" type="file" accept="image/*" name="pan_file" required>
                                 @endif
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">@lang('Bank Passbook') <span
                                class="text-danger">*</span></label></label>
                            <div class="col-lg-9">
                                @if($kyc && $kyc->is_approved !=2)
                                <a href="{{route('user.bankfile.download',encrypt($kyc->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('Passbook File')</a>

                                @else
                                <input class="form-control form-control-lg" type="file" accept="image/*" name="bank_file" required>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                @if($kyc && $kyc->is_approved !=2)

                                @else
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                               @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{route('user.profile-setting')}}" class="btn btn--success btn--shadow"><i class="fa fa-user"></i>@lang('Profile Setting')</a>
@endpush

@push('script')
    <script>
        'use strict';

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };


    </script>
@endpush
