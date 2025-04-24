<!DOCTYPE html>
<html lang="fr">

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
        @if (isset($errormessage))
        <div class="alert alert-success" role="alert">
            {{ $errormessage }}
        </div>

        @endif

        <form method="post" action="/preinscription">
            @csrf
            <div class="text-center"><img src="{{ url('bsassets/img/lo.png') }}" width="100"></div>
            <div class="form-group"><label>N° de Table</label>
                <input class="form-control" type="text" name="num_table"></div>
            <div class="form-group"><label>Année d'obtention</label>
                <select class="form-control" name="annee_obtention">
                        <option  selected="" value="2010-2011">2010-2011</option>
                        <option  value="2011-2012">2011-2012</option>
                        <option  value="2012-2013">2012-2013</option>
                </select></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: #34c759;font-weight: 600;">Soumettre</button></div>
            <div class="form-row">
                <div class="col"><a class="forgot" href="/login">Avez vous déjà un compte ?</a></div>
            </div>
        </form>
    </section>
    <script src="{{ url('bsassets/js/jquery.min.js')}}"></script>
    <script src="{{ url('bsassets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>
