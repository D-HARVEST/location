@extends('auth.template')
@section('content')
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="bg-success text-white text-center text-bold p-3 mb-4" style="margin-top: -60px; border-radius:10px;">
            <h3 class="text-white">Réinitialiser mot de passe</h3>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 text-start my-2">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12 text-start my-2">
                <label for="" class="text-dark text-bold">Nouveau Mot De Passe</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" {{-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,12}$" --}} {{-- title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )" --}}
                    minlength="8">
                <small id="password" class="text-muted">
                    <i class="fa-solid fa-circle-info text-italic me-1"></i>
                    Définir un nouveau mot de passe spécifique à cette plateforme
                </small>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 text-start my-2">
                <label for="" class="text-dark text-bold">Confirmer Mot De Passe</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" {{-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,12}$" --}} {{-- title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )" --}} minlength="8">
                <small id="password" class="text-muted">
                    <i class="fa-solid fa-circle-info text-italic me-1"></i>
                    Confirmer le mot de passe précédemment saisi
                </small>

            </div>
            <div class="col-12 text-start my-2">

                <button type="submit" class="btn btn-success w-100  mb-2 text-white text-bold ">Soumettre</button>
            </div>
            <div class="d-flex justify-content-around align-items-center w-100">

                <div><a href="/login" class="mt-4 text-sm text-center text-bold">Avez vous déjà un compte
                        ?</a></div>
            </div>

        </div>
    </form>
@endsection
