<a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
    aria-expanded="false">
    <div class="d-flex align-items-center flex-shrink-0">
        <div class="user-profile me-sm-3 me-2">
            <img src="{{ asset('spike/assets/images/profile/user-1.jpg') }}" width="45" class="rounded-circle"
                alt="">
        </div>
        <span class="d-sm-none d-block"><iconify-icon icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>

        <div class="d-none d-sm-block">
            <h6 class="fw-bold fs-4 mb-1 profile-name">
                {{ Str::limit(Auth::user()->name ?? '-', 12) }}
            </h6>
            <p class="fs-3 lh-base mb-0 profile-subtext">
                {{ Str::limit(Auth::user()->email ?? '-', 10) }}
            </p>
        </div>
    </div>
</a>
<div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
    <div class="profile-dropdown position-relative" data-simplebar>
        <div class="d-flex align-items-center justify-content-between pt-3 px-7">
            <h3 class="mb-0 fs-5">Mon Profile</h3>
            <button type="button" class="border-0 bg-transparent" aria-label="Close">
                <iconify-icon icon="solar:close-circle-line-duotone" class="fs-7 text-muted"></iconify-icon>
            </button>
        </div>

        <div class="d-flex align-items-center mx-7 py-9 border-bottom">
            <img src="{{ asset('spike/assets/images/profile/user-1.jpg') }}" alt="user" width="90"
                class="rounded-circle" />
            <div class="ms-4">
                <h4 class="mb-0 fs-5 fw-normal">{{ Auth::user()->name ?? '-' }}</h4>
                <span class="text-muted">
                    @role('Super-admin')
                        Administrateur
                    @endrole
                    @role('client')
                        Client
                    @endrole
                </span>
                <p class="text-muted mb-0 mt-1 d-flex align-items-center">
                    <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
                    {{ Auth::user()->email ?? '-' }}
                </p>
            </div>
        </div>

        <div class="message-body">
            <a href="{{ ('mon-profile') }}" class="dropdown-item px-7 d-flex align-items-center py-6">
                <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
                    <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7"></iconify-icon>
                </span>
                <div class="w-75 d-inline-block v-middle ps-3 ms-1">
                    <h5 class="mb-0 mt-1 fs-4 fw-normal">
                        Mon Profil
                    </h5>
                    <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Paramètres du compte</span>
                </div>
            </a>


        </div>

        <div class="py-6 px-7 mb-1">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger w-100 rounded-1">
                    Déconnexion
                </button>

            </form>
        </div>
    </div>
</div>
