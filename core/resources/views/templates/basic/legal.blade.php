@extends($activeTemplate.'layouts.master')

@section('content')

<section class="legal-section pt-60 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <img src="{{asset('assets/images/frontend/legal/1.jpg')}}" alt="legal-image" class="img-fluid img-responsive ">
            </div>
            <div class="col-md-6">
                <img src="{{asset('assets/images/frontend/legal/2.jpg')}}" alt="legal-image" class="img-fluid img-responsive ">
            </div>
            <div class="col-md-6">
                <img src="{{asset('assets/images/frontend/legal/3.jpg')}}" alt="legal-image" class="img-fluid img-responsive ">
            </div>
            <div class="col-md-6">
                <img src="{{asset('assets/images/frontend/legal/4.jpg')}}" alt="legal-image" class="img-fluid img-responsive ">
            </div>
        </div>
    </div>
</section>

@endsection
