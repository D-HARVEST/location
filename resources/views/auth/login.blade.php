@extends('auth.template')
@section('content')
    <h2 class="lh-base mb-0">Authentification </h2>
    <p>
        Connectez-vous à votre compte pour continuer.
    </p>
    <hr>
    <div class="row">

        <div class="col-12">
            <a class="btn btn-white shadow-sm text-dark link-primary border fw-semibold d-flex align-items-center justify-content-center rounded-1 py-6"
                href="{{ url('/login/google') }}" role="button">
                <img src="{{ asset('matdash/google-icon.svg') }}" alt="matdash-img" class="img-fluid me-2" width="18"
                    height="18">
                <span class="d-none d-xxl-inline-flex"> Se connecter avec Google</span>
            </a>
        </div>
    </div>
    <div class="position-relative text-center my-4">
        <p class="mb-0 fs-12 px-3 d-inline-block bg-body z-index-5 position-relative">
            Ou connectez-vous avec
        </p>
        <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
    </div>
    <form method="POST" action="{{ route('login') }}" role="form">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email / Identifiant</label>
            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                id="exampleInputEmail1" required autocomplete="email" autofocus name="email" value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <a class="text-success link-dark fs-2" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>
            <div class="pass_show_hide">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input success" type="checkbox" name="remember" id="flexCheckChecked"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                    Rester connecté(e)
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-dark w-100 py-8 mb-4 rounded-1">Se
            connecter</button>


        <div class="d-flex align-items-center">
            <p class="fs-12 mb-0 fw-medium">Vous n'avez pas encore de compte chez nous ?</p>
            <a class="text-success fw-bolder ms-2" href="{{ route('register') }}">S'inscrire</a>
        </div>
    </form>
@endsection

@section('illustrations')
    <img src="{{ asset('matdash/login2.png') }}" class="w-100 img-fluid my-5" alt="...">
    <p class="text-center">
        Veuillez vous connecter pour accéder à votre espace personnel et profiter de nos
        services. Si vous n'avez pas encore de compte, inscrivez-vous en quelques clics pour commencer
    </p>
    {{-- <div id="auth-login" class="carousel slide auth-carousel mt-5 pt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#auth-login" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#auth-login" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#auth-login" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                    <img src="../assets/images/backgrounds/login-side.png" alt="login-side-img" width="300"
                        class="img-fluid" />
                    <h4 class="mb-0">Feature Rich 3D Charts</h4>
                    <p class="fs-12 mb-0">Donec justo tortor, malesuada
                        vitae
                        faucibus ac, tristique sit amet
                        massa.
                        Aliquam dignissim nec felis quis imperdiet.</p>
                    <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                    <img src="../assets/images/backgrounds/login-side.png" alt="login-side-img" width="300"
                        class="img-fluid" />
                    <h4 class="mb-0">Feature Rich 2D Charts</h4>
                    <p class="fs-12 mb-0">Donec justo tortor, malesuada
                        vitae
                        faucibus ac, tristique sit amet
                        massa.
                        Aliquam dignissim nec felis quis imperdiet.</p>
                    <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center w-100 h-100 flex-column gap-9 text-center">
                    <img src="../assets/images/backgrounds/login-side.png" alt="login-side-img" width="300"
                        class="img-fluid" />
                    <h4 class="mb-0">Feature Rich 1D Charts</h4>
                    <p class="fs-12 mb-0">Donec justo tortor, malesuada
                        vitae
                        faucibus ac, tristique sit amet
                        massa.
                        Aliquam dignissim nec felis quis imperdiet.</p>
                    <a href="javascript:void(0)" class="btn btn-primary rounded-1">Learn More</a>
                </div>
            </div>
        </div>

    </div> --}}
@endsection
