@php
    $pagetitle = 'Détails User';
    $breadcrumbs = ['Liste des User' => route('users.index'), 'Détails User' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails  User
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                     <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>

                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
