@php
    $pagetitle = 'Modifier Chambre';
    $breadcrumbs = ['Liste des Chambre(s)' => route('chambres.index'), 'Modifier Chambre' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Chambre
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Chambre</h5>
                            <span>Formulaire de modification: Chambre</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('chambres.update', $chambre->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('chambre.forc')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
