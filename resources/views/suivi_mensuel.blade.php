@php
    $pagetitle = 'Suivi Mensuel';
    // $breadcrumbs = ['Liste des Chambre(s)' => route('chambres.index')];
@endphp

@extends('layouts.app')


@section('content')
<div class="">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <div class="col mb-2">
                        <h5 class="card-title text-dark fw-bolder mb-0">Suivi mensuel</h5>
                        <hr>
                    </div>

                    @forelse ($chambres as $chambre)
                        <div class="mb-4">
                            <h6 class="text-primary">
                                Chambre : {{ $chambre->libelle }} |
                                Maison : {{ $chambre->maison->libelle ?? 'Maison inconnue' }}
                            </h6>

                            @if ($chambre->historiquePaiements->isEmpty())
                                <p class="text-muted">Aucun historique de paiement pour cette chambre.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead">
                                            <tr>
                                                <th>N°</th>
                                                <th>Mois</th>
                                                <th>Montant</th>
                                                <th>Statut de paiement</th>
                                                <th>Confirmation de propriétaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chambre->historiquePaiements as $index => $paiement)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $paiement->moisPaiement ?? '-' }}</td>
                                                    <td>{{ $paiement->montant ?? '-' }}</td>
                                                    <td>{{ $paiement->statut ?? 'En attente' }}</td>
                                                    <td>{{ $paiement->confirmation ?? 'Non confirmé' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <hr>
                    @empty
                        <p>Aucune chambre trouvée pour votre compte.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
