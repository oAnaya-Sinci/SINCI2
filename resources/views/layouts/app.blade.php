
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <!-- <link rel="icon" type="image/png" href="/img/favicon.png"> -->
    <link rel="icon" type="image/png" href="/img/sinci.ico" sizes="32x32">
    <title>{{ config('app.name', 'SAS SINCI') }}</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    <link href='../css/datepicker.min.css' rel='stylesheet' media='print' />
    <link href="/css/bootstrap-select.css" rel="stylesheet" />
    <link href="/css/sinciStyles.css" rel="stylesheet" />

    @yield('cssSection')

</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        @include('layouts.navbar')

        @yield('pageContent')

        <input type="hidden" class="form-control" id="userData" value="">
        
    </main>

    @include('layouts.modals')

    <!--   Core JS Files   -->
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/js/plugins/chartjs.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
            damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
  
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/material-dashboard.min.js?v=3.0.0"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script> -->
    <script src='../js/calendar/jquery-ui.custom.min.js' type="text/javascript"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> -->
    
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

    <script src='../js/datepicker.min.js' type="text/javascript"></script>
    <script src='../js/bootstrap-select.js' type="text/javascript"></script>

    <!-- <script src='../js/login.js' type="text/javascript"></script> -->
    <script src='../js/main.js' type="text/javascript"></script>

    @yield('jsSection')

</body>

</html>