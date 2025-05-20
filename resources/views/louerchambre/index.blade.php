{{-- @php
    $pagetitle = 'Liste des Louerchambre(s)';
    $breadcrumbs = ['Liste des Louerchambre(s)' => route('louerchambres.index')];
@endphp

@extends('layouts.app') --}}


{{-- @section('content') --}}

@section('script')
<script>
    function submitStatutForm(statut, id) {
        document.getElementById('statut_value').value = statut;
        document.getElementById('louerchambre_id').value = id;
        document.getElementById('statutForm').submit();
    }
</script>
@endsection
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="">



                    <div class="card-body">
                      {{-- @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif --}}


                    @role('gerant')
                        <div class="d-flex justify-content-end gap-2 mb-3">
                            @if($chambre->statut == 'Disponible')
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createChambreModal">
                                    + Lier locataire à cette chambre
                                </button>
                            @endif

                            <a href="{{ route('maisons.show', $chambre->maison_id) }}" class="btn btn-sm btn-primary">
                                Retour
                            </a>
                        </div>
                    @endrole







                       <div class="row mt-4">
                @forelse ($louerchambres as $louerchambre)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100" style="border-left: 5px solid
                            @if($louerchambre->statut == 'CONFIRMER') #28a745
                            @elseif($louerchambre->statut == 'EN ATTENTE') #ffc107
                            @elseif($louerchambre->statut == 'ARCHIVER') #6c757d
                            @else #dc3545 @endif;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 text-primary">
                                            <i class="ti ti-user me-1"></i> {{ $louerchambre->user->name ?? 'Locataire inconnu' }}
                                        </h5>
                                         <p class="mb-1"><i class="ti ti-calendar me-1"></i> Chambre : {{ $louerchambre->chambre->libelle ?? '-' }}</p>
                                        <p class="mb-1"><i class="ti ti-calendar me-1"></i> Date d'entrée : {{ $louerchambre->debutOccupation ?? '-' }}</p>
                                        <p class="mb-1"><i class="ti ti-number me-1"></i> NPI(Numéro d'Identification Personnel) : {{ $louerchambre->user->npi ?? '-' }}</p>
                                        <div class="text-muted">
                                            <p class="mb-1"><strong>Prix du Loyer:</strong> {{ $louerchambre->loyer ?? '-' }} FCFA</p>
                                            <p class="mb-1"><strong>Caution Loyer:</strong> {{ $louerchambre->cautionLoyer ?? '-' }} FCFA</p>
                                            <p class="mb-1"><strong>Caution Électricité:</strong> {{ $louerchambre->cautionElectricite ?? '-' }} FCFA</p>
                                            <p class="mb-1"><strong>Caution Eau:</strong> {{ $louerchambre->cautionEau ?? '-' }} FCFA</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        @if($louerchambre->statut == 'EN ATTENTE')
                                            <span class="badge bg-warning">En attente de confirmation</span>
                                        @elseif($louerchambre->statut == 'CONFIRMER')
                                            <span class="badge bg-success">Chambre Occupée</span>
                                        @elseif($louerchambre->statut == 'ARCHIVER')
                                            <span class="badge bg-secondary">Archiver</span>
                                        @elseif($louerchambre->statut == 'REJETER')
                                            <span class="badge bg-danger">Rejeter</span>
                                        @else
                                            <span class="badge bg-secondary">Inconnu</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3">
                                    @if($louerchambre->copieContrat)
                                        <a href="{{ asset('storage/' . $louerchambre->copieContrat) }}" target="_blank" download class="btn btn-outline-success btn-sm me-2">
                                            <i class="ti ti-download me-1"></i> Télécharger contrat
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Aucun contrat disponible, Ajoutez votre contrat s'il vous plaît</span>
                                    @endif
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-4">
                                    <a href="{{ route('louerchambres.show', $louerchambre->id) }}" class="btn btn-sm btn-primary">
                                        <i class="ti ti-eye me-1"></i> Détails
                                    </a>

                                    @if(!in_array($louerchambre->statut, ['ARCHIVER', 'REJETER']))
                                        @role('locataire')
                                            <a href="{{ route('louerchambres.edit', $louerchambre->id) }}" class="btn btn-sm btn-warning">
                                                <i class="ti ti-edit me-1"></i> Ajouter votre contrat
                                            </a>
                                        @endrole

                                        @role('gerant')
                                            <a href="{{ route('louerchambres.edit', $louerchambre->id) }}" class="btn btn-sm btn-warning">
                                                <i class="ti ti-edit me-1"></i> Modifier
                                            </a>
                                        @endrole

                                        @role('gerant')
                                        @if(in_array($louerchambre->statut, ['CONFIRMER', 'EN ATTENTE']))
                                                <button class="btn btn-sm btn-secondary" onclick="submitStatutForm('ARCHIVER', {{ $louerchambre->id }})">
                                                    <i class="ti ti-circle-check me-1"></i> Archiver
                                                </button>
                                            @endif
                                        @endrole


                                        @role('locataire')
                                            @if($louerchambre->statut == 'EN ATTENTE')
                                                <button class="btn btn-sm btn-success" onclick="submitStatutForm('CONFIRMER', {{ $louerchambre->id }})">
                                                    <i class="ti ti-circle-check me-1"></i> Confirmer
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="submitStatutForm('REJETER', {{ $louerchambre->id }})">
                                                    <i class="ti ti-circle-x me-1"></i> Rejeter
                                                </button>
                                            @endif
                                        @endrole
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info w-100 text-center" style="max-width: 700px;">
                        <i class="ti ti-info-circle me-1"></i> Aucune location enregistrée pour le moment.
                    </div>
                @endforelse
            </div>

                    </div>
                </div>
                {!! $louerchambres->withQueryString()->links() !!}
            </div>
        </div>
    </div>

    <form id="statutForm" method="POST" action="{{ route('louerchambres.validate') }}">
        @csrf
        <input type="hidden" name="id" id="louerchambre_id">
        <input type="hidden" name="statut" id="statut_value">
    </form>
{{-- @endsection --}}
