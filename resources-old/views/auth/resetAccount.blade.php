@extends('auth.template')

@section('content')
    <div class="bg-success text-white text-center text-bold p-3 mb-4" style="margin-top: -60px; border-radius:10px;">
        <h3 class="text-white">Réinitialiser mon compte</h3>
    </div>

    @if ($user = Session::get('user'))

    {{-- <div class="alert alert-warning">
        <strong>NB : Vous d</strong>
    </div> --}}
        <div class="alert-info p-2 text-start">
            <ul>
                <li>
                    <label for="">Nom & Prénoms : </label><strong> {{ $user->NomEtudiant . ' ' . $user->PrenomEtudiant }}
                    </strong>
                </li>
                <li>
                    <label for="">Date Naissance : </label><strong> {{ $user->DateNaissanceEtudiant }} </strong>
                </li>
                <li>
                    <label for="">Filière : </label><strong> {{ $user->LibelleFiliere }} </strong>
                </li>
                <li>
                    <label for="">Email : </label><strong> {{ $user->email }} </strong>
                </li>

            </ul>

        </div>
        <form action="{{ route('account-reset-update', $user->user_id) }}" method="post">

            @csrf

            <div class="row">
                <div class="col-12 text-start my-2">
                    <label for="" class="text-dark text-bold">Email</label> <span class="text-danger">*</span>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email')?? $user->email }}" required autocomplete="email"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        {{-- pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" --}}
                        >
                    <small id="email" class="text-muted ">
                        <i class="fa-solid fa-circle-info text-italic me-1 "></i>
                        Votre adresse email valide
                    </small>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 text-start my-2">
                    <label for="" class="text-dark text-bold">Nouveau Mot De Passe</label>

                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password"
                         pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,}$"
                        title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )"
                        minlength="8">
                        <small id="password" class="text-muted">
                            <i class="fa-solid fa-circle-info text-italic me-1"></i>
                            Définir un nouveau mot de passe spécifique à cette plateforme . Ce dernier doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )
                        </small>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 text-start my-2">
                    <label for="" class="text-dark text-bold">Confirmer Mot De Passe</label>

                    <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required
                        autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,}$" title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )" minlength="8">
                        <small id="password" class="text-muted">
                            <i class="fa-solid fa-circle-info text-italic me-1"></i>
                            Confirmer le mot de passe précédemment saisi
                        </small>

                </div>

                <div class="col-12 text-start my-2">

                    <button type="submit" class="btn btn-success w-100  mb-2 text-white text-bold ">Sauvegarder</button>
                </div>


            </div>
        </form>
    @else
       
        @if ($message = Session::get('message'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="text-start">
            @if (count($errors) != 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->messages() as $err => $val)
                            <li><strong>{{ $err }}</strong> : @foreach ($val as $mes)
                                    {{ $mes }} |
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @include('auth.resetAccountForm')
        </div>
        <div class="d-flex justify-content-around align-items-center w-100">

            <div><a href="/login" class="mt-4 text-sm text-center text-bold">Se connecter
                    ?</a></div>
        </div>
    @endif

@endsection
