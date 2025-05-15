@php
    $pagetitle = 'Nouveau Paiementespece';
    $breadcrumbs = ['Liste des Paiementespece(s)' => route('paiementespeces.index'), 'Nouveau Paiementespece' => route('paiementespeces.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Paiementespece
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $louerchambre->id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Paiement espèce</h5>
                            <span>Formulaire d'ajout d'un(e)  Paiement espèce</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('paiementespeces.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('paiementespece.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
