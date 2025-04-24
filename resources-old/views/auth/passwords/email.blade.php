@extends('auth.template')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" role="form" class="text-start">
        @csrf
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
                <label for="" class="text-dark text-bold">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <small id="email" class="text-muted ">
                    <i class="fa-solid fa-circle-info text-italic me-1 "></i>
                    Il s'agit de l'adresse email que vous aviez utilisé pour vous inscrire sur cette plateforme
                </small>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 text-start my-2">
                <button type="submit" class="btn btn-success w-100  mb-2 text-white text-bold ">Soumettre</button>
            </div>
        </div>


        <div class="d-flex justify-content-around align-items-center w-100 my-2">

            <div><a href="/login" class="mt-4 text-sm text-center">Authentification</a></div>
            <div><label>|</label></div>
            <div><a href="{{ route('register') }}" class="text-info text-gradient fw-bold">S'inscrire</a></div>

        </div>

    </form>
@endsection
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>DBAU</title>
    <link rel="stylesheet" href="{{ url('bsassets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('bsassets/css/Login-Form-Clean.css') }}">
    <link rel="stylesheet" href="{{ url('bsassets/css/Sidebar-1.css') }}">
    <link rel="stylesheet" href="{{ url('bsassets/css/Sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('bsassets/css/styles.css') }}">
</head>

<body>

    <script src="{{ url('bsassets/js/jquery.min.js')}}"></script>
    <script src="{{ url('bsassets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html> --}}
