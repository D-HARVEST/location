@php
    $pagetitle = 'Détails Paiementenattente';
    $breadcrumbs = ['Liste des Paiementenattente' => route('paiementenattentes.index'), 'Détails Paiementenattente' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Paiementenattente
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('paiementenattentes.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Louerchambre Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementenattente->louerchambre_id }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Datelimite:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementenattente->dateLimite }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Montant:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $paiementenattente->montant }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
