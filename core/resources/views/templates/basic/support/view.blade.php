@extends($activeTemplate.'layouts.master')

@section('content')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-xl-12">
                <div class="card  cmn--card">
                    <div class="card-header d-flex flex-wrap justify-content-between" style="gap: 10px">
                        <h6 class="my-0">
                            @if($my_ticket->status == 0)
                                <span class="badge badge--success">@lang('Open')</span>
                            @elseif($my_ticket->status == 1)
                                <span class="badge badge--primary">@lang('Answered')</span>
                            @elseif($my_ticket->status == 2)
                                <span class="badge badge--warning">@lang('Replied')</span>
                            @elseif($my_ticket->status == 3)
                                <span class="badge badge--danger">@lang('Closed')</span>
                            @endif
                            [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}
                        </h6>

                        @if($my_ticket->status != 3)
                            <button class="btn btn--danger btn-sm close-button" type="button" data-bs-toggle="modal" data-bs-target="#DelModal"><i class="fa fa-times me-2"></i> @lang('Close Ticket')
                            </button>
                        @endif
                    </div>

                    <div class="card-body">
                        @if($my_ticket->status != 3)
                            <div class="accordion" id="accordionExample">
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="replayTicket" value="1">
                                        <div class="row justify-content-between">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control form--control" id="inputMessage" placeholder="@lang('Your Reply')" rows="4" cols="10" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between align-items-center gy-3 pb-3">
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label class="form--label-2 text--title">@lang('Attachments')</label>
                                                    <div class="input-group d-flex mb-2">
                                                        <input type="file" class="form-control form--control" name="attachments[]">
                                                        <a href="javascript:void(0)" class="btn btn--success btn-round addFile support-btn"
                                                        onclick="extraTicketAttachment()">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                                <div id="fileUploadsContainer"></div>
                                                    <p class="my-2 ticket-attachments-message text-muted fs--13px">
                                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="cmn--btn"><i class="fa fa-reply"></i>&nbsp;@lang('Reply')</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0 p-sm-3">
                        @foreach($messages as $message)
                            @if($message->admin_id == 0)
                                <div class="row border border-primary border-radius-3 my-3 py-5 mx-sm-2">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="mb-3 ">{{ $message->ticket->name }}</h5>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold mb-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments()->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="row border border-warning border-radius-3 my-3 py-5 mx-sm-2">
                                    <div class="col-md-3 border-right text-right">
                                        <h5 class="my-3">{{ $message->admin->name }}</h5>
                                        <p class="lead text-muted">@lang('Staff')</p>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="text-muted font-weight-bold my-3">
                                            @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}</p>
                                        <p>{{$message->message}}</p>
                                        @if($message->attachments()->count() > 0)
                                            <div class="mt-2">
                                                @foreach($message->attachments as $k=> $image)
                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal cmn--modal fade" id="DelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('Confirmation Alert')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                @csrf
                <div class="modal-body">
                    <strong class="text-dark">@lang('Are you sure to close this support ticket')?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn--base" name="replayTicket" value="2">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/ticket.css')}}">
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";

            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });

        })(jQuery);

        function extraTicketAttachment() {
            $("#fileUploadsContainer").append(`
                <div class="input-group d-flex mt-4">
                    <input type="file" name="attachments[]" class="form-control form--control"/>
                    <button class="input-group-text support-btn remove-btn btn--danger border-0"><i class="las la-times"> </i></button>
                </div>
            `)
        }
    </script>
@endpush
