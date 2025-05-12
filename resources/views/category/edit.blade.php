@php
    $pagetitle = 'Modifier Category';
    $breadcrumbs = ['Liste des Category(s)' => route('categories.index'), 'Modifier Category' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Category
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Category</h5>
                            <span>Formulaire de modification: Category</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('categories.update', $category->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('category.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
