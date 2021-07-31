<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if (Auth::check())
          <meta name="user-id" content="{{ Auth::user()->id }}">
          <meta name="user-full_name" content="{{ Auth::user()->full_name }}">
          <meta name="user-first_name" content="{{ Auth::user()->first_name }}">
          <meta name="user-last_name" content="{{ Auth::user()->last_name }}">
          <meta name="user-job_title" content="{{ Auth::user()->job_title }}">
          <meta name="user-email" content="{{ Auth::user()->email }}">
          <meta name="user-phone" content="{{ Auth::user()->phone }}">
          <meta name="user-image" content="{{ Auth::user()->image }}">

          <meta name="provider-id" content="{{ Auth::user()->id }}">

    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/things.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>



    <script defer src="{{ mix('js/app.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script defer src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script defer src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>


        <!-- Page level custom scripts -->
        <script defer src="{{ asset('assets/js/demo/chart-area-demo.js')}}"></script>
        <script defer src="{{ asset('assets/js/demo/chart-pie-demo.js')}}"></script>
        <script defer src="{{ asset('assets/js/demo/datatables-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script>
            $(function(){
                $('#datetimepicker').datetimepicker()
            })

        </script>
        <script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>

