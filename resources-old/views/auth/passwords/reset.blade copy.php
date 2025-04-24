<!DOCTYPE html>
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
    <section class="login-clean">
        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
        @endif

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <h6 class="text-center">Réinitialiser mot de passe</h6>

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nouveau Mot de passe" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,12}$" title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )" minlength="8">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmation Mot de passe" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&amp;*_=+-]).{8,12}$" title="Doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un symbole ( ! @ # $ % ^ &amp; * _ = + - )" minlength="8">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: #34c759;font-weight: 600;">Soumettre</button></div>
        </form>
    </section>
    <script src="{{ url('bsassets/js/jquery.min.js')}}"></script>
    <script src="{{ url('bsassets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>
