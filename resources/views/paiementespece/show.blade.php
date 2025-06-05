@php
    $pagetitle = 'Détails Paiementespece';
    $breadcrumbs = ['Liste des Paiementespece' => route('paiementespeces.index'), 'Détails Paiementespece' => ''];
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('template_title')
    Détails Paiementespece
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                            <div class="text-end mb-3">
                                <a href="{{ route('louerchambres.show', $louerchambre->id) }}" class="btn btn-sm btn-primary">Retour</a>
                            </div>
                       
                        {{-- @role('gerant')
                            <div class="text-end mb-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">Retour</a>
                            </div>
                        @endrole --}}

                        <div class="row g-4">

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Motif</div>
                                    <div class="fw-semibold text-dark">{{ $paiementespece->Motif }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Montant</div>
                                    <div class="fw-semibold text-dark">{{ number_format($paiementespece->Montant, 0, ',', ' ') }} FCFA</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Date</div>
                                    <div class="fw-semibold text-dark">{{ $paiementespece->Date }}</div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Mois</div>
                                    <div class="fw-semibold text-dark">
                                        @php
                                            Carbon::setLocale('fr');
                                            $moisArray = is_array($paiementespece->moisPayes) ? $paiementespece->moisPayes : json_decode($paiementespece->moisPayes, true);
                                            if ($moisArray) {
                                                foreach ($moisArray as $mois) {
                                                    echo ucfirst(Carbon::parse($mois)->translatedFormat('F Y')) . '<br>';
                                                }
                                            } else {
                                                echo '-';
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Locataire</div>
                                    <div class="fw-semibold text-dark">
                                        {{ $louerchambre->user->name }} ({{ $louerchambre->chambre->libelle }} - {{ $louerchambre->chambre->maison->libelle }})
                                    </div>
                                </div>
                            </div>

                            @if ($paiementespece->statut == 'REJETER')
                                <div class="col-lg-12">
                                    <div class="bg-light p-3 rounded">
                                        <div class="text-muted small">Motif du rejet de paiement en espèces</div>
                                        <div class="fw-semibold text-dark">{{ $paiementespece->Motif_rejet }}</div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Observation</div>
                                    <div class="fw-semibold text-dark">{{ $paiementespece->observation }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
