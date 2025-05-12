@php
    $pagetitle = 'Nouveau Category';
    $breadcrumbs = ['Liste des Category(s)' => route('categories.index'), 'Nouveau Category' => route('categories.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Category
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Category</h5>
                            <span>Formulaire d'ajout d'un(e)  Category</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('categories.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('category.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
