@php
    $reviews = [
        [
            'name' => 'Laura',
            'fonction' => 'Propriétaire de boutique en ligne',
            'title' => 'Le suivi en temps réel est juste incroyable.',
            'content' =>
                "Je suis vraiment satisfait de l'application D-Go ! J'ai acheté un forfait Internet en quelques clics seulement, et la transaction a été super sécurisée via MoMo. En plus, j'ai reçu mon forfait instantanément. C'est exactement ce que je cherchais.",
        ],
        [
            'name' => 'Marc',
            'fonction' => 'Entrepreneur',
            'title' => 'Des rapports de vente clairs et détaillés.',
            'content' =>
                "Les rapports de vente sont bien conçus et nous permettent d'analyser nos résultats par période ou par produit. C'est devenu un outil de décision essentiel",
        ],
        [
            'name' => 'Luc',
            'fonction' => 'Gérant de magasin alimentaire',
            'title' => 'Une application fiable et intuitive.',
            'content' =>
                'Nous avons testé plusieurs outils de gestion avant de trouver celui-ci. Il est intuitif, rapide et nous n’avons eu aucun souci technique depuis le début',
        ],

        [
            'name' => 'Elise',
            'fonction' => 'Responsable de franchise',
            'title' => 'Service client au top !',
            'content' =>
                'Le service client est toujours là pour nous aider en cas de besoin. Ils sont réactifs et vraiment à l’écoute. Un vrai plus pour un logiciel de gestion !',
        ],

        [
            'name' => 'Rachid',
            'fonction' => 'Co-fondateur d\'une chaîne de boutiques',
            'title' => 'Une solution complète pour notre croissance.',
            'content' =>
                'Nous avons pu accompagner la croissance de notre entreprise précédemment à cet outil. La gestion des ventes, des stocks et le suivi du chiffre d\'affaires se font sans stress.',
        ],
    ];
@endphp
<section class="container review-section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class=" col-lg-4 ">

                    <div class="card shadow-none"
                        style="background: url('{{ asset('assets/woman1.jpg') }}'); height: 350px; background-size: cover;">
                        <div class="bg-white p-2 px-3 rounded-end-pill mb-3"
                            style="position: absolute; bottom: 0;left: 0;">
                            <h6 class="mb-0">— Amina</h6>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>

                    <div class="card shadow-none bg-primary-subtle p-3 rounded-3">
                        <h6>Une gestion simple, rapide et sécurisée </h6>
                        <p>Je suis vraiment satisfait de l’application Go-Location ! J’ai pu enregistrer un nouveau locataire et suivre ses paiements en quelques clics seulement. Tout est clair, sécurisé et bien organisé. C’est exactement la solution qu’il me fallait pour gérer mes locations sans stress.</p>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="card shadow-none bg-warning-subtle p-3 rounded-3">
                        <h6>Le meilleur rapport qualité-prix du marché</h6>
                        <p>
                            Je recommande vivement cette application à tous les propriétaires qui souhaitent gérer leurs locations facilement et à moindre coût. J’ai testé d’autres solutions, mais celle-ci reste la plus complète et économique. Un excellent outil pour maximiser mes revenus sans me compliquer la vie.
                        </p>
                    </div>
                    <div class="card shadow-none"
                        style="background: url('{{ asset('assets/man1.jpg') }}'); height: 350px; background-size: cover;">
                        <div class="bg-white p-2 px-3 rounded-end-pill mb-3"
                            style="position: absolute; bottom: 0;left: 0;">
                            <h6 class="mb-0">— Franklin</h6>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>

                </div>
                <div class=" col-lg-4">
                    <div class="card"
                        style="background: url('{{ asset('assets/man2.jpg') }}'); height: 350px; background-size: cover;">
                        <div class="bg-white p-2 px-3 rounded-end-pill mb-3"
                            style="position: absolute; bottom: 0;left: 0;">
                            <h6 class="mb-0">— Jean-Pierre</h6>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                    <div class="bg-success-subtle p-3 rounded-3">

                       <h6>Une solution fiable pour gérer mes locations</h6> 
                       <p> Go-Location a transformé ma façon de gérer mes chambres. Grâce aux rappels automatiques, au suivi des paiements et à la fiche locataire complète, je gagne du temps au quotidien. L’interface est simple à utiliser et le service client est toujours réactif. C’est devenu un outil indispensable pour moi. </p>
                    </div>
                </div>
            </div>

            <div class="py-5">
                <div class="review-slider position-relative" data-aos="fade-up" data-aos-delay="400"
                    data-aos-duration="1000">
                    <div class="owl-carousel owl-theme">
                        @foreach ($reviews as $rev)
                            <div class="item text-center">
                                <ul
                                    class="list-unstyled d-flex align-items-center justify-content-center gap-1 mb-0 mb-8 pb-6">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="ti ti-star-filled d-block fs-7 text-warning"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="ti ti-star-filled d-block fs-7 text-warning"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="ti ti-star-filled d-block fs-7 text-warning"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="ti ti-star-filled d-block fs-7 text-warning"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="ti ti-star-filled d-block fs-7 text-warning"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h6 class="fs-9 mb-8 pb-6 fw-medium">
                                    {{ $rev['title'] }}
                                </h6>
                                <p class="fs-6">
                                    {{ $rev['content'] }}
                                </p>
                                <div class="d-flex align-items-center justify-content-center pt-5">
                                    <img src="{{ asset('spike/assets/images/profile/user-1.jpg') }}" alt=""
                                        class="w-auto me-3 rounded-circle" width="64" height="64">
                                    <div class="text-start">
                                        <h6 class="fs-5 mb-1">{{ $rev['name'] }} </h6>
                                        <p class="mb-0 fs-4">{{ $rev['fonction'] }} </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
