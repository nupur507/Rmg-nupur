@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{route('admin.survey.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $survey->id }}" required>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Survey Image')</label>
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage(imagePath()['survey']['path'].'/'. $survey->image,imagePath()['survey']['size'])}})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>

                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success"> @lang('Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg, jpg, png')</b>.
                                                @lang('Image Will be resized to'): <b>{{imagePath()['survey']['size']}}</b> @lang('px').

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>@lang('Select Category')</label>
                                    <select name="category_id" class="form-control" required>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{__($item->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Survey Name')</label>
                                    <input type="text"class="form-control" placeholder="@lang('Enter Name')" name="name" value="{{$survey->name}}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('Status')</label>
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Disabled')" name="status" @if($survey->status) checked @endif>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.survey.all') }}" class="btn btn-sm btn--dark box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
@endpush

@push('script')
    <script>
        'use strict';

        (function ($) {
            $('select[name="category_id"]').val('{{$survey->category->id}}');
        })(jQuery);
    </script>
@endpush
