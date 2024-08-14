@php
    $blogCaption = getContent('blog.content',true);
    $blogs = getContent('blog.element',false,3);
@endphp

<!-- Blog Section -->
<section class="blog-section pt-60 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section__header text-center">
                    <span class="section__cate">{{ __(@$blogCaption->data_values->heading) }}</span>
                    <h3 class="section__title">{{ __(@$blogCaption->data_values->subheading) }}</h3>
                    <p>
                        {{ __(@$blogCaption->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
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

        </div>
    </div>
</section>
<!-- Blog Section -->

