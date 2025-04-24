<!DOCTYPE html>
@php
    // dd(request()->session()->get('theme', null));
    // dd(request()->cookie('theme'));
    $dark_Theme = request()->session()->get('theme', null);

@endphp
{{-- {{ request()->session()->get('theme', null) ? 'dark' : 'light' }} --}}
<html lang="fr" dir="ltr" data-bs-theme="{{ $dark_Theme ? 'dark' : 'light' }}" data-color-theme="Blue_Theme"
    data-layout="horizontal">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" type="image/png" href="{{ asset('spike/assets/images/logos/favicon.png') }}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('spike/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/select2/dist/css/select2.min.css') }}">
    <title>{{ env('APP_NAME') }} </title>
    @yield('style')
    @yield('style1')
    @yield('style2')
    @yield('style3')
    @yield('style4')
    @yield('style5')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('spike/assets/images/logos/loader.svg') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div id="main-wrapper">
        <!-- Sidebar Start -->

        {{-- @include('layouts.partials.mobile-left-sidebar') --}}
        @include('layouts.partials.left-sidebar-with-vertical')


        {{-- @include('layouts.partials.m2') --}}

        <!--  Sidebar End -->
        <div class="page-wrapper">

            @include('layouts.partials.right-sidebar')
            {{-- @include('layouts.partials.left-sidebar-with-horizontal') --}}

            <div class="body-wrapper">
                <div class="container-fluid">
                    @include('layouts.partials.alert')
                    @yield('modal')
                    @yield('modal1')
                    @yield('modal2')
                    @yield('modal3')
                    <!--  Header Start -->
                    {{-- @include('layouts.partials.topbar-navbar') --}}
                    @include('layouts.partials.headder-topbar')


                    <!--  Header End -->
                    @include('layouts.partials.banner')
                    @yield('content')
                </div>
                @yield('content-fluid')
            </div>
            @include('layouts.partials.footer')

            {{-- <script>
                function handleColorTheme(e) {
                    $("html").attr("data-color-theme", e);
                    $(e).prop("checked", !0);
                }
            </script> --}}
            @include('layouts.partials.template-settings')
        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>
    <!-- Import Js Files -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{ asset('spike/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/app.horizontal.init.js') }}"></script>
    {{-- haut est remplacé par bas  --}}
    <script>
        var userSettings = {
            Layout: "horizontal", // vertical | horizontal
            SidebarType: "full", // full | mini-sidebar
            BoxedLayout: true, // true | false
            Direction: "ltr", // ltr | rtl
            Theme: @if ($dark_Theme)
                "dark"
            @else
                "light"
            @endif , // light | dark
            ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
            cardBorder: false, // true | false
        };
    </script>
    <script src="{{ asset('spike/assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/app.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/sidebarmenu.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/feather.min.js') }}"></script>

    <!-- solar icons -->
    <script src="{{ asset('spike/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/forms/select2.init.js') }}"></script>



    {{-- moi même --}}

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    {{-- @include('datable_responsive') --}}
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>

    <script src="{{ asset('dist/libs/dropzone/dist/min/dropzone.min.js') }}"></script>

    {{-- <link rel="stylesheet" href=""> --}}

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,

                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
            });
        });
        $(".datatable").each(function() {
            $(this).DataTable({
                responsive: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.editor').each(function() {
                CKEDITOR.replace($(this).attr('id'));
            });
        });
    </script>
    {{-- <script src="//code.tidio.co/z1ovskion66qma3j4mgf8nrxkdhbuav0.js" async></script> --}}
    @include('auth.show-hide-password')
    <script src="https://cdn.kkiapay.me/k.js"></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.2"></script>

    @yield('script')
    @yield('script2')
    @yield('script3')
    @include('script')


</body>


</html>
