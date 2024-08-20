<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/admin/images/sidebar/2.jpg','400x800')}}">


    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('franchise.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('franchise.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('franchise.dashboard')}}">
                    <a href="{{route('franchise.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('franchise*',2)}}">
                        <i class="menu-icon las la-clipboard"></i>
                        <span class="menu-title">@lang('Request Stock')</span>
                    </a>

                    <div class="sidebar-submenu {{menuActive('franchise*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item">
                                <a href="{{route('franchise.request.stock.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Request')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a href="{{route('franchise.request.stock.orderHistory')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Order History')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item {{ menuActive('franchise.deposits') }}">
                    <a href="{{ route('franchise.deposits') }}" class="nav-link">
                        <i class=" menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Deposit Now')</span>
                    </a>
                </li>
            </ul>


            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{systemDetails()['name']}}</span>
                <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->
