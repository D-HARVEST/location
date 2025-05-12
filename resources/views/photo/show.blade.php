@php
    $pagetitle = 'Détails Photo';
    $breadcrumbs = ['Liste des Photo' => route('photos.index'), 'Détails Photo' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Photo
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('photos.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Chambre Id:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $photo->chambre_id }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Url:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $photo->url }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
