<header class="topbar sticky-top">
    <div class="with-vertical"><!-- ---------------------------------- -->
        <!-- Start Vertical Layout Header -->
        <!-- ---------------------------------- -->
        <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <iconify-icon icon="solar:list-bold-duotone" class="fs-7 text-dark"></iconify-icon>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="d-block d-lg-none">
                @if ($dark_Theme)
                    <img src="{{ asset('spike/armur-logo-text-white.png') }}" class="dark-logo" width="180"
                        alt="Logo-Dark" />
                @else
                    <img src="{{ asset('spike/armur-logo-text-black.png') }}" class="light-logo" width="180"
                        alt="Logo-light" />
                @endif
                {{-- <img src="{{ asset('spike/assets/images/logos/logo-light.svg') }}" class="dark-logo"
                    alt="Logo-Dark" />
                <img src="{{ asset('spike/assets/images/logos/logo-dark.svg') }}" class="light-logo"
                    alt="Logo-light" /> --}}
            </div>


            <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)"
                        class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                        aria-controls="offcanvasWithBothOptions">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <i class="ti ti-align-justified fs-7"></i>
                        </div>
                    </a>
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">


                        <li class="nav-item">
                            @if ($dark_Theme)
                                <a class="nav-link nav-icon-hover sun light-layout" href="{{ route('theme-toggle') }}">
                                    <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                                </a>
                            @else
                                <a class="nav-link nav-icon-hover moon dark-layout" href="{{ route('theme-toggle') }}">
                                    <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                                </a>
                            @endif


                        </li>

                        <!-- ------------------------------- -->
                        <!-- end notification Dropdown -->
                        <!-- ------------------------------- -->

                        <!-- ------------------------------- -->
                        <!-- start profile Dropdown -->
                        <!-- ------------------------------- -->
                        @if (is_null(auth()->user()))
                            <li class="nav-item ">

                                <div class="nav-link ">
                                    <a href="{{ route('login') }}" class="btn btn-warning rounded-1 py-2 px-3">Se
                                        Connecter</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                @include('layouts.partials.profile-card')
                            </li>
                        @endif
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- ---------------------------------- -->
        <!-- End Vertical Layout Header -->
        <!-- ---------------------------------- -->

        <!-- ------------------------------- -->
        <!-- apps Dropdown in Small screen -->
        <!-- ------------------------------- -->
        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start dropdown-menu-nav-offcanvas" data-bs-scroll="true" tabindex="-1"
            id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                    <img src="{{ asset('spike/assets/images/logos/favicon.png') }}" alt="" class="img-fluid" />
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body h-n80" data-simplebar>
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-2 has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:list-bold-duotone" class="fs-7 text-dark"></iconify-icon>
                                <span class="hide-menu">Apps</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level my-3">
                                <li class="sidebar-item py-2">
                                    <a href="#" class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('spike/assets/images/svgs/icon-dd-chat.svg') }}"
                                                alt="" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Chat Application
                                            </h6>
                                            <span class="fs-2 d-block fw-normal text-muted">New
                                                messages arrived</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="sidebar-item py-2">
                                    <a href="#" class="d-flex align-items-center">
                                        <div
                                            class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('spike/assets/images/svgs/icon-dd-invoice.svg') }}"
                                                alt="" class="img-fluid" width="24" height="24" />
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                                            <span class="fs-2 d-block fw-normal text-muted">Get
                                                latest invoice</span>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="app-header with-horizontal">
        <nav class="navbar navbar-expand-xl container-fluid p-0">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-xl-block">
                    <a href="/" class="text-nowrap nav-link">
                        {{-- <div class="dark-logo">

                        </div> --}}
                        {{-- <img src="{{ asset('fruitables/armur-logo.png') }}" class="dark-logo" width="180"
                            alt="" /> --}}
                        {{-- <h5 class="fw-semibold text-dark">Orné's taste</h5> --}}
                        @if ($dark_Theme)
                            <img src="{{ asset('spike/armur-logo-text-white.png') }}" class="dark-logo"
                                width="180" alt="" />
                        @else
                            <img src="{{ asset('spike/armur-logo-text-black.png') }}" class="light-logo"
                                width="180" alt="" />
                        @endif


                    </a>
                </li>
            </ul>
            <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="javascript:void(0)"
                        class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                        aria-controls="offcanvasWithBothOptions">
                        <div class="nav-icon-hover-bg rounded-circle ">
                            <i class="ti ti-align-justified fs-7"></i>
                        </div>
                    </a>
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">


                        <li class="nav-item">
                            @if (!$dark_Theme)
                                <a class="nav-link nav-icon-hover moon dark-layout"
                                    href="{{ route('theme-toggle') }}">
                                    <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"></iconify-icon>
                                </a>
                            @else
                                <a class="nav-link nav-icon-hover sun light-layout"
                                    href="{{ route('theme-toggle') }}">
                                    <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"></iconify-icon>
                                </a>
                            @endif


                        </li>


                        @if (is_null(auth()->user()))
                            <li class="nav-item ">

                                <div class="nav-link ">
                                    <a href="{{ route('login') }}" class="btn btn-warning rounded-1 py-2 px-3">Se
                                        Connecter</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                @include('layouts.partials.profile-card')
                            </li>
                        @endif
                        <!-- ------------------------------- -->
                        <!-- end profile Dropdown -->
                        <!-- ------------------------------- -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
