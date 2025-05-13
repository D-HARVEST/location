@php
    $pagetitle = 'Modifier Paiementenattente';
    $breadcrumbs = ['Liste des Paiementenattente(s)' => route('paiementenattentes.index'), 'Modifier Paiementenattente' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Paiementenattente
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('paiementenattentes.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Paiementenattente</h5>
                            <span>Formulaire de modification: Paiementenattente</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('paiementenattentes.update', $paiementenattente->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('paiementenattente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
