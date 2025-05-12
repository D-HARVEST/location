@php
    $pagetitle = 'Modifier Photo';
    $breadcrumbs = ['Liste des Photo(s)' => route('photos.index'), 'Modifier Photo' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Photo
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('photos.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Photo</h5>
                            <span>Formulaire de modification: Photo</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('photos.update', $photo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('photo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
