@extends('auth.template')

@section('content')
<h2 class="lh-base mb-0">Réinitialiser votre mot de passe</h2>
<p>
    Entrez votre adresse e-mail pour recevoir les instructions de réinitialisation de mot de passe.
</p>
<hr>
    <form method="POST" action="{{ route('password.email') }}" role="form" class="text-start">
        @csrf

       
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 text-start my-2">
                <label for="email" class="text-dark text-bold">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

               
                <small id="emailHelp" class="text-muted">
                    <i class="fa-solid fa-circle-info text-italic me-1"></i>
                   
                </small>

                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

         
            <div class="col-12 text-start my-2">
                <button type="submit" class="btn btn-dark w-100 mb-2 text-white text-bold">Soumettre</button>
            </div>
        </div>

      
        <div class="d-flex justify-content-around align-items-center w-100 my-2">
            <div><a href="/login" class="mt-4 text-sm text-center">Authentification</a></div>
            <div><label>|</label></div>
            <div><a href="{{ route('register') }}" class="text-info text-gradient fw-bold">S'inscrire</a></div>
        </div>

    </form>
@endsection

@section('illustrations')
    <img src="{{ asset('matdash/password.jpg') }}" class="w-100 img-fluid my-5" alt="Illustration">
    <p class="text-center mb-5">
        Récupérez l'accès à votre espace personnel en quelques étapes simples. Entrez l'adresse e-mail associée à votre compte et cliquez sur le lien qui vous a été envoyé.
    </p>
@endsection
