<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Best Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{ $companyState->fevicon }}">

    <!-- Title -->
    <title>Login / Register - Milkmilch</title>

    <!-- *************
   ************ Common Css Files *************
  ************ -->

    <!-- Animated css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/bootstrap/bootstrap-icons.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <style>
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

<body class="login-container">

    <!-- Loading wrapper start -->
    <!-- <div id="loading-wrapper">
   <div class="spinner">
                <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
    <div class="line4"></div>
    <div class="line5"></div>
    <div class="line6"></div>
            </div>
  </div> -->
    <!-- Loading wrapper end -->

    {{ $slot }}

    <!-- *************
   ************ Required JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/modernizr.js"></script>
    <script src="assets/js/moment.js"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Main Js Required -->
    <script src="assets/js/main.js"></script>

</body>

</html>
