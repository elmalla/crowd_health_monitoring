<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- <html class="no-js " lang="en"> --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pandemic Tracker') }}</title>
    <!-- Favicon-->

    <link rel="icon" href="{{ asset('img/logoPT.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />

    {{-- charts --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/morrisjs/morris.min.css') }}" />

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Theme Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- @if (app()->getLocale() == 'ar')
        --}}
        @if (Session::get('locale') == 'ar')
            <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
            <style>
                html,
                body,
                div,
                span,
                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                p {
                    font-family: 'Tajawal', "Comfortaa" !important;
                }

            </style>
        @endif

</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('img/logoPT.png') }}" width="48" height="48"
                    alt="Pandemic Tracker logo"></div>
            <p>{{ __('lang.please-wait') }}</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>



    <!-- Right Icon menu Sidebar -->
    <div class="navbar-right">
        <ul class="navbar-nav">

            {{-- <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown"
                    role="button"><i class="zmdi zmdi-notifications"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu slideUp2">
                    <li class="header">Notifications</li>
                    <li class="body">
                        <ul class="menu list-unstyled">
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                    <div class="menu-info">
                                        <h4>1 New Members joined</h4>
                                        <p><i class="zmdi zmdi-time"></i> 14 mins ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                    <div class="menu-info">
                                        <h4>8 New Members joined</h4>
                                        <p><i class="zmdi zmdi-time"></i> 30 mins ago </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
                </ul>
            </li> --}}

            <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i
                        class="zmdi zmdi-settings"></i></a></li>
            <!-- Authentication Links -->
            @guest
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('lang.register') }}</a>
                    </li>
                @endif
            @else
                <li><a href="{{ route('logout') }}" class="mega-menu" title="Sign Out" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </div>

    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
            <a href="{{ route('home') }}"><img src="{{ asset('img/logoPT.png') }}" width="25"
                    alt="PandemicTracker"><span class="m-l-10">{{ __('lang.pandemic-tracker') }}</span></a>
        </div>
        <div class="menu">
            <ul class="list">
                <li class="active open"><a href="{{ route('home') }}"><i
                            class="zmdi ti-home"></i><span>{{ __('lang.dashboard') }}</span></a></li>

                <li><a href="{{ route('profile') }}"><i
                            class="zmdi ti-user"></i><span>{{ __('lang.profile') }}</span></a></li>

                @if (Auth::user()->isPTAdmin())
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi ti-menu-alt"></i><span>Clients</span></a>
                        <ul class="ml-menu">
                            <li><a href="{{ route('view.client_types') }}">Client Type</a></li>
                            <li><a href="{{ route('view.clients') }}">Clients List</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->isClientSupervisor())
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi ti-menu-alt"></i><span>{{ __('lang.employees') }}</span></a>
                        <ul class="ml-menu">
                            <li><a href="{{ route('view.employees') }}">{{ __('lang.employees-list') }}</a>
                            </li>
                            <li><a href="{{ route('view.client_supervisor') }}">{{ __('lang.supervisor-list') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->isPTAdmin() or Auth::user()->isClientSupervisor())
                    {{-- <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi ti-signal"></i><span>Bracelet</span></a>
                        <ul class="ml-menu"> --}}
                            @if (Auth::user()->isPTAdmin())
                                {{-- <li><a
                                        href="{{ route('view.bracelettype') }}">Bracelet type</a></li>
                                --}}
                            @endif
                            @if (Auth::user()->isClientSupervisor())
                                {{-- <li><a
                                        href="{{ route('view.bracelet_tracker') }}">Bracelet Tracker</a></li>
                                --}}
                            @endif
                            {{--
                        </ul>
                    </li> --}}
                @endif

                @if (Auth::user()->isPTAdmin())
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings"></i><span>Setting</span></a>
                        <ul class="ml-menu">
                            <li><a href="{{ route('view.setting') }}">Set Temperature of Country</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </aside>

    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs sm">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i
                        class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="setting">
                <div class="slim_scroll">
                    <div class="card">
                        <h6>Theme Option</h6>
                        <div class="light_dark">
                            <div class="radio">
                                <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                                <label for="lighttheme">Light Mode</label>
                            </div>
                            <div class="radio mb-0">
                                <input type="radio" name="radio1" id="darktheme" value="dark">
                                <label for="darktheme">Dark Mode</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h6>Color Skins</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="blue">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li data-theme="green" class="active">
                                <div class="green"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="checkbox rtl_support">
                                    <input id="checkbox1" type="checkbox" value="rtl_view">
                                    <label for="checkbox1">RTL Version</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox ms_bar">
                                    <input id="checkbox2" type="checkbox" value="mini_active">
                                    <label for="checkbox2">Mini Sidebar</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{ __('lang.dashboard') }}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i>
                                {{ __('lang.pandemic-tracker') }}</a></li>
                        <li class="breadcrumb-item active"> @yield('pagename-navbar')</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>

                    <a class="btn-icon float-right right_icon_toggle_btn" style="margin-top: 12px; margin-right: 3px; margin-left: 3px;"
                        href="{{ route('setlocale', 'en') }}"> <img src="{{ asset('img/us-flag.png') }}" width="30px" />
                    </a>

                    <a class="btn-icon float-right right_icon_toggle_btn" style="margin-top: 12px; margin-right: 3px; margin-left: 3px;"
                        href="{{ route('setlocale', 'ar') }}"> <img src="{{ asset('img/ksa-flag.png') }}"
                            width="30px" /> </a>


                </div>
            </div>
        </div>

        <div class="container-fluid">
            @yield('content')
        </div>
    </section>


    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
    <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>

    <!--   chartjs  -->
    <script src="{{ asset('assets/plugins/chartjs/Chart.bundle.js') }}"></script> <!-- Chart Plugins Js -->
    {{-- <script src="{{ asset('assets/bundles/morrisscripts.bundle.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/js/pages/charts/morris.js') }}"></script> --}}

    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/momentjs/moment.js') }}"></script> <!-- Moment Plugin Js -->
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script
        src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    <script src="{{ asset('assets/js/pages/forms/basic-form-elements.js') }}"></script>

    @yield('js')
    @if (Session::get('locale') == 'ar')
        <script>
            $(window).on("load", function() {
                $("body").addClass('rtl');
            });

        </script>
    @endif
    <script>
        $(".rtl_support input").on('change', function() {
            var checkbox = $(this).val();
            if ($(this).is(":checked")) {
                $("body").addClass('rtl');
                window.location = "setlocale/ar";
            } else {
                $("body").removeClass('rtl');
                window.location = "setlocale/en";
            }
        });

    </script>

</body>

</html>
