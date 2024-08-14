@extends($activeTemplate.'layouts.master')

@section('content')

<!-- Blog Section -->
<section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">

            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post__item">
                        <div class="post__thumb">
                            <a href="{{route('singleBlog', [slug(@$blog->data_values->title), $blog])}}">
                                <img src="{{ getImage('assets/images/frontend/blog/thumb_'.@$blog->data_values->blog_image, '600x300') }}" alt="@lang('blog')">
                            </a>
                            <div class="post__date">
                                <h4 class="date">{{showDateTime($blog->created_at, 'd')}}</h4>
                                <span>{{showDateTime($blog->created_at, 'M')}}</span>
                            </div>
                        </div>
                        <div class="post__content">
                            <div class="overflow-hidden">
                                <div class="post__meta">
                                    <a class="item">
                                        <i class="las la-user"></i>
                                        <span>@lang('Admin')</span>
                                    </a>
                                </div>
                            </div>
                            <h5 class="post__title">
                                <a href="{{route('singleBlog', [slug(@$blog->data_values->title), $blog])}}">{{ __(@$blog->data_values->title) }}</a>
                            </h5>
                            <a href="{{route('singleBlog', [slug(@$blog->data_values->title), $blog])}}" class="text--base">@lang('Read More') <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $blogs->links() }}

        </div>
    </div>
</section>
<!-- Blog Section -->

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection


