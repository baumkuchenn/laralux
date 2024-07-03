<!DOCTYPE html>
<!--
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    @yield('title-halaman')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <!-- <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <script src="https://kit.fontawesome.com/2ca9da1951.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  --}}
    <link href="{{ asset('assets/css/style-conquer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/tasks.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr Notifications -->
    @if(session('status'))
    <script>
        toastr.success("{{ session('status') }}");
    </script>
    @endif

    <style>
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            margin: 0 0 10px;
        }

        .card-text {
            font-size: 14px;
            color: #555;
            margin: 0 0 10px;
        }

        .btn-group {
            display: flex;
        }

        .btn {
            background: #007bff;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.2s;
            margin-right: 10px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .stars {
            color: #FFD700;
            margin-bottom: 10px;
        }

        .dropdown.user .dropdown-toggle span {
            margin-left: 5px;
            font-weight: bold;
            color: #ddd;
        }
        
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{ url('hotel') }}">
                    <img src="{{ asset('assets/img/logo1.png') }}" alt="logo" height="45px" />
                </a>
            </div>
            <!-- <form class="search-form search-form-header" role="form" action="index.html">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" class="form-control input-sm" name="query" placeholder="Search...">
                </div>
            </form> -->
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <img src="{{ asset('assets/img/menu-toggler.png') }}" alt="" />
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                @if (auth()->check() && (auth()->user()->role == 'customer'))

                <li class="devider">
                    &nbsp;
                </li>
                <li class="dropdown user" data-toggle="tooltip" title="Cart">
                    <a href="{{ route('cart') }}" class="dropdown-toggle">
                        <span>Cart</span>
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-primary">{{ session()->get('cartItemCount', 0) }}</span>

                    </a>
                </li>
                <li class="devider">
                    &nbsp;
                </li>

                <li class="dropdown user" data-toggle="tooltip" title="Riwayat Transaksi">
                    <a href="{{ url('receipt') }}" class="dropdown-toggle">
                        <span>Riwayat Transaksi</span>
                        <i class="fa fa-dollar"></i>

                    </a>
                </li>
                <li class="devider">
                    &nbsp;
                </li>

                <li class="dropdown user" data-toggle="tooltip" title="Membership">
                    <a href="{{ url('membership') }}" class="dropdown-toggle">
                        <span>Membership</span>
                        <i class="fa fa-list-alt"></i>

                    </a>
                </li>

                @endif
                <!-- END TODO DROPDOWN -->
                <li class="devider">
                    &nbsp;
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" src="{{ asset('assets/img/guest.jpg') }}" />
                        <span class="username username-hide-on-mobile">
                            @if (Auth::check())
                            Hai! {{ Auth::user()->name }} ({{ Auth::user()->role }})
                            @else
                            Guest
                            @endif
                        </span>
                        @if (Auth::check())
                        <i class="fa fa-angle-down"></i>
                        @endif
                    </a>
                    @if (Auth::check())
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-user"></i> My Profile</a>
                        </li>

                        <li class="divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <i class="fa fa-key"></i>
                                <input type="submit" value="logout" class='btn btn-danger' />
                            </form>
                        </li>
                    </ul>
                    @endif
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN BUTTON LOGIN DROPDOWN -->
                @if(!Auth::check())
                <li class="dropdown">
                    <a href="{{ route('login') }}" class="dropdown-toggle btn-primary">Login</a>
                    <ul class="dropdown-menu"></ul>
                </li>
                @endif
                <!-- END BUTTON LOGIN DROPDOWN -->
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff'))
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
                <ul class="page-sidebar-menu">
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler">
                        </div>
                        <div class="clearfix">
                        </div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <li class="sidebar-search-wrapper">
                        <form class="search-form" role="form" action="index.html" method="get">
                            <div class="input-icon right">
                                <i class="icon-magnifier"></i>
                                <input type="text" class="form-control" name="query" placeholder="Search...">
                            </div>
                        </form>
                    </li>
                    <li class="start active ">
                        <a href="{{ url('hotel') }}">
                            <i class="fa fa-home"></i>
                            <span class="title">Daftar Hotel</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('hoteltype') }}">
                            <i class="fa-solid fa-hotel"></i>
                            <span class="title">Daftar Tipe Hotel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('producttype') }}">
                            <i class="fa fa-bed"></i>
                            <span class="title">Daftar Tipe Kamar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('fasilitas') }}">
                            <i class="fa fa-utensils"></i>
                            <span class="title">Daftar Fasilitas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('transaction') }}">
                            <i class="fa fa-money"></i>
                            <span class="title">Daftar Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('customer') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">Daftar Membership</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-paperclip"></i>
                            <span class="title">Daftar Laporan</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('mostReservedProduct') }}">Most reserved hotel product</a></li>
                            <li><a href="{{ route('richestCustomer') }}">Top buyer by customer</a></li>
                            <li><a href="{{ route('richestPoinCustomer') }}">Top poin member</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        @endif
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content @if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'staff')) logged-in @endif">
                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title">
                    @yield('judul-halaman')
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <!-- Buat navigasi nanti bisa ditambahkan pakai yield-->
                        @yield('navigasi')
                        <!-- <li>
                            <i class="fa fa-angle-right"></i>
                            <a href="#">Dashboard</a>
                        </li> -->
                    </ul>
                </div>
                <!-- END PAGE HEADER-->
                @yield('isi')
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2013 &copy; Conquer by keenthemes.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('assets/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/jquery.peity.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-knob/js/jquery.knob.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/scripts/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/index.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/tasks.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            App.init(); // initlayout and core plugins
            Index.init();
            Index.initJQVMAP(); // init index page's custom scripts
            Index.initCalendar(); // init index page's custom scripts
            Index.initCharts(); // init index page's custom scripts
            Index.initChat();
            Index.initMiniCharts();
            Index.initPeityElements();
            Index.initKnowElements();
            Index.initDashboardDaterange();
            Tasks.initDashboardWidget();
        });
    </script>
    @yield('javascript')
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>