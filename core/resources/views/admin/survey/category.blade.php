
@extends('admin.layouts.app')

@section('panel')

<div class="row">
    <div class="col-lg-12 col-md-12 mb-30">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--md table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('SL')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse ($categories as $key => $item)
                                <tr>
                                    <td data-label="@lang('SL')">{{ $key+1 }}</td>
                                    <td data-label="@lang('Name')">{{ $item->name }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                            <span class="text--small badge font-weight-normal badge--danger">@lang('Disabled')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <a href="#" class="icon-btn  updateBtn" data-id="{{$item->id}}" data-name="{{$item->name}}" data-status="{{ $item->status }}"
                                            data-toggle="modal" data-target="#updateBtn"
                                        >
                                            <i class="la la-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                {{ $categories->links('admin.partials.paginate') }}
            </div>
        </div>
    </div>
</div>

{{-- Add METHOD MODAL --}}
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('Add New Category')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.survey.category.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Category Name')</label>
                        <input type="text"class="form-control" placeholder="@lang('Enter Name')" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">@lang('Status')</label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Disable')" name="status" checked>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-block btn btn--primary">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Update METHOD MODAL --}}
<div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('Update Category')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.survey.category.update') }}" class="edit-route" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Category Name')</label>
                        <input type="text"class="form-control" placeholder="@lang('Enter Name')" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">@lang('Status')</label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Disable')" name="status" checked>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-block btn btn--primary">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('breadcrumb-plugins')
    <div class="item">
        <a href="javascript:void(0)" class="btn btn-lg btn--success box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
    </div>
@endpush
@endsection

@push('script')
<script>
    (function ($) {
        'use strict';
        $('.addBtn').on('click', function () {
            var modal = $('#addModal');
            modal.modal('show');
        });

        $('.updateBtn').on('click', function () {
            var modal = $('#updateBtn');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));

            if($(this).data('status') == 1){
                modal.find('input[name=status]').bootstrapToggle('on');
            }else{
                modal.find('input[name=status]').bootstrapToggle('off');
            }

        });

    })(jQuery);
</script>
@endpush
