<!DOCTYPE html>
<html lang="fr" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo-dh.svg') }}" />
    <title>Go-location</title>

    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('spike/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" />


    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/aos/dist/aos.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" /> --}}


<style>
    body {
     background: white;
    }
   .card-img-top {
     height: 250px;
     object-fit: cover;
     padding-left: 30px;
     padding-right: 30px;
     padding-top: 20px;

   }
/* .tilt-card:hover {
  transform: rotate(-3deg);
} */

.tilt-card {
  transform: rotate(3deg);
  transition: transform 0.3s ease-in-out;
}


    .icon {
      font-size: 1.5rem;
      margin-right: 8px;
    }
    .feature {
      font-size: 1.2rem;
    }

    h1 {
      font-size: 3.5rem;
      font-family: 'Roboto', sans-serif;

    }
    p {
      font-size: 1.2rem;
    }
    .hiro{
         background: white;
         padding: 20px;
         padding-top: 30px
    }

.hero{
  padding-top: 80px;
  padding-bottom: 90px;
  background: #eff5fe;
}

.hero li{
    font-size: 1rem;
}
  </style>

  <style>
  .testimonial-card {
    background-color: #F5FAFF;
    border-radius: 20px;
    padding: 20px;
    height: 100%;
  }

  .testimonial-quote {
    font-size: 50px;
    color: #A2E4D9;
    line-height: 0.5;
    margin-right: 10px;
  }

  .testimonial-text {
    color: #2C3E50;
    font-size: 1rem;
  }

  .testimonial-role {
    color: #7F8C8D;
    font-size: 0.9rem;
  }

  .testimonial-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
  }
</style>

</head>
{{-- <script src="//code.tidio.co/a1c66h4zitdz51oldafsnwtmpciwn93n.js" async></script> --}}
<body>
    @include('landing.partials.styles')
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('spike/assets/images/logos/loader.svg') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>


  <div class="container">
    @include('landing.partials.header-menu')
  </div>



<section  class="hero">

    <div class="container mt-5">
    <div class="row align-items-center">
      <!-- Left Side -->
      <div class="col-md-6">
        <h1 class="fw-bold mb-3">
          Gérez vos <span style="color: #54b435">locations</span><br>
          immobilières simplement
        </h1>
        <p class="mb-4 text-secondary">
          Une solution complète et transparente pour propriétaires et locataires, avec un tarif compétitif de 4% du loyer mensuel.
        </p>
        <div class="d-flex gap-3 mb-4" >
          <a href="{{ route('register') }}" class="btn text-white px-4 rounded-1" style="font-size: 1.2rem; background-color: #54b435">Commencer</a>
          <a href="#" class="btn btn-outline-secondary px-4 rounded-1 bg-white" style="font-size: 1.2rem;">Nous contacter</a>
        </div>
        <!-- Features -->
    <div class="Feature">
        <div class="row">
          <div class="col-4">
              <span class="icon text-primary">📍</span>
              <span>Suivi immobilier</span>
          </div>

            <div class="col-6">
              <span class="icon text-primary">💰</span>
              <span>Tarifs transparents</span>
            </div>
        </div>
        <div class="row">
          <div class="col-6">
              <span class="icon text-primary">📅</span>
              <span>Gestion des paiements</span>
          </div>
        </div>
    </div>
    </div>
      <!-- Right Side -->
      <div class="col-md-6 mt-4 mt-md-0">
       <div class="card shadow rounded-4 tilt-card">

          <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Maison miniature" class="card-img-top rounded-top-4">
          <div class="card-body">
            <h5 class="card-title fw-bold">Appartement Moderne - Benin</h5>
            <p class="mb-1 text-secondary">Loyer: payer/mois</p>
            <p class="mb-3"><span class="fw-semibold" style="color: #54b435">Frais: 4%</span></p>

          </div>
        </div>
      </div>
    </div>
  </div>

</section>




<section class="hiro">
 <div class="container mt-5">
    <h2 class="text-center">Fonctionnalités principales</h2>

 <div class="container mt-4">
  <div class="row g-4">
    <div class="col-md-4 " >
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">📄</div>
        <h5 class="mt-3 fw-bold">Rédaction des contrats de location</h5>
        <p>Générez et stockez les contrats de location simplement, sans complication.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">💳</div>
        <h5 class="mt-3 fw-bold">Paiement et quittances électroniques</h5>
        <p>Paiement en ligne avec émission automatique de quittance en quelques clics.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">💵</div>
        <h5 class="mt-3 fw-bold">Paiements en espèces enregistrés</h5>
        <p>Même les paiements en espèces sont formalisés avec quittance incluse pour plus de transparence.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">✉️</div>
        <h5 class="mt-3 fw-bold">Gestion des demandes</h5>
        <p>Les locataires peuvent envoyer des requêtes (réparations, documents, etc.) directement via l'application.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">📊</div>
        <h5 class="mt-3 fw-bold">Statistiques et rapports</h5>
        <p>Tableau de bord pour les propriétaires ou gestionnaires pour suivre les loyers, impayés et plus encore.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">🔔</div>
        <h5 class="mt-3 fw-bold">Rappels automatiques</h5>
        <p>Rappels pour les loyers dus envoyés automatiquement aux locataires, vous n'avez plus à y penser.</p>
      </div>
    </div>

     <div class="col-md-4">
      <div class="card h-100 p-3 border-1">
        <div class="fs-10">🌍</div>
        <h5 class="mt-3 fw-bold">Disponible partout</h5>
        <p>Application disponible sur Android, iOS et web pour une gestion où que vous soyez.</p>
      </div>
    </div>

  </div>
</div>
  </div>

</section>



<section class="hero">
    <h2 class="text-center">Fonctionnalités principales</h2>

    <div class="container my-5">
  <div class="row g-4">
    <!-- Carte Propriétaires -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm" style="border-top: 20px solid #00B86B; border-radius: 15px;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <div class="bg-light rounded-circle p-3">
              <i class="bi bi-house-door fs-6 text-success"></i>
            </div>
          </div>
          <h5 class="fw-bold">Propriétaires</h5>
          <ul class="list-unstyled mt-3">
            <li><span style="color: #00B86B">✔</span> Meilleure traçabilité des paiements et des communications</li>
            <li><span style="color: #00B86B">✔</span> Réduction des litiges grâce à la documentation automatique</li>
            <li><span style="color: #00B86B">✔</span> Tout est digitalisé, fini les papiers perdus ou les erreurs</li>
            <li><span style="color: #00B86B">✔</span> Gain de temps considérable dans la gestion quotidienne</li>
            <li><span style="color: #00B86B">✔</span> Rappels automatiques pour moins d'impayés</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Carte Locataires -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm" style="border-top: 20px solid #F5A623; border-radius: 15px;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <div class="bg-light rounded-circle p-3">
              <i class="bi bi-person fs-6 text-warning"></i>
            </div>
          </div>
          <h5 class="fw-bold">Locataires</h5>
          <ul class="list-unstyled mt-3">
            <li><span style="color: #F5A623">✔</span>  Preuve de paiement immédiate avec quittance numérique</li>
            <li><span style="color: #F5A623">✔</span>  Interface simple pour communiquer avec le propriétaire</li>
            <li><span style="color: #F5A623">✔</span>  Historique des quittances accessible à tout moment</li>
            <li><span style="color: #F5A623">✔</span>  Demandes de réparations ou d'intervention simplifiées</li>
            <li><span style="color: #F5A623">✔</span>  Rappels bienveillants pour éviter les retards</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Carte Gestionnaires immobiliers -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm" style="border-top: 20px solid #3C465C; border-radius: 15px;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <div class="bg-light rounded-circle p-3">
              <i class="bi bi-people fs-6 text-dark"></i>
            </div>
          </div>
          <h5 class="fw-bold">Gestionnaires immobiliers</h5>
          <ul class="list-unstyled mt-3">
            <li>✔ Rapports exportables pour analyse et comptabilité</li>
            <li>✔ Gestion multi-biens depuis une seule interface</li>
            <li>✔ Transparence totale sur l'historique des relations</li>
            <li>✔ Automatisation des tâches administratives récurrentes</li>
            <li>✔ Données centralisées accessibles de partout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</section>


<section class="hiro mt-5">
    <h2 class="text-center">Ce que disent nos utilisateurs</h2>



<div class="container py-5">
  <div class="row g-4">
    <!-- Marie L. -->
    <div class="col-md-6">
      <div class="testimonial-card d-flex flex-column h-100">
        <div class="d-flex align-items-center mb-2">
          <img src="https://randomuser.me/api/portraits/women/16.jpg" alt="Marie L." class="testimonial-img">
          <div>
            <strong>Marie L.</strong><br>
            <span class="testimonial-role">Propriétaire</span>
          </div>
        </div>
        <div class="d-flex">
          <div class="testimonial-quote">“</div>
          <p class="testimonial-text">
            Depuis que j'utilise cette app, je n'ai plus besoin de carnet papier, tout est automatique.
            Plus de quittances perdues, plus de rappels à envoyer !
          </p>
        </div>
      </div>
    </div>

    <!-- Thomas B. -->
    <div class="col-md-6">
      <div class="testimonial-card d-flex flex-column h-100">
        <div class="d-flex align-items-center mb-2">
          <img src="https://randomuser.me/api/portraits/men/91.jpg" alt="Thomas B." class="testimonial-img">
          <div>
            <strong>Thomas B.</strong><br>
            <span class="testimonial-role">Locataire</span>
          </div>
        </div>
        <div class="d-flex">
          <div class="testimonial-quote">“</div>
          <p class="testimonial-text">
            La communication avec mon propriétaire n'a jamais été aussi simple. Je peux faire des demandes
            de réparation et suivre leur avancement en temps réel.
          </p>
        </div>
      </div>
    </div>

    <!-- Sophie M. -->
    <div class="col-md-6">
      <div class="testimonial-card d-flex flex-column h-100">
        <div class="d-flex align-items-center mb-2">
          <img src="https://randomuser.me/api/portraits/women/36.jpg" alt="Sophie M." class="testimonial-img">
          <div>
            <strong>Sophie M.</strong><br>
            <span class="testimonial-role">Gestionnaire immobilier</span>
          </div>
        </div>
        <div class="d-flex">
          <div class="testimonial-quote">“</div>
          <p class="testimonial-text">
            En tant qu'agence immobilière, nous gérons plus de 150 biens avec cette application.
            L'export des rapports nous fait gagner des heures chaque mois.
          </p>
        </div>
      </div>
    </div>

    <!-- Lucas D. -->
    <div class="col-md-6">
      <div class="testimonial-card d-flex flex-column h-100">
        <div class="d-flex align-items-center mb-2">
          <img src="https://randomuser.me/api/portraits/men/70.jpg" alt="Lucas D." class="testimonial-img">
          <div>
            <strong>Lucas D.</strong><br>
            <span class="testimonial-role">Locataire</span>
          </div>
        </div>
        <div class="d-flex">
          <div class="testimonial-quote">“</div>
          <p class="testimonial-text">
            Je reçois automatiquement une notification quand le loyer est dû, et je peux payer directement
            depuis l'application. C'est vraiment pratique !
          </p>
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
        <!-- Scripts -->
        <script src="{{ asset('spike/assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('spike/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('spike/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('spike/assets/js/theme/app.init.js') }}"></script>
        <script src="{{ asset('spike/assets/js/theme/theme.js') }}"></script>
        <script src="{{ asset('spike/assets/js/theme/app.min.js') }}"></script>
        <script src="{{ asset('spike/assets/js/theme/sidebarmenu.js') }}"></script>
        <script src="{{ asset('spike/assets/js/theme/feather.min.js') }}"></script>

        <!-- Solar icons -->
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


        <!-- Owl Carousel -->
        <script src="{{ asset('spike/assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>

        <!-- AOS -->
        <script src="{{ asset('spike/assets/libs/aos/aos.js') }}"></script>

        <!-- Custom Landing Page Script -->
        <script src="{{ asset('spike/assets/js/landingpage.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myCollapse = document.getElementById('faqAccordion');
                var bsCollapse = new bootstrap.Collapse(myCollapse, {
                    toggle: false
                });
            });
        </script>
    </body>

    </html>
