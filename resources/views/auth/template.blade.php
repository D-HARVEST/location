<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/svg" href="{{ asset('logo-dh.svg') }}" />
    <!-- Core Css -->

    <link rel="stylesheet" href="{{ asset('matdash/styles.css') }}">

    <title> {{ env('APP_NAME') }} </title>
</head>

<body>
    <!-- Preloader -->
    {{-- <div class="preloader">
        <img src="{{ asset('logo-dh.svg') }}" alt="loader" class="lds-ripple img-fluid" />
    </div> --}}
    <div id="main-wrapper">
        <div
            class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100 my-3">
                <div class="row justify-content-center w-100 my-5 my-xl-0">
                    <div class="col-md-9 d-flex flex-column justify-content-center">
                        <div class="card mb-0 bg-body auth-login m-auto w-100">
                            <div class="row gx-0">
                                <!-- ------------------------------------------------- -->
                                <!-- Part 1 -->
                                <!-- ------------------------------------------------- -->
                                <div class="col-lg-6 border-end">
                                    <div class="row justify-content-center py-4">
                                        <div class="col-lg-11">
                                            <div class="card-body">

                                                @yield('content')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- ------------------------------------------------- -->
                                <!-- Part 2 -->
                                <!-- ------------------------------------------------- -->
                                <div class="col-lg-6 d-none d-lg-block">
                                    <div class="row justify-content-center align-items-start h-100">
                                        <div class="col-lg-9">
                                            @yield('illustrations')

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="{{ asset('matdash/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('matdash/simplebar.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('matdash/app.init.js') }}"></script> --}}
    {{-- <script src="{{ asset('matdash/theme.js') }}"></script> --}}
    {{-- <script src="{{ asset('matdash/app.min.js') }}"></script> --}}
    <style>
        .auth-bg {
            background: #d6e1ea;
        }
    </style>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @include('auth.show-hide-password')

</body>

</html>
