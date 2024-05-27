<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Best Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery" />
    {{-- <link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery"> --}}
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{ $companyState->fevicon }}">

    <!-- Title -->
    <title>MilkMilch - @yield('title', 'admin')</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->

    <!-- Animated css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/bootstrap/bootstrap-icons.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">


    <!-- *************
   ************ Vendor Css Files *************
  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}">
    <style>
        .sidebarMenuScroll ul>li>a {
            /* color: #fff !important; */
            font-weight: bold !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            border: 1px solid rgb(0, 0, 0);
            -webkit-text-fill-color: rgb(7, 7, 7);
            -webkit-box-shadow: 0 0 0px 1000px #f7eeee inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>

    @stack('head')

</head>

<body>

    <!-- Loading wrapper start -->
    <div id="loading-wrapper">
        <div class="spinner">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
            <div class="line5"></div>
            <div class="line6"></div>
        </div>
    </div>
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
        <nav class="sidebar-wrapper">

            <!-- Sidebar brand starts -->
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="Admin Dashboards" /> --}}
                    <img src="{{ $companyState->logo }}" alt="Admin Dashboards" />
                </a>
            </div>
            <!-- Sidebar brand starts -->

            <!-- Sidebar menu starts -->
            @include('layouts._app.sidebar')
            <!-- Sidebar menu ends -->

        </nav>
        <!-- Sidebar wrapper end -->

        <!-- *************
    ************ Main container start *************
   ************* -->
        <div class="main-container">

            <!-- Page header starts -->
            @include('layouts._app.header')
            <!-- Page header ends -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">

                <!-- Content wrapper start -->
                <div class="content-wrapper">

                    @if (Session::has('toaster_danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('toaster_danger') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('toaster_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('toaster_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif




                    {{ $slot }}

                </div>
                <!-- Content wrapper end -->

                <!-- App Footer start -->
                <div class="app-footer">
                    <span>© Cortex It Solution admin 2024</span>
                </div>
                <!-- App footer end -->

            </div>
            <!-- Content wrapper scroll end -->

        </div>
        <!-- *************
    ************ Main container end *************
   ************* -->

    </div>
    <!-- Page wrapper end -->

    {{-- logout form::begin --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- logout form::end --}}

    <!-- *************
   ************ Required JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.j') }}s"></script>

    <!-- Toastr JS -->
    <script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>

    {{-- custome script::begin --}}
    @stack('scripts')
    {{-- custome script::end --}}


    <!-- Main Js Required -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
