@php
    $pagetitle = 'Nouveau Photo';
    $breadcrumbs = ['Liste des Photo(s)' => route('photos.index'), 'Nouveau Photo' => route('photos.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau Photo
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('photos.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : Photo</h5>
                            <span>Formulaire d'ajout d'un(e)  Photo</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('photos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('photo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
