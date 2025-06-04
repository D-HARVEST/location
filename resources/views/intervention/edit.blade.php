@php
    $pagetitle = 'Modifier Intervention';
    $breadcrumbs = ['Liste des Intervention(s)' => route('interventions.index'), 'Modifier Intervention' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Intervention
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
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Intervention</h5>
                            <span>Formulaire de modification: Intervention</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('interventions.update', $intervention->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('intervention.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
