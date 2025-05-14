@php
    $pagetitle = 'Nouveau Paiementenattente';
    $breadcrumbs = ['Liste des Paiementenattente(s)' => route('paiementenattentes.index'), 'Nouveau Paiementenattente' => route('paiementenattentes.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Paiementenattente
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('paiementenattentes.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Paiementenattente</h5>
                            <span>Formulaire d'ajout d'un(e)  Paiementenattente</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('paiementenattentes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('paiementenattente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
