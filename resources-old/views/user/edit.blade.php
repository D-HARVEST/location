@php
    $pagetitle = 'Modifier User';
    $breadcrumbs = ['Liste des User(s)' => route('users.index'), 'Modifier User' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: User
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mettre à jour User</h5>
                            <span>Formulaire de modification: User</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('user.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
