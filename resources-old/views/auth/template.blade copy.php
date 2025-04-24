<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />
    <title>DBAU</title>
</head>

<body style="background: #f1f7fc;">
    <style>
        .h-10 {
            height: 7px;
        }

        .b-vert {
            background-color: #009900
        }

        .b-jaune {
            background-color: #ffff00
        }

        .b-rouge {
            background-color: #ff0000
        }
    </style>
<div style="min-height:100vh; display:flex; flex-direction:column;
justify-content:space-between;">
<div class="">
    <div class="container mt-3">
        <div class="row d-flex align-items-center">
            <div class="col-auto">
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/13/Coat_of_arms_of_Benin.svg?download"
                    height="100px" alt="">
            </div>
            <div class="col text-uppercase text-sm">
                <small>
                    <strong>

                        Direction des Bourses et <br> Aides Universitaires
                    </strong>
                </small>

                <div class="row my-1 w-25 p-0 ml-1 d-flex">
                    <div class="col-4 h-10 b-vert">

                    </div>
                    <div class="col-4 h-10 b-jaune">

                    </div>
                    <div class="col-4 b-rouge h-10">

                    </div>
                </div>
                <small>
                    <strong>
                        Ministère de l’Enseignement Supérieur <br>et de la Recherche Scientifique
                    </strong>
                </small>

            </div>
            <div class="col-auto d-sm-none d-md-block">
                01 BP 348 Cotonou <br>
                Tel: +229 21 30 53 93 <br>
                contact.mesrs@gouv.bj <br>
                secretariat.dbau@goub.bj <br>
            </div>

        </div>
    </div>
    @yield('content')
</div>
<footer style=" bottom:0; width:100%; ">
        <div class="row  w-100 p-0 ml-1 d-flex">
            <div class="text-center my-2">
                Système de Gestion des Allocations d'Etudes Universitaires ( SIGAL ) 	© COPYWRITE DBAU-DSI 2022
            </div>
            <div class="col-4 h-10 b-vert">

            </div>
            <div class="col-4 h-10 b-jaune">

            </div>
            <div class="col-4 b-rouge h-10">

            </div>
        </div>

    </footer>
</div>




    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/js/material-dashboard.min.js?v=3.0.4') }}"></script>
</body>

</html>
