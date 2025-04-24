<div class="with-vertical  ">
    <!-- ---------------------------------- -->
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
            @include('layouts.partials.logo')
        </div>
        <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">

                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

                    <!-- ------------------------------- -->
                    <!-- start language Dropdown -->
                    <!-- ------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- end language Dropdown -->
                    <!-- ------------------------------- -->
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)"
                            style="display: flex;">
                            <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"
                                style="display: flex;"></iconify-icon>
                        </a>
                        <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)"
                            style="display: none;">
                            <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"
                                style="display: none;"></iconify-icon>
                        </a>
                    </li>
                    <!-- ------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- ------------------------------- -->
                    <!-- start notification Dropdown -->
                    <!-- ------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- end notification Dropdown -->
                    <!-- ------------------------------- -->
                    <!-- ------------------------------- -->
                    <!-- start profile Dropdown -->
                    <!-- ------------------------------- -->
                    <li class="nav-item dropdown">
                        @if (auth()->user())
                            @include('layouts.partials.profile-card')
                        @else
                            <a href="{{ ('login') }}" class="btn btn-warning rounded-1 w-100 ">S'authentifier</a>
                        @endif
                    </li>
                    <!-- ------------------------------- -->
                    <!-- end profile Dropdown -->
                    <!-- ------------------------------- -->
                </ul>
            </div>
        </div>
    </nav>


</div>
