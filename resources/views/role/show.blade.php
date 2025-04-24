@php
    $pagetitle = 'Détails Role';
    $breadcrumbs = ['Liste des Role' => route('roles.index'), 'Détails Role' => ''];
@endphp

@extends('layouts.app')

@section('template_title')
    Détails Role
@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary"> Retour</a>
                        </div>
                        <div class="row">



                            <div class="col-lg-4">
                                <strong class="text-dark ">Name:</strong>
                                <input type="text" class="form-control rounded-05 my-1 text-dark"
                                    value="{{ $role->name }}" readonly>
                            </div>



                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-dark ">Permissions:</h4>
                                <form action="{{ route('roles.storePermissions', $role->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                        @foreach ($allPermissions as $permission)
                                            <div class="col-lg-6">
                                                <div class="form-check form-switch py-2 align-items-center ">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="permission-{{ $permission->id }}"
                                                        value="{{ $permission->name }}" name="permissions[]"
                                                        @if (in_array($permission->id, $rolePermissions)) checked @endif>
                                                    <label class="form-check-label text-dark fs-5 ms-2 text-capitalize "
                                                        for="permission-{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                        {{-- <h5 class="text-dark">

                                                    </h5> --}}
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
