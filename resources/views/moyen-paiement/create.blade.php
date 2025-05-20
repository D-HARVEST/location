@php
    $pagetitle = 'Nouveau Moyen Paiement';
    $breadcrumbs = ['Liste des Moyen Paiement(s)' => route('moyen-paiements.index'), 'Nouveau Moyen Paiement' => route('moyen-paiements.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Moyen Paiement
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('moyen-paiements.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Moyen Paiement</h5>
                            <span>Formulaire d'ajout d'un(e)  Moyen Paiement</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('moyen-paiements.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('moyen-paiement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
