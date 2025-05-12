@php
    $pagetitle = 'Nouveau Chambre';
    $breadcrumbs = ['Liste des Chambre(s)' => route('chambres.index'), 'Nouveau Chambre' => route('chambres.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Chambre
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Chambre</h5>
                            <span>Formulaire d'ajout d'un(e)  Chambre</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('chambres.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('chambre.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
