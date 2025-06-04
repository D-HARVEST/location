@php
    $pagetitle = 'Détails Paiementespece';
    $breadcrumbs = ['Liste des Paiementespece' => route('paiementespeces.index'), 'Détails Paiementespece' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Paiementespece
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        @role('locataire')
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $louerchambre->id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        @endrole
                        @role('gerant')
                         <div class="text-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        @endrole
                        <div class="row">



                        <div class="col-lg-4">
                            <strong class="text-dark ">Motif:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->Motif }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Montant:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->Montant }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Date:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->Date }}"
                                readonly>
                        </div>

                        {{-- <div class="col-lg-4">
                            <strong class="text-dark ">Date de reception:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->DateReception }}"
                                readonly>
                        </div> --}}

                        <div class="col-lg-6">
                            <strong class="text-dark ">Mois:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->Mois }}"
                                readonly>
                        </div>

                        <div class="col-lg-6">
                            <strong class="text-dark ">Locataire:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $louerchambre->user->name }} ({{ $louerchambre->chambre->libelle }} - {{ $louerchambre->chambre->maison->libelle }})"
                                readonly>
                        </div>

                        @if ($paiementespece->statut == 'REJETER')
                            <div class="col-lg-12">
                                <strong class="text-dark ">Motif du rejet de paiement en espece:</strong>
                                <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->Motif_rejet }}"
                                    readonly>
                            </div>
                        @endif

                        <div class="col-lg-12">
                            <strong class="text-dark ">Observation:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementespece->observation }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
