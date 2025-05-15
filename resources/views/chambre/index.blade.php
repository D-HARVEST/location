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



                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createChambreModal">
                                + Ajouter Chambre
                            </button>
                        </div>
                         <div class="text-end">
                            <a href="{{ route('maisons.index', $maison->chambre_id) }}" class="btn btn-sm btn-primary"> Retour</a>
                     </div>

                          {{-- <div class="text-end mb-3">
                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary">Retour</a>
                        </div> --}}

                      <div class="row  mt-4">
             @foreach ($chambres as $chambre)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <div class="bg-primary text-white p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $chambre->libelle }}</h5>
                            <small>{{ $chambre->type?->libelle ?? 'Type inconnu' }}</small>
                        </div>
                        <i class="ti ti-bed" style="font-size: 2.5rem;"></i>
                    </div>
                    <div class="card-body bg-light">
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Statut :</span>
                            @php
                                $badgeClass = $chambre->statut === 'Disponible' ? 'bg-success' : 'bg-danger';
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $chambre->statut }}</span>
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
                    <div class="card-footer bg-white border-0 d-flex justify-content-between px-3 pb-3 pt-2">
                        <a href="{{ route('chambres.show', $chambre->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('chambres.edit', $chambre->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ti ti-edit"></i>
                        </a>
                        <form action="{{ route('chambres.destroy', $chambre->id) }}" method="POST"
                             onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
                             @include('sweetalert')
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
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
