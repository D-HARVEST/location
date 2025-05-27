@extends('layouts.app')

@php
    $pagetitle = 'Liste des Maison(s)';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index')];
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark m-0"></h4>
        <a href="{{ route('maisons.create') }}" class="btn btn-primary rounded-1">
            <i class="ti ti-plus me-1"></i> Ajouter une maison
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($maisons as $maison)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="position-relative">
                        <img src="{{ asset('assets/home.png') }}" class="card-img-top rounded-top-4" style="height: 250px; cover;">
                        <div class="position-absolute top-0 end-0 m-2 dropdown">
                            <button class="btn btn-sm btn-light rounded-circle shadow-sm" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('maisons.show', $maison->id) }}">
                                    <i class="ti ti-eye"></i> Voir les chambres</a>
                                <a class="dropdown-item" href="{{ route('maisons.edit', $maison->id) }}">
                                     <i class="ti ti-edit"></i>Modifier</a>

                                    <form action="{{ route('maisons.destroy', $maison->id) }}" method="POST"
                                        onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
                                        @include('sweetalert')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ti ti-trash"></i> Supprimer</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center text-success fw-bold">{{ $maison->libelle }}</h5>
                        <div class="text-muted small mb-2 text-center">Géré par : {{ $maison->user->name }}</div>
                        <ul class="list-unstyled mb-0">
                            <li><i class="ti ti-world me-2 text-primary"></i><strong>Pays :</strong> {{ $maison->Pays }}</li>
                            <li><i class="ti ti-building me-2 text-primary"></i><strong>Ville :</strong> {{ $maison->ville }}</li>
                            <li><i class="ti ti-map-pin me-2 text-primary"></i><strong>Quartier :</strong> {{ $maison->quartier }}</li>
                            <li><i class="ti ti-home me-2 text-primary"></i><strong>Adresse :</strong> {{ $maison->adresse }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucune maison enregistrée pour le moment.</div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {!! $maisons->withQueryString()->links() !!}
    </div>
</div>
@endsection
