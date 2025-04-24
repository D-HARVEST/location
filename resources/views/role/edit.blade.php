@php
    $pagetitle = 'Modifier Role';
    $breadcrumbs = ['Liste des Role(s)' => route('roles.index'), 'Modifier Role' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Role
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour Role</h5>
                            <span>Formulaire de modification: Role</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('roles.update', $role->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('role.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
