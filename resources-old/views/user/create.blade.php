@php
    $pagetitle = 'Nouveau User';
    $breadcrumbs = ['Liste des User(s)' => route('users.index'), 'Nouveau User' => route('users.create')];
@endphp
@extends('layouts.app')

@section('template_title')
    Nouveau User
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default  border">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Nouveau : User</h5>
                            <span>Formulaire d'ajout d'un(e)  User</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('user.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
