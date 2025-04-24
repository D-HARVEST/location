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
                        <div class="row">

                            

                        <div class="col-lg-4">
                            <strong class="text-dark ">Name:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $user->name }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Email:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $user->email }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Password:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $user->password }}"
                                readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark ">Last Login At:</strong>
                            <input type="text" class="form-control rounded-05 my-1 text-dark" value="{{ $user->last_login_at }}"
                                readonly>
                        </div>

                        <hr>
                            <div class="col-12">
                                <strong class="text-dark ">Roles:</strong>


                                <form action="{{ route('users.storeRole', $user->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                        @foreach ($allRoles as $role)
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch py-2 align-items-center ">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="role-{{ $role->id }}" value="{{ $role->id }}"
                                                        name="roles[]" @if (in_array($role->name, $myRoles)) checked @endif>
                                                    <label class="form-check-label text-dark fs-5 ms-2 text-capitalize "
                                                        for="role-{{ $role->id }}">
                                                        {{ $role->name }}

                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12">
                                            <button class="btn btn-success mt-4 fw-semibold  rounded-1">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
