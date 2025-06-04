@php
    $pagetitle = 'Modifier Moyen Paiement';
    $breadcrumbs = ['Liste des Moyen Paiement(s)' => route('moyen-paiements.index'), 'Modifier Moyen Paiement' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Moyen Paiement
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Moyen Paiement</h5>
                            <span>Formulaire de modification: Moyen Paiement</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('moyen-paiements.update', $moyenPaiement->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('moyen-paiement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
