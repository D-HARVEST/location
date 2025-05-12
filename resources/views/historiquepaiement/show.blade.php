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
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $historiquepaiement->louerchambre_id) }}" class="btn btn-sm btn-primary">Retour</a>
                        </div>
                        <div class="row">



                        {{-- <div class="col-lg-4">
                            <strong class="text-dark ">Louerchambres Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->louerchambres_id }}"
                                readonly>
                        </div> --}}

                        <div class="col-lg-4">
                            <strong class="text-dark ">Date de paiement:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->datePaiement }}"
                                readonly>
                        </div>



                        <div class="col-lg-4">
                            <strong class="text-dark ">Montant:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->montant }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Mode de paiement:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->modePaiement }}"
                                readonly>
                        </div>

                        {{-- <div class="col-lg-4">
                            <strong class="text-dark ">Idtransaction:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->idTransaction }}"
                                readonly>
                        </div> --}}

                        <div class="col-lg-4 mt-4">
                            <strong class="text-dark ">Mois de paiement:</strong>
                            <div class="badge bg-success text-white">
                                @if(!empty($historiquepaiement) && !empty($historiquepaiement->moisPaiement))
                                {{ \Carbon\Carbon::parse($historiquepaiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
                            @else
                                -
                            @endif
                            </div>

                        </div>

                        <div class="col-lg-4 mt-4">
                            <strong class="text-dark ">Quittance</strong>
                            @if($historiquepaiement->quittanceUrl)
                            <a href="{{ asset('storage/' . $historiquepaiement->quittanceUrl) }}" target="_blank" class="badge bg-success text-white" style="text-decoration: none;">
                                Voir la quittance
                            </a>
                        @else
                            <span class="badge bg-danger">
                                Aucune quittance
                            </span>
                        @endif
                        </div>

                        {{-- <div class="col-lg-4">
                            <strong class="text-dark ">User Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->user_id }}"
                                readonly>
                        </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
