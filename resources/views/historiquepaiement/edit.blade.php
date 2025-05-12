@php
    $pagetitle = 'Modifier Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement(s)' => route('historiquepaiements.index'), 'Modifier Historiquepaiement' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Historiquepaiement
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $historiquepaiement->louerchambre_id) }}" class="btn btn-sm btn-primary">Retour</a> 
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Historiquepaiement</h5>
                            <span>Formulaire de modification: Historiquepaiement</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('historiquepaiements.update', $historiquepaiement->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('historiquepaiement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
