<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="D-Go : La plateforme qui simplifie l'achat de forfaits Internet.">
    <title>D-Go - Revente de Forfaits Internet</title>

    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link rel="stylesheet" href="{{ asset('spike/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" />


    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        .hero-section {
            position: relative;
            background: url('/assets/image/futuristic-smart-city-with-5g-global-network-technology_53876-98438.avif') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .header-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2;
            padding: 10px 20px;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .content-container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .features {
            background-color: #f8f9fa; /* Couleur similaire à celle des partenaires */
            padding: 50px 0;
        }

        .features .card {
            border: none;
            background: white;
            transition: transform 0.3s;
        }

        .features .card:hover {
            transform: translateY(-10px);
        }

        .cta-section {
            background-color: #127dc5;
            color: white;
            padding: 50px 0;
        }

        .partners {
            background-color: #f8f9fa; /* Couleur du fond */
        }

        .partner-card {
            border: none;
            transition: transform 0.3s;
            text-align: center;
            background-color: white;
        }

        .partner-card img {
            max-width: 150px;
            height: auto;
        }

        .partner-card:hover {
            transform: scale(1.05);
        }

        .contact {
            background-color: #f8f9fa; /* Couleur similaire à celle des partenaires */
            padding: 50px 0;
        }

        .contact .card {
            background: white;
            border: none;
            transition: transform 0.3s;
        }

        .contact .card:hover {
            transform: translateY(-10px);
        }

        .footer {
            background: #343a40;
            color: white;
        }

        .footer a {
            color: #f8f9fa;
        }

        /* Uniformiser la taille des icônes */
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Section Héro (Introduction) -->
    <section class="hero-section">
        <!-- Menu en haut -->
        <div class="container-fluid header-container">
            @include('landing.header-menu')
        </div>
        <!-- Contenu centré -->
        <div class="container content-container">
            <p class="hero-title display-2">D-Go</p> <!-- Modifié pour une taille plus grande -->
            <div class="mt-4">
                <p style="font-size: 1.5rem;" >Achetez vos forfaits Internet facilement</p>
                <p class="lead">Profitez de tarifs avantageux et d'une expérience rapide et sécurisée.</p>
            </div>
        </div>
    </section>


    <!-- Section Fonctionnalités -->
    <section id="features" class="features">
        <div class="container text-center">
            <h2 class="mb-5">Pourquoi choisir D-Go ?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card w-100 border p-3">
                        <i class="fa-solid fa-money-bill-wave feature-icon text-primary"></i>
                        <h5 class="card-title">Tarifs Compétitifs</h5>
                        <p class="card-text">Des prix imbattables pour toutes vos données Internet.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card w-100 border p-3">
                        <i class="fa-solid fa-lock feature-icon text-primary"></i>
                        <h5 class="card-title">Paiements Sécurisés</h5>
                        <p class="card-text">Effectuez vos transactions en toute sécurité via MoMo et Moov.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card w-100 border p-3">
                        <i class="fa-solid fa-clock feature-icon text-primary"></i>
                        <h5 class="card-title">Livraison Immédiate</h5>
                        <p class="card-text">Recevez vos forfaits en quelques secondes seulement.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Partenaires -->
    <section id="partners" class="py-5 partners">
        <div class="container text-center">
            <h2 class="mb-5">Ils nous font confiance</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card w-100 border partner-card">
                        <img src="{{ asset('asset_perso/mtn.png') }}" alt="MTN Logo" class="mx-auto" width="100" height="100">
                        <div class="card-body">
                            <h5 class="card-title">MTN Bénin</h5>
                            <p class="card-text">Notre partenaire principal pour la fourniture de forfaits Internet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card w-100 border partner-card">
                        <img src="/assets/image/moov-logo.png" alt="Moov Logo" class="mx-auto">
                        <div class="card-body">
                            <h5 class="card-title">Moov Africa</h5>
                            <p class="card-text">Un partenaire clé pour des transactions fluides et rapides.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="py-5">
                <div class="mb-5">
                    <h2 class="fs-9 mb-0 text-center" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000">
                        Contactez-nous
                    </h2>
                </div>
                <div class="row d-flex align-items-stretch">
                    <!-- Messagerie Live Card -->
                    <div class="col-lg-4 col-sm-6 ">
                        <div class="card w-100 border shadow-none p-3 border-radius-xl shadow">
                            <div class="row d-flex align-items-stretch ">
                                <div class="col-3">
                                    <div
                                        class="bg-light-primary rounded py-2 px-3 d-flex justify-content-center align-items-center h-100">

                                        <img src="https://ornestaste.com/spike/socialmedia_tech_09.png" class="img-fluid"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Messagerie Live</h4>

                                    <h6 class="card-subtitle mt-2 mb-0 fw-normal text-muted">
                                        Vous pouvez nous contacter en direct via notre messagerie live.
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="col-lg-4 col-sm-6 ">
                        <div class="card w-100 border shadow-none p-3 border-radius-xl shadow">
                            <div class="row d-flex align-items-stretch ">
                                <div class="col-3">
                                    <div class=" d-flex justify-content-center align-items-center h-100">

                                        <img src="https://ornestaste.com/ccc.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Email</h4>

                                    <a href="mailto:contact@d-harvest.com"
                                        class="card-subtitle mt-2 mb-0 fw-normal text-muted">
                                        contact@d-harvest.com
                                    </a>

                                </div>
                                <div class="d-flex">

                                    <div class="ms-2">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="col-lg-4 col-sm-6 ">
                        <div class="card w-100 border shadow-none p-3 border-radius-xl shadow">
                            <div class="row d-flex align-items-stretch ">
                                <div class="col-3">
                                    <div class=" d-flex justify-content-center align-items-center h-100">

                                        <img src="https://ornestaste.com/eee.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h4>Téléphone</h4>

                                    <a href="tel:+22967404081" class="card-subtitle mt-2 mb-0 fw-semibold text-muted">
                                        (+229) 67 40 40 81
                                    </a>
                                </div>

                                <div class="d-flex">

                                    <div class="ms-2">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container text-center">
            <p>&copy; 2024 D-Go. Tous droits réservés.</p>
            <p>Suivez-nous :
                <a href="#" class="mx-1"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="mx-1"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="mx-1"><i class="fa-brands fa-instagram"></i></a>
            </p>
        </div>
    </footer>

    <script src="{{ asset('spike/slick2.js') }}"></script>

    <script src="{{ asset('spike/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/app.min.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/sidebarmenu.js') }}"></script>
    <script src="{{ asset('spike/assets/js/theme/feather.min.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('spike/assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('spike/assets/libs/aos/aos.js') }}"></script>
    <script src="{{ asset('spike/assets/js/landingpage.js') }}"></script>

</body>

</html>
