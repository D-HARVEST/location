@php
    $pagetitle = 'Nouveau Louerchambre';
    $breadcrumbs = ['Liste des Louerchambre(s)' => route('louerchambres.index'), 'Nouveau Louerchambre' => route('louerchambres.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Louerchambre
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Louerchambre</h5>
                            <span>Formulaire d'ajout d'un(e)  Louerchambre</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('louerchambres.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('louerchambre.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
