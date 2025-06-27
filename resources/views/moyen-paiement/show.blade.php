@php
    $pagetitle = 'Détails Moyen Paiement';
    $breadcrumbs = ['Liste des Moyen Paiement' => route('moyen-paiements.index'), 'Détails Moyen Paiement' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails Moyen Paiement
@endsection

@section('content')
<section class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="text-end mb-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">Retour</a>
                    </div>

                    <div class="row g-4">

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Désignation</div>
                                <div class="fw-semibold text-dark">{{ $moyenPaiement->Designation }}</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Clé Privée</div>
                                <div class="fw-semibold text-dark">{{ $moyenPaiement->Cle_privee }}</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Clé Publique</div>
                                <div class="fw-semibold text-dark">{{ $moyenPaiement->Cle_public }}</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Statut Actif</div>
                                <div class="fw-semibold text-dark">
                                                                                @if($moyenPaiement->isActive == 1)
                                                <span class="">Oui</span>
                                            @else
                                                <span class="">Non</span>
                                            @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Utilisateur</div>
                                <div class="fw-semibold text-dark">{{ $moyenPaiement->user->name }}</div>
                            </div>
                        </div>

                    </div> <!-- end .row -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
