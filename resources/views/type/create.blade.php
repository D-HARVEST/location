@php
    $pagetitle = 'Nouveau Type';
    $breadcrumbs = ['Liste des Type(s)' => route('types.index'), 'Nouveau Type' => route('types.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Type
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('types.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Type</h5>
                            <span>Formulaire d'ajout d'un(e)  Type</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('types.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
