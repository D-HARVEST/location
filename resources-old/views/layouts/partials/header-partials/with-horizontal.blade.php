<div class="app-header with-horizontal  ">
    <nav class="navbar navbar-expand-xl container-fluid p-0">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-xl-block">
                <a href="index.html" class="text-nowrap nav-link">
                    @include('layouts.partials.logo')
                </a>
            </li>
        </ul>
        <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">

                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover moon dark-layout" href="{{ ('theme-toggle') }}"
                            style="display: flex;">
                            <iconify-icon icon="solar:moon-line-duotone" class="moon fs-7"
                                style="display: flex;"></iconify-icon>
                        </a>
                        <a class="nav-link nav-icon-hover sun light-layout" href="{{ ('theme-toggle') }}"
                            style="display: none;">
                            <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-7"
                                style="display: none;"></iconify-icon>
                        </a>
                    </li>


                    <!-- ------------------------------- -->

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
