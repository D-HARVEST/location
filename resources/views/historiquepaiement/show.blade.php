@php
    $pagetitle = 'Détails Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement' => route('historiquepaiements.index'), 'Détails Historiquepaiement' => ''];
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
                            <a href="{{ route('historiquepaiements.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Louerchambres Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->louerchambres_id }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Datepaiement:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->datePaiement }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Quittanceurl:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->quittanceUrl }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Montant:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->montant }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Modepaiement:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->modePaiement }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Idtransaction:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->idTransaction }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Moispaiement:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->moisPaiement }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">User Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $historiquepaiement->user_id }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
