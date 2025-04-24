{{-- <a href="{{ route('login') }}" class="btn btn-warning rounded-1 w-100 ">S'authentifier</a> --}}
<div class="">
    {{-- <a href="">
        <div class="d-flex align-items-center rounded px-2" style="background: #F0F5F9 !important;">
            <div class="">

                <img src="{{ asset('asset_perso/man-holding-sign-up-form.png') }}" height="50" alt="">
            </div>
            <div class="col">
                <h6 class="mb-0">S'authentifier</h6>
                <small>Inscription / Connexion</small>
            </div>
        </div>
    </a> --}}
    <div class="dropleft dropdown  hover-dd ">
        {{-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            S'authentifier
        </button> --}}
        <button class="btn btn-xl btn-outline-secondary rounded-1 py-1 px-3 ms-2 fw-bold ">
            S'authentifier
        </button>
        <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" data-popper-placement="bottom-end">
            <a class="dropdown-item" href="{{ route('login') }}">
                <div class="d-flex align-items-center pb-9 position-relative">
                    <div class="bg-light-subtle rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('asset_perso/8707436_user_girl_woman_avatar_female_icon (1).png') }}"
                            height="40">
                    </div>
                    <div>
                        <h6 class="mb-1 bg-hover-primary">Se connecter</h6>
                        <span class="fs-2 d-block text-dark">J'ai déjà un compte sur cette plateforme </span>
                    </div>
                </div>
            </a>
            <a class="dropdown-item" href="{{ route('register') }}">
                <div class="d-flex align-items-center pb-9 position-relative">
                    <div class="bg-light-subtle rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('asset_perso/user-plus.png') }}" height="40">
                    </div>
                    <div>
                        <h6 class="mb-1 bg-hover-primary">S'inscrire</h6>
                        <span class="fs-2 d-block text-dark">Vous n'avez pas encore de compte ? </span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="dropdown hover-dd">

        {{-- <a class="nav-link" href="javascript:void(0)">
            Apps<span class="mt-1">
                <i class="ti ti-chevron-down fs-3"></i>
            </span>
        </a> --}}
        <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0">
            <a href="../main/app-chat.html" class="d-flex align-items-center pb-9 position-relative">
                <div class="bg-light-subtle rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../assets/images/svgs/icon-dd-chat.svg" alt="spike-img" class="img-fluid" width="24"
                        height="24">
                </div>
                <div>
                    <h6 class="mb-1 bg-hover-primary">S'inscrire</h6>
                    <span class="fs-2 d-block text-dark">Vous n'avez pas encore de compte ? </span>
                </div>
            </a>

        </div>
    </div>
</div>
