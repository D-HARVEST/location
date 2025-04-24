@extends('auth.template')

@section('script')
    <script>
        // $(window).load(function() {

        // });
        @if (count($errors) == 0)
            window.onload = function() {
                $('#modalBienvenu').modal('show');
                console.log('zag');
            }
        @endif
    </script>
@endsection
@section('pre-content')
    <style>
        .col-container {
            display: table;
            /* Make the container element behave like a table */
            width: 100%;
            /* Set full-width to expand the whole page */
        }

        .col {
            display: table-cell;
            /* Make elements inside the container behave like table cells */
        }
    </style>
    <div class="modal fade show" id="modalBienvenu">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Bienvenu(e) !</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="text-center">
                        <div class="h4">Êtes-vous déjà inscrit sur la plateforme ?</div>

                            <a href="{{ route('register') }}"
                                class="text-white text-gradient text-bold btn btn-warning w-100 my-2 fw-bold"> Si non, Inscrivez-vous ici</a>

                            <button class="text-white text-gradient text-bold btn btn-success w-100 my-2 fw-bold"
                                data-bs-dismiss="modal">Oui j'ai déjà un compte</button>



                    </div>
                    {{-- <div class="container my-4">
                        <div class="col-container">

                            <div class="col col-12 col-md-12 text-center">
                                <button class="btn btn-outline-info shadow">
                                    <h4 class="text-info">Inscription</h4>
                                    <p class="text-muted">Je n'ai pas de compte sur cette plateforme</p>

                                </button>
                            </div>

                        </div>
                    </div> --}}




                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('login') }}" role="form" class="text-start">
        @csrf

        <div class="bg-success text-white text-center text-bold p-3 mb-4" style="margin-top: -60px; border-radius:10px;">
            <h3 class="text-white">Authentification</h3>

        </div>
        <div class="row">
            <div class="col-12 text-start my-1">
                <label for="" class="text-dark text-bold">Email</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <small id="email" class="text-muted ">
                    <i class="fa-solid fa-circle-info text-italic me-1 "></i>
                    Il s'agit de l'adresse email que vous aviez utilisé pour inscrire sur cette plateforme
                </small>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 text-start my-1">
                <label for="" class="text-dark text-bold">Mot de passe</label>

                <div class="pass_show_hide">

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                </div>
                <small id="password" class="text-muted ">
                    <i class="fa-solid fa-circle-info text-italic me-1 "></i>
                    Le mot de passe de votre compte sur cette plateforme
                </small>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 text-start my-2">
                <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Rester
                        connecté(e)</label>
                </div>

            </div>
            <div class="col-12 text-start">

                <button type="submit" class="btn btn-success w-100  mb-2 text-white text-bold ">Se
                    connecter</button>
            </div>
            <div class="d-flex justify-content-around align-items-center w-100">

                <div><a href="{{ route('password.request') }}" class="mt-4 text-sm text-center text-dark">Mot
                        de passe oublié ?</a></div>
                <div><label>|</label></div>
                <div><a href="{{ route('register') }}" class="text-info text-gradient text-bold">Inscrivez-vous</a>
                </div>
            </div>

        </div>
    </form>
@endsection
