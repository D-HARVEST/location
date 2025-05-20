@php
    $pagetitle = 'Détails Moyen Paiement';
    $breadcrumbs = ['Liste des Moyen Paiement' => route('moyen-paiements.index'), 'Détails Moyen Paiement' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Moyen Paiement
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('moyen-paiements.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Designation:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $moyenPaiement->Designation }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Cle Privee:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $moyenPaiement->Cle_privee }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Cle Public:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $moyenPaiement->Cle_public }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Isactif:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $moyenPaiement->isActif }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">User Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $moyenPaiement->user_id }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
