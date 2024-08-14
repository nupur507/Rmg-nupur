@extends($activeTemplate.'layouts.master')

@section('content')
    <!-- Blog Single -->
    <section class="blog-section bg--section pt-120 pb-120">
		<div class="container">
			<div class="row gy-5 justify-content-center">
				<div class="col-lg-8">
					<div class="post__details mb-5">
						<div class="post__thumb">
							<img src="{{ getImage('assets/images/frontend/blog/'.$blog->data_values->blog_image, '700x450') }}" alt="@lang('blog')">
						</div>
                        <div class="post__header">
							<h3 class="post__title">
                                {{ __($blog->data_values->title) }}
							</h3>
						</div>
                        <p>@php echo $blog->data_values->description; @endphp</p>
						<div class="row gy-4 justify-content-between">
							<div class="col-md-6">
								<h6 class="post__share__title">@lang('Share now')</h6>
								<ul class="post__share">
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/share?url={{urlencode(url()->current()) }}" target="_blank">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" target="_blank">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </li>
								</ul>
							</div>
						</div>
					</div>
                    <div class="mb-5">
                        <div class="comments-area">
                            <div class="fb-comments" data-width="100%" data-numposts="5"></div>
                        </div>    
                    </div>
				</div>
				<div class="col-lg-4">
					<aside class="blog-sidebar bg--body">
						<div class="widget widget__post__area">
							<h5 class="widget__title">@lang('Recent Blog')</h5>
							<ul>
                                @foreach($latestBlogs as $latestBlog)
                                    <li>
                                        <a href="{{route('singleBlog', [slug(@$latestBlog->data_values->title), $latestBlog])}}" class="widget__post">
                                            <div class="widget__post__thumb">
                                                <img src="{{ getImage('assets/images/frontend/blog/'.@$latestBlog->data_values->blog_image, '700x450') }}" alt="@lang('blog')">
                                            </div>
                                            <div class="widget__post__content">
                                                <h6 class="widget__post__title">
                                                    {{ __(shortDescription(@$latestBlog->data_values->title, 60)) }}
                                                </h6>
                                                <span>{{showDateTime(@$latestBlog->created_at, 'd F, Y')}}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</section>
    <!-- Blog Single -->
@endsection

@push('script')
    @php echo fbcomment() @endphp
@endpush





