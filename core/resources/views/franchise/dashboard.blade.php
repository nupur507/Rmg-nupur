@extends('franchise.layouts.app')

@section('panel')

<div class="row mb-none-30">
    <div class="col-xl-4 col-lg-4 col-sm-6">

        <div class="bg--white b-radius--10 box-shadow mb-30">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action py-2 d-flex align-items-center justify-content-between">
                    <div class="list-content">
                        <i class="las la-tachometer-alt f-size--24 align-middle"></i>
                        <span class="align-middle text--small">Franchise Name</span>
                    </div>
                    <div class="list-content">
                        <span class="badge badge-danger badge-pill">{{ $user->franchise_name }}</span>
                    </div>
                </li>
                <li class="list-group-item list-group-item-action py-2 d-flex align-items-center justify-content-between">
                    <div class="list-content">
                        <i class="las la-tachometer-alt f-size--24 align-middle"></i>
                        <span class="align-middle text--small">Franchise ID</span>
                    </div>
                    <div class="list-content">
                        <span class="badge badge-danger badge-pill">{{ $user->franchise_id }}</span>
                    </div>
                </li>
                <li class="list-group-item list-group-item-action py-2 d-flex align-items-center justify-content-between">
                    <div class="list-content">
                        <i class="las la-tachometer-alt f-size--24 align-middle"></i>
                        <span class="align-middle text--small">Activation Date</span>
                    </div>
                    <div class="list-content">
                        <span class="badge badge-light badge-pill">{{ $user->created_at ? date_format($user->created_at,"d/m/Y") : '' }}</span>
                    </div>
                </li>
                <li class="list-group-item list-group-item-action py-2 d-flex align-items-center justify-content-between">
                    <div class="list-content">
                        <i class="las la-tachometer-alt f-size--24 align-middle"></i>
                        <span class="align-middle text--small">Status</span>
                    </div>
                    <div class="list-content">
                        <span class="badge badge-danger badge-pill">{{ $user->franchise_type }}</span>
                    </div>
                </li>
            </ul>
        </div>

        {{-- F-Wallet Balance --}}
        <div class="dashboard-w1 bg--success b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="las la-wallet"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="currency-sign">{{$general->cur_sym}}</span>
                    <span class="amount">35000</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('F-Wallet Balance')</span>
                </div>
            </div>
        </div>

        {{-- user details ends --}}
    </div>
    <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
        {{-- Total Customer order --}}
        <div class="dashboard-w1 bg--purple b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="las la-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">25</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Customer Order')</span>
                </div>
            </div>
        </div>

        {{-- Total Customer sale --}}
        <div class="dashboard-w1 bg--2 b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="fa fa-money-bill-wave-alt"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="currency-sign">{{$general->cur_sym}}</span>
                    <span class="amount">5000</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Customer Sale')</span>
                </div>
            </div>
        </div>

          {{-- Pending Stock Request Order --}}
          <div class="dashboard-w1 bg--5 b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">1</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Pending Stock Request Order')</span>
                </div>
            </div>
        </div>

          {{-- Net Income --}}
        <div class="dashboard-w1 bg--3 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-hand-holding-usd"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="currency-sign">{{$general->cur_sym}}</span>
                    <span class="amount">50000</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Net Income')</span>
                </div>

            </div>
        </div>

    </div>

    {{-- Column Two Ends --}}

    <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
          {{-- Total Franchise Order --}}
        <div class="dashboard-w1 bg--info b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">15</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Franchise Order')</span>
                </div>
            </div>
        </div>

        {{-- Total Franchise sale --}}
        <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="fa fa-money-bill-wave-alt"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="currency-sign">{{$general->cur_sym}}</span>
                    <span class="amount">6000</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Franchise Sale')</span>
                </div>
            </div>
        </div>

        {{-- Current Stock Quantity --}}
         <div class="dashboard-w1 bg--17 b-radius--10 box-shadow mb-30">
            <div class="icon">
                <i class="las la-cart-arrow-down"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">50</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Current Stock Quantity')</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Notifications --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 min-h--200 mt-5">
            <div class="card-title p-3">Notifications</div>
            <div class="card-body p-0">

            </div>
        </div>
    </div>
</div>



@endsection
