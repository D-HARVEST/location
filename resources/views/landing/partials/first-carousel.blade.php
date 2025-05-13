<div id="carouselExampleDark" class="carousel slide w-100 rounded-3 " data-bs-ride="carousel"
    style="max-height: 80vh; padding:0 !important;">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner rounded-3">
        <div class="carousel-item active " data-bs-interval="10000">

            <div style="background-image: url('{{ asset('assets/home10.jpg') }}'); background-size: cover; background-position: center; background-color: rgba(0, 0, 0, 0.9);"
                class="d-block w-100  img-car" alt="..."> </div>

            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-white text-shadow" >Go-Location</h1>
                <h5 class="text-white text-shadow">Gérez vos chambres en toute simplicité</h5>
                <p class="text-shadow">
                    Une solution tout-en-un pour suivre les réservations, les paiements, et vos locataires.
                </p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">

            <div style="background-image: url('{{ asset('assets/home12.jpg') }}'); "
                class="d-block w-100  img-car" alt="..."> </div>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="text-white text-shadow">Suivez vos Locations en Temps Réel</h5>
                <p class="text-shadow">
                    Gardez un œil sur vos performances grâce à un tableau de bord en direct : taux d’occupation, revenus générés, paiements en attente… tout est à portée de main.
                </p>
            </div>

        </div>
        <div class="carousel-item ">

            <div style="background-image: url('{{ asset('assets/home12.jpg') }}'); background-color: rgba(0, 0, 0, 0.8); "
                class="d-block w-100  img-car" alt="..."> </div>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="text-white text-shadow">Recevez des Alertes pour un Stock Critique</h5>
                <p class="text-shadow">
                    Ne manquez jamais une opportunité de vente, grâce aux notifications de stock bas.
                </p>
            </div>

        </div>

        <div class="know-more ">
            <div class="text-end ">

                <label
                    class=" text-wrap bg-white rounded-start-3 bg-white px-4 py-2 mb-0  h5 inverted-radius-at-bottom-left position-relative "
                    style="border-bottom-left-radius: 0 !important;">
                    <img src="{{ asset('logo-optishop-onlight.png') }}" class="me-2" width="150" alt="">
                    {{-- OPTI-SHOP --}}
                </label>



                <p class="bg-white rounded-start-3 rounded-bottom-3 bg-white px-4 py-3 mt-0 mb-0 inverted-radius-at-bottom-left position-relative"
                    style="border-bottom-left-radius: 0 !important; ">Devenez Smart dans la gestion de vos maisons.

                </p>


            </div>
        </div>
    </div>
    {{-- <a class="carousel-control-prev " href="#carouselExampleDark" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden" style="background: rgba(255,255,255, 0.5);">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</a> --}}

</div>
