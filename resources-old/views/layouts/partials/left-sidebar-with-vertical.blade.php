<aside class="left-sidebar with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="../horizontal/index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo-light.svg" class="dark-logo" alt="Logo-Dark">
            <img src="../assets/images/logos/logo-dark.svg" class="light-logo" alt="Logo-light" style="display: none;">
        </a>
        <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
            <i class="ti ti-x"></i>
        </a>
    </div>
    <div class="scroll-sidebar simplebar-scrollable-y" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px -16px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px 16px;">
                            <!-- Sidebar navigation-->
                            <nav class="sidebar-nav">
                                <ul id="sidebarnav" class="mb-0">
                                    @include('layouts.partials.sidebar-items')
                                </ul>
                            </nav>

                            <!-- End Sidebar navigation -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 270px; height: 3545px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 64px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
        </div>
    </div>
    <div class=" fixed-profile mx-3 mt-3">
        @if (auth()->user())
            <div class="card bg-primary-subtle mb-0 shadow-none">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('spike/assets/images/profile/user-1.jpg') }}" width="45"
                                height="45" class="img-fluid rounded-circle" alt="">
                            <div>
                                <h5 class="mb-1 text-truncate "> {{ Str::limit(Auth::user()->name ?? '-') }}</h5>
                                <p class="mb-0 text-truncate ">
                                    {{ Auth::user()->email ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <a class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Logout">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm ">
                                    <iconify-icon icon="solar:logout-line-duotone" class="fs-8"></iconify-icon>
                                </button>

                            </form>

                        </a>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning rounded-1 w-100 ">S'authentifier</a>
        @endif

    </div>
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
</aside>
