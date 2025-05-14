@php
    $pagetitle = 'Détails Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement' => route('historiquepaiements.index'), 'Détails Historiquepaiement' => ''];
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Historiquepaiement
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <a href="{{ route('louerchambres.show', $historiquepaiement->louerchambre_id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>

                        <div class="row g-4">
                            @php
                                $infos = [
                                    'Date de paiement' => $historiquepaiement->datePaiement,
                                    'Montant' => number_format($historiquepaiement->montant, 0, ',', ' ') . ' FCFA',
                                    'Mode de paiement' => $historiquepaiement->modePaiement,
                                ];
                            @endphp

                            @foreach ($infos as $label => $value)
                                <div class="col-lg-4">
                                    <div class="bg-light p-3 rounded">
                                        <div class="text-muted small">{{ $label }}</div>
                                        <div class="fw-semibold text-dark">{{ $value }}</div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Mois de paiement</div>
                                    <div class="fw-semibold text-dark">
                                        @if (!empty($historiquepaiement->moisPaiement))
                                            {{ \Carbon\Carbon::parse($historiquepaiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Quittance</div>
                                    @if ($historiquepaiement->quittanceUrl)
                                        <a href="{{ asset('storage/' . $historiquepaiement->quittanceUrl) }}" target="_blank" class="text-success fw-semibold text-decoration-none">
                                            Voir la quittance
                                        </a>
                                    @else
                                        <span class="text-danger fw-semibold">Aucune quittance</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
