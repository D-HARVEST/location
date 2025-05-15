@php
    $pagetitle = 'Modifier Paiementespece';
    $breadcrumbs = ['Liste des Paiementespece(s)' => route('paiementespeces.index'), 'Modifier Paiementespece' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Paiementespece
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $louerchambre->id) }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Paiementespece</h5>
                            <span>Formulaire de modification: Paiementespece</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('paiementespeces.update', $paiementespece->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('paiementespece.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
