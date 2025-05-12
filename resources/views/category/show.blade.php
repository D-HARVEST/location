@php
    $pagetitle = 'Détails Category';
    $breadcrumbs = ['Liste des Category' => route('categories.index'), 'Détails Category' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  Category
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Libelle:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $category->libelle }}"
                                readonly>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
