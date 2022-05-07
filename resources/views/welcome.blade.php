<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/template/vendors/feather/feather.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/template/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/template/vendors/ti-icons/css/themify-icons.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/template/vendors/typicons/typicons.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/template/vendors/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/template/vendors/css/vendor.bundle.base.css')}}">

    <link rel="stylesheet" id="theme" href="{{ asset('assets/template/css/vertical-layout-light/style.css')}}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper full-page-wrapper" >
                  <div class="content-wrapper d-flex align-items-center auth px-0">
                      <img src="assets/img/cover.png" style=" position: absolute;
                      left: 0;
                      top: 0;
                      width: 100%;
                      height: 100%;
                      opacity: 0.5;" alt="">
                    <div class="row w-100 mx-0">
                      <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center py-5 px-4  card" style="opacity: 1; z-index: 9999">
                          <div>
                            <img src="assets/img/welcome.png" width="100px" height="100%" alt="logo">
                            &nbsp;|&nbsp;
                            <img src="assets/img/logo.png" width="30%" height="30%" alt="logo">
                          </div>
                          &nbsp;
                          <h6 class="light">CONNECTEZ-VOUS EN TANT QUE</h6>
                          &nbsp;
                          <div>
                            <a href="/home" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Fournisseur</a>
                            &nbsp;
                            ou
                            &nbsp;

                            <a href="/admin" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Administrateur</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- content-wrapper ends -->
                </div>
                <!-- page-body-wrapper ends -->
              </div>
    </body>
</html>
