@php
    $pagetitle = 'Détails Intervention';
    $breadcrumbs = ['Liste des Intervention' => route('interventions.index'), 'Détails Intervention' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  d'intervention
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
                            @php
                                $infos = [
                                    'Libellé' => $intervention->libelle,
                                    'Locataire' => $intervention->louerchambre->user->name,
                                    'Maison' => $intervention->louerchambre->chambre->maison->libelle,
                                    'Chambre' => $intervention->louerchambre->chambre->libelle,
                                    "Date de soumission d'intervention" => \Carbon\Carbon::parse($intervention->created_at)->format('d/m/Y H:i'),

                                ];
                            @endphp

                            @foreach ($infos as $label => $value)
                                <div class="col-lg-6">
                                    <div class="bg-light p-3 rounded">
                                        <div class="text-muted small">{{ $label }}</div>
                                        <div class="fw-semibold text-dark">{{ $value }}</div>
                                    </div>
                                </div>
                            @endforeach



                            @php
                                $badgeColor = match($intervention->statut) {
                                    'EN ATTENTE' => 'warning',
                                    'CONFIRMER' => 'success',
                                    'REJETER' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp

                            <div class="col-lg-6">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Statut</div>
                                    <span class="badge bg-{{ $badgeColor }}">{{ $intervention->statut }}</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">Description</div>
                                    <div class="fw-semibold text-dark">{{ $intervention->description }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
