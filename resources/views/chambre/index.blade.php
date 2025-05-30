{{-- @php
    $pagetitle = 'Liste des Chambre(s)';
    $breadcrumbs = ['Liste des Chambre(s)' => route('chambres.index')];
@endphp

@extends('layouts.app') --}}


{{-- @section('content') --}}
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="">



                    <div class="card-body">
                      @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif



                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button type="button" class="btn btn-sm btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#createChambreModal"
                            >
                                + Ajouter Chambre
                            </button>
                            <a href="{{ route('maisons.index', $maison->chambre_id) }}" class="btn btn-sm btn-primary">
                                Retour
                            </a>
                        </div>

                          {{-- <div class="text-end mb-3">
                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary">Retour</a>
                        </div> --}}

    <div class="row mt-4">
        @foreach ($chambres as $chambre)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">
                <div class="card-body position-relative">
                    {{-- Bouton menu (3 points) --}}
                    <div class="dropdown position-absolute top-0 end-0 m-2">
                        <a class="text-muted" href="#" role="button" id="dropdownMenu{{ $chambre->id }}"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $chambre->id }}">
                            <li>
                                <a href="{{ route('chambres.show', $chambre->id) }}" class="dropdown-item">
                                    <i class="ti ti-eye"></i> Détails
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('chambres.edit', $chambre->id) }}" class="dropdown-item">
                                    <i class="ti ti-edit"></i> Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('chambres.destroy', $chambre->id) }}" method="POST"
                                       onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
                                                @include('sweetalert')
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="ti ti-trash"></i> Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    {{-- Informations chambre --}}
                    <h5 class="mb-1">{{ $chambre->libelle }}</h5>
                    <small class="text-muted">{{ $chambre->type?->libelle ?? 'Type inconnu' }}</small>
                    <hr>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Statut :</span>
                        <span class="badge {{ $chambre->statut === 'Disponible' ? 'bg-success' : 'bg-danger' }}">
                            {{ $chambre->statut }}
                        </span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Jour paiement :</span>
                        <span>{{ $chambre->jourPaiementLoyer }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Loyer :</span>
                        <span class="fw-bold text-dark">{{ number_format($chambre->loyer, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="text-muted">Catégorie :</span>
                        <span>{{ $chambre->category?->libelle ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
          @endforeach
   </div>


                    </div>
                </div>
                {!! $chambres->withQueryString()->links() !!}
            </div>
        </div>
    </div>
{{-- @endsection --}}
