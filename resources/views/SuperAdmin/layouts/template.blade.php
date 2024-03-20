@php
    use App\Models\Service;
    use App\Models\Reservation;
    $services = Service::where('rendu', 0)->get();
    $reservations = Reservation::where('confirme', 0)->get();
@endphp

@include('SuperAdmin.layouts.partials.header')

<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <p style="font-weight: bold;color:white;">Système Hôteliers</p>
            </div>
            @include('SuperAdmin.layouts.partials.sidebar')
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    @include('SuperAdmin.layouts.partials.navbar')
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            @canAny(['Gérer les Réservations', 'Gérer les Demandes de Services'])
                                <li class="dropdown">
                                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                        <span>
                                            @can('Gérer les Réservations')
                                                {{ $reservations->count() }}
                                            @endcan
                                            @can('Gérer les Demandes de Services')
                                                {{ $services->count() }}
                                            @endcan
                                        </span>
                                    </i>
                                    @include('SuperAdmin.layouts.partials.notifications')
                                </li>
                            @endcanAny
                            {{-- <li class="dropdown">
                                <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                                @include('SuperAdmin.layouts.partials.messages')
                            </li> --}}
                            {{-- <li class="settings-btn">
                                <i class="ti-settings"></i>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left" style="font-weight: bold">@yield('content-title')</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="{{ asset('assets/images/author/avatar.png') }}" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Str::ucfirst(auth()->user()->prenoms) }}{{--  {{ auth()->user()->nom }} --}}<i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                {{-- <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a> --}}
                                <a class="dropdown-item" href="{{ route('personnal-profile.show', ['user' => auth()->user()->id]) }}" style="font-weight: bold;"><i class="fa-solid fa-user" style="margin-right: 7px;"></i>Profile</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="dropdown-item" style="font-weight: bold;"><i class="fa-solid fa-right-from-bracket" style="margin-right: 7px;"></i>Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                @yield('content')
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    @include('SuperAdmin.layouts.partials.settings')

@include('SuperAdmin.layouts.partials.footer')
