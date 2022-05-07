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

        {{-- Provider --}}
        <meta name="provider-isFirstTime" content="{{ Auth::user()->isFirstTime }}">
        <meta name="provider-id" content="{{ Auth::user()->id }}">
        <meta name="provider-full_name" content="{{ Auth::user()->full_name }}">
        <meta name="provider-first_name" content="{{ Auth::user()->first_name }}">
        <meta name="provider-last_name" content="{{ Auth::user()->last_name }}">
        <meta name="provider-email" content="{{ Auth::user()->email }}">
        <meta name="provider-type" content="{{ Auth::user()->type }}">
        <meta name="provider-phone" content="{{ Auth::user()->phone }}">
        <meta name="provider-social_security_number" content="{{ Auth::user()->social_security_number }}">
        <meta name="provider-image" content="{{ Auth::user()->image }}">
        <meta name="provider-projectsCount" content="{{ Auth::user()->project_count }}">

    @endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EVAPRO | NEWTEAM CONSULTING</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/template/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/css-stars.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/js/select.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/fullcalendar/fullcalendar.min.css')}}">
    <!-- End plugin css for this page -->

      <!-- Plugin css for Form -->
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/dropzone/dropzone.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-1to10.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-horizontal.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-movie.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-pill.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-reversed.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bars-square.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/bootstrap-stars.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/css-stars.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/examples.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/fontawesome-stars-o.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-bar-rating/fontawesome-stars.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-asColorPicker/css/asColorPicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/x-editable/bootstrap-editable.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/dropify/dropify.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-file-upload/uploadfile.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/template/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
  <!-- End plugin css for Forms -->

    <!-- inject:css -->
    <link rel="stylesheet" id="theme" href="{{ asset('assets/template/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/img/evapro_favicon.png')}}" />
</head>
<body>

    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>


    <script src="{{ asset('assets/template/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/template/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/progressbar.js/progressbar.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/template/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/template/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/template/js/template.js')}}"></script>
    <script src="{{ asset('assets/template/js/settings.js')}}"></script>
    <script src="{{ asset('assets/template/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/template/js/dashboard.js')}}"></script>
    <script src="{{ asset('assets/template/js/Chart.roundedBarCharts.js')}}"></script>

    {{-- js for forms --}}
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/template/js/file-upload.js')}}"></script>
    <script src="{{ asset('assets/template/js/typeahead.js')}}"></script>
    <script src="{{ asset('assets/template/js/select2.js')}}"></script>
    {{-- end js for forms --}}

    {{-- js for alerts --}}
    <script src="{{ asset('assets/template/vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/jquery.avgrund/jquery.avgrund.min.js')}}"></script>
    <script src="{{ asset('assets/template/js/alerts.js')}}"></script>
    <script src="{{ asset('assets/template/js/avgrund.js')}}"></script>
    {{-- end js for alerts --}}

    {{-- js for tables --}}
    <script src="{{ asset('assets/template/js/data-table.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    {{-- end js for tables --}}

    {{-- js for profil --}}
    <script src="{{ asset('assets/template/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{ asset('assets/template/js/profile-demo.js')}}"></script>
    {{-- end js for profil --}}

    {{-- js for fullcalendar --}}
    <script src="{{ asset('assets/template/vendors/moment/moment.min.js')}}"></script>
    <script src="{{ asset('assets/template/vendors/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('assets/template/js/calendar.js')}}"></script>
    {{-- end js for fullcalendar --}}

      <!-- plugin js for forms -->
  <script src="{{ asset('assets/template/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery-asColor/jquery-asColor.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery-asGradient/jquery-asGradient.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/x-editable/bootstrap-editable.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/moment/moment.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/dropify/dropify.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery-file-upload/jquery.uploadfile.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/dropzone/dropzone.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/jquery.repeater/jquery.repeater.min.js')}}"></script>
  <script src="{{ asset('assets/template/vendors/inputmask/jquery.inputmask.bundle.js')}}"></script>
  <!-- End plugin js for forms -->

    <!-- Custom js for this page-->
    <script src="{{ asset('assets/template/js/formpickers.js')}}"></script>
    <script src="{{ asset('assets/template/js/form-addons.js')}}"></script>
    <script src="{{ asset('assets/template/js/x-editable.js')}}"></script>
    <script src="{{ asset('assets/template/js/dropify.js')}}"></script>
    <script src="{{ asset('assets/template/js/dropzone.js')}}"></script>
    <script src="{{ asset('assets/template/js/jquery-file-upload.js')}}"></script>
    <script src="{{ asset('assets/template/js/formpickers.js')}}"></script>
    <script src="{{ asset('assets/template/js/form-repeater.js')}}"></script>
    <script src="{{ asset('assets/template/js/inputmask.js')}}"></script>
    <!-- End custom js for this page-->
</body>
</html>


