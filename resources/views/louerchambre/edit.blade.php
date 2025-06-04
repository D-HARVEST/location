@php
    $pagetitle = 'Modifier Louerchambre';
    $breadcrumbs = ['Liste des Louerchambre(s)' => route('louerchambres.index'), 'Modifier Louerchambre' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Louerchambre
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
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Louerchambre</h5>
                            <span>Formulaire de modification: Louerchambre</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('louerchambres.update', $louerchambre->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('louerchambre.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
