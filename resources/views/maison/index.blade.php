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
