<header class="header  fixed-top bg-transparent px-0">
    <nav class="navbar navbar-expand-lg p-0 ">
        <div class="container px-0 ">
            <a class="navbar-brand m-0 p-0 " href="/">
                <img src="{{ asset('logo-dh.svg') }}" width="50" alt="img-fluid" />
            </a>
         <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
          </a>
            <div class="collapse navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav align-items-center mb-2 mb-lg-0">


                    <div class="nav-item pe-0 me-0">
                        <a class="nav-link me-0 pe-0" target="_blank">
                            @if (auth()->check())
                                <a href="{{ route('dashboard') }}"
                                    class="btn btn-xl btn-outline-success text-dark rounded-1 py-1 px-3 ms-2 me-0 ">Tableau
                                    de bord</a>
                            @else

                            <div class="dropleft dropdown  hover-dd me-0 pe-0">
                                {{-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                S'authentifier
                                </button> --}}
                                <button class="btn btn-xl btn-outline-success text-dark rounded-1 py-1 px-3 ms-2 me-0 ">
                                    S'authentifier
                                </button>
                                <div class="dropdown-menu " aria-labelledby="dropdownMenuButton"
                                    data-popper-placement="bottom-end" style="margin-left: -115px;">
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <div class="d-flex align-items-center pb-9 position-relative">
                                            <div
                                                class="bg-light-subtle rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('asset_perso/8707436_user_girl_woman_avatar_female_icon (1).png') }}"
                                                    height="40">
                                            </div>
                                            <div>
                                                <h6 class="mb-1 bg-hover-primary">Se connecter</h6>
                                                <span class="fs-2 d-block text-dark">J'ai déjà un compte sur
                                                    cette plateforme </span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <div class="d-flex align-items-center pb-9 position-relative">
                                            <div
                                                class="bg-light-subtle rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('asset_perso/user-plus.png') }}" height="40">
                                            </div>
                                            <div>
                                                <h6 class="mb-1 bg-hover-primary">S'inscrire</h6>
                                                <span class="fs-2 d-block text-dark">Vous n'avez pas encore
                                                    de
                                                    compte ? </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                           @endif
                        </a>
                    </div>
                </ul>
            </div>

        </div>
    </nav>
</header>
