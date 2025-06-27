@php
    $pagetitle = 'Détails Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement' => route('historiquepaiements.index'), 'Détails Historiquepaiement' => ''];
    use Carbon\Carbon;
  $mois = is_array($historiquepaiement->moisPaiement)
    ? $historiquepaiement->moisPaiement
    : json_decode($historiquepaiement->moisPaiement, true);


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
                                    'locataire' => $historiquepaiement->user->name,
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
                                       @if (!empty($mois))
    @foreach ($mois as $m)
        {{ \Carbon\Carbon::parse(trim($m))->locale('fr')->translatedFormat('F Y') }}<br>
    @endforeach
@else
    -
@endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Quittance</div>
                                    @if($historiquepaiement->quittanceUrl)
                                                    <a href="{{ $historiquepaiement->quittanceUrl }}" target="_blank" download class="btn btn-sm btn-success">
                                                        Télécharger la quittance
                                                    </a>
                                                @elseif($historiquepaiement->modePaiement == 'Espece')
                                                    <a href="{{ route('paiementespeces.facture', $historiquepaiement->idTransaction) }}"
                                                        target="_blank" download class="btn btn-sm btn-success">
                                                        Télécharger la facture PDF
                                                    </a>

                                                @else
                                                    <span class="badge bg-danger">
                                                        Aucune quittance
                                                    </span>
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
