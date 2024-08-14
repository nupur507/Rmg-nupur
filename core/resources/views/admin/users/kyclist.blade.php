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
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Adhaar No')</th>
                                <th scope="col">@lang('Adhaar File')</th>
                                <th scope="col">@lang('PAN')</th>
                                <th scope="col">@lang('PAN File')</th>
                                <th scope="col">@lang('Passbook')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($kycs as $user)

                            @php
                            $status = 'Pending';
                            if($user->is_approved==1){
                                $status = 'Approved';

                            }else if($user->is_approved==2){
                                $status = 'Rejected';

                            }
                            @endphp
                            <tr>
                                <td data-label="@lang('User')">
                                    <div class="user">
                                        {{-- <div class="thumb">
                                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$user->user->image,imagePath()['profile']['user']['size'])}}" alt="@lang('image')">
                                        </div> --}}
                                        <span class="name">{{$user->user->fullname}}</span>
                                    </div>
                                </td>
                                <td data-label="@lang('Username')"><a href="{{ route('admin.users.detail', $user->user->id) }}">{{ $user->user->username }}</a></td>
                                <td data-label="@lang('Adhaar No')">{{ $user->adhaar_no }}</td>
                                <td data-label="@lang('Adhaar File')">
                                    <div class="">
                                        <div class="thumb">
                                            <a href="{{route('user.adhaar.download',encrypt($user->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('Adhaar File')</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="@lang('PAN')">{{ ($user->pancard) }}</td>
                                <td data-label="@lang('PAN File')">
                                    <div class="">
                                        <div class="thumb">
                                            <a href="{{route('user.pan.download',encrypt($user->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('PAN File')</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="@lang('Passbook')">
                                    <div class="">
                                        <div class="thumb">
                                            <a href="{{route('user.bankfile.download',encrypt($user->id))}}" class="mr-3"><i class="fa fa-file"></i> @lang('Passbook File')</a>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="@lang('Status')">{{ $status}}</td>

                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn btn--info bankDetail ml-1" data-toggle="tooltip" data-original-title="@lang('Bank Details')" data-id="{{ $user->user->id }}" >
                                        <i class="la la-lock"></i>
                                    </a>
                                  @if($user->is_approved==0)  
                                    <a href="javascript:void(0)" class="icon-btn btn--success approveKyc ml-1" data-toggle="tooltip" data-original-title="@lang('Approve')" data-id="{{ $user->id }}" >
                                        <i class="la la-check"></i>
                                    </a>

                                    <a href="javascript:void(0)" class="icon-btn btn--danger rejectKyc ml-1" data-toggle="tooltip" data-original-title="@lang('Reject')" data-id="{{ $user->id }}" >
                                        <i class="la la-close"></i>
                                    </a>
                                    @endif
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
                    {{ paginateLinks($kycs) }}
                </div>
            </div><!-- card end -->
        </div>


    </div>

      {{-- Approve KYC MODAL --}}
      <div id="approveKycModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.approve-kyc') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approve') <span class="font-weight-bold method-name"></span> @lang('kyc')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     {{-- Reject KYC MODAL --}}
     <div id="rejectKycModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.reject-kyc') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to reject') <span class="font-weight-bold method-name"></span> @lang('kyc')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     {{-- BankDetailModal --}}

     
    <div class="modal fade user-details-modal-area" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle">@lang('Bank Details')</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="user-details-modal">
                   <div class="user-details-header ">
                       {{-- <div class="thumb"><img src="#" alt="*" class="tree_image w-h-100-p"
                           ></div> --}}
                       <div class="content">
                           <a class="user-name tree_url tree_name" href=""></a>

                       </div>
                   </div>
                   <div class="user-details-body text-center">



                       <table class="table table-bordered">
                           

                           <tr>
                               <td>@lang('Account Name')</td>
                               <td><span class="acc_name"></span></td>
                           </tr>
                           <tr>
                               <td>@lang('Account Number')</td>
                               <td><span class="acc_number"></span></td>
                           </tr>

                           <tr>
                               <td>@lang('Bank Name')</td>
                               <td><span class="bank_name"></span></td>
                           </tr>
                           <tr>
                            <td>@lang('IFSC Code')</td>
                            <td><span class="ifsc_code"></span></td>
                        </tr>
                       </table>

                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

@endsection



@push('breadcrumb-plugins')
    <form action="{{ route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
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
            $('.approveKyc').on('click', function () {
                var modal = $('#approveKycModal');
                // modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

            $('.rejectKyc').on('click', function () {
                var modal = $('#rejectKycModal');
                // modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

            $('.bankDetail').on('click', function () {
                var modal = $('#exampleModalCenter');
                var token = "{{csrf_token()}}";
                var id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: "{{route('users.bankdetail')}}",
                data: {
                    'id': id,
                    '_token': token
                },
                success: function(data) {
                    if (data.success) {
                        // $('.tree_username').text(data.data.username);
                        // $('.tree_name').text(data.data.username);
                        // $('.tree_image').attr({"src": data.data.img});
                        $('.acc_name').text(data.data.bank_holder_name);
                        $('.acc_number').text(data.data.bank_acc_no);
                        $('.bank_name').text(data.data.bank_name);
                        $('.ifsc_code').text(data.data.bank_ifsc_code);
                        $('#exampleModalCenter').modal('show');

                    } else {
                        // $('select[name=position]').attr('disabled', true);
                        // $('#position-test').html(not_select_msg);
                    }
                }
            });

       
            });

        })(jQuery)
    </script>
@endpush
