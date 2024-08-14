@extends($activeTemplate.'layouts.master')

@section('content')

@php
    $banner = getContent('banner.content', true);
@endphp

<!-- Banner -->
<section class="banner-section bg--title shapes-container">
    <div class="banner-shape shape1">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/1.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape2">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/2.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape3">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/3.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape4">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/4.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape5">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/5.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape6">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/6.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape7">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/7.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape8">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/8.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape9">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/9.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="banner-shape shape10">
        <img src="{{asset($activeTemplateTrue . 'images/banner/shapes/10.png')}}" alt="@lang('banner-shapes')">
    </div>
    <div class="container">
        <div class="banner__wrapper">
            <div class="banner__wrapper-content">
                <h2 class="banner__wrapper-content-title">{{__(@$banner->data_values->heading)}}</h2>
                <p class="banner__wrapper-content-txt">
                    {{__(@$banner->data_values->subheading)}}
                </p>
                <div class="btn__grp white-btns">
                    <a href="{{__(@$banner->data_values->left_button_link)}}" class="cmn--btn">{{__(@$banner->data_values->left_button)}}</a>
                    <a href="{{__(@$banner->data_values->right_button_link)}}" class="cmn--btn">{{__(@$banner->data_values->right_button)}}</a>
                </div>
            </div>
            <div class="banner__wrapper-thumb">
                <img src="{{getImage('assets/images/frontend/banner/' . @$banner->data_values->background_image, '770x610')}}" alt="@lang('banner')">
            </div>
        </div>
    </div>
</section>
<!-- Banner -->
<img class="img-fluid" src="{{asset('assets/images/frontend/offer2.jpeg')}}" data-bs-toggle="modal" data-bs-target="#simple-modal" data-bigimage="{{asset('assets/images/frontend/offer2.jpeg')}}" style="display:none">
<div class="modal fade" style="top:150px" role="dialog" tabindex="-1" id="simple-modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content"><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			<div class="modal-body"><img class="img-fluid" id="image" src=""></div>
		</div>
	</div>
</div>
{{-- <div class="popup">
    <img src="https://pbs.twimg.com/media/CX1PAZwVAAANemW.jpg">
  </div>
  <div class="show">
    <div class="overlay"></div>
    <div class="img-show">
      <span>X</span>
      <img src="">
    </div>
  </div> --}}

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection

@push('script')
<script>
    (function (document) {
  "use strict";
  const ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  };
  ready(() => {
    const img = document.getElementById("image");
    const simpleModal = document.getElementById("simple-modal");
    simpleModal.addEventListener("show.bs.modal", (e) => {
		const bigImage = e.relatedTarget.getAttribute('data-bigimage')
		img.src = bigImage;
    });
  });
})(document);

     $(document).ready(function () {
    function openFancybox() {
        setTimeout(function () {
    //         const img = document.getElementById("image");
    // const simpleModal = document.getElementById("simple-modal");
    // simpleModal.addEventListener("show.bs.modal", (e) => {
	// 	const bigImage = e.relatedTarget.getAttribute('data-bigimage')
	// 	img.src = bigImage;
    // });
            $('.img-fluid').trigger('click');
            // var $src = $('#image').attr("data-bigimage");
            // console.log($src);
            //         $("#simple-modal").fadeIn();
            //         $("#image").attr("src", $src);
        }, 500);
    };
    var visited = '';
    if (visited == 'yes') {
         // second page load, cookie active
    } else {
        // openFancybox();
         // first page load, launch fancybox
    }
    // $.cookie('visited', 'yes', {
    //     expires: 365 // the number of days cookie  will be effective
    // });
    // $(".popup img").fancybox({modal:true, maxWidth: 400, overlay : {closeClick : true}});
});   
$("span, .overlay").click(function () {
                    $(".show").fadeOut();
                });
</script>
@endpush


