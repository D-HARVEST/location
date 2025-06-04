@php
    $pagetitle = 'Nouveau Intervention';
    $breadcrumbs = ['Liste des Intervention(s)' => route('interventions.index'), 'Nouveau Intervention' => route('interventions.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Intervention
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Intervention</h5>
                            <span>Formulaire d'ajout d'un(e)  Intervention</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('interventions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('intervention.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
