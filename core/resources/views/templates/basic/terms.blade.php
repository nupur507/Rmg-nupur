@extends($activeTemplate.'layouts.master')

@section('content')
<section class="pt-120 pb-120">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-12 card py-3 px-4">
                <div class="card-body">
                    <p>@php echo $terms->data_values->description; @endphp</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection






