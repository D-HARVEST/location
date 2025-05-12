@php
    $pagetitle = 'Nouveau Maison';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index'), 'Nouveau Maison' => route('maisons.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Maison
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('maisons.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Maison</h5>
                            <span>Formulaire d'ajout d'un(e)  Maison</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('maisons.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('maison.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
