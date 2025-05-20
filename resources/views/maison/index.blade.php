@extends('layouts.app')

@php
    $pagetitle = 'Liste des Maison(s)';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index')];
@endphp

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col text-end">
            <a href="{{ route('maisons.create') }}" class="btn btn-sm btn-primary rounded-05">+ Ajouter une maison</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<<<<<<< HEAD
   <div class="row">
    @foreach ($maisons as $maison)
        <div class="col-md-6 mb-4">
            <div class="card shadow rounded-3 h-100 position-relative">
                {{-- Menu 3 points visible en haut à droite --}}
                <div class="position-absolute top-0 end-0 m-2 dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical fs-5"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('maisons.show', $maison->id) }}">Voir les chambres</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('maisons.edit', $maison->id) }}">Modifier</a>
                        </li>
                        <li>
=======
    <div class="row">
        @foreach ($maisons as $maison)
            <div class="col-md-4 mb-4">
                <div class="card shadow rounded-3 h-100 d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <div class="text-center mb-3">
                       <i class="ti ti-home" style="font-size: 4rem; color: #0d6efd;"></i>
                      </div>

                        <h5 class="card-title text-primary fw-bold text-center">{{ $maison->libelle }}</h5>
                        <p class="mb-1"><strong>Pays :</strong> {{ $maison->Pays }}</p>
                        <p class="mb-1"><strong>Ville :</strong> {{ $maison->ville }}</p>
                        <p class="mb-1"><strong>Quartier :</strong> {{ $maison->quartier }}</p>
                        <p class="mb-1"><strong>Adresse :</strong> {{ $maison->adresse }}</p>
                        <p class="mb-1"><strong>Gérant :</strong> {{ $maison->user->name }}</p>
                        <p class="mb-1"><strong>Moyen de paiement :</strong> {{ $maison->moyenPaiement->Designation }}</p>
                        {{-- <p class="mb-3"><strong>Jour de paiement :</strong> {{ $maison->jourPaiementLoyer }}</p> --}}
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('maisons.show', $maison->id) }}" class="btn btn-sm btn-outline-info flex-fill">Voir les chambres</a>
                            <a href="{{ route('maisons.edit', $maison->id) }}" class="btn btn-sm btn-outline-secondary flex-fill">Modifier</a>
>>>>>>> dfb8536fa9a7d12e34ed45a4be609866a473c70e
                            <form action="{{ route('maisons.destroy', $maison->id) }}" method="POST"
                                  onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
                                 @include('sweetalert')
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">Supprimer</button>
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('assets/entreprise2.png') }}" style="max-height: 200px;" class="rounded-3 mb-3">
                    </div>

                    <h5 class="card-title fw-bold text-center" style="color: #54b435">{{ $maison->libelle }}</h5>

                    <p class="mb-1 text-black"><strong>Pays :</strong> {{ $maison->Pays }}</p>
                    <p class="mb-1 text-black"><strong>Ville :</strong> {{ $maison->ville }}</p>
                    <p class="mb-1 text-black"><strong>Quartier :</strong> {{ $maison->quartier }}</p>
                    <p class="mb-1 text-black"><strong>Adresse :</strong> {{ $maison->adresse }}</p>
                    <p class="mb-1 text-black"><strong>Gérant :</strong> {{ $maison->user->name }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>


    <div class="d-flex justify-content-center mt-4">
        {!! $maisons->withQueryString()->links() !!}
    </div>
</div>
@endsection
