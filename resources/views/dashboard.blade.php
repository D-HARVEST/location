

@extends('layouts.app')

@php
    $pagetitle = 'Liste des Maison(s)';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index')];
@endphp

@section('content')

@role('gerant')

@include('maison.modal1')




 <style>
  .l1 {
    background-color: white;
    font-size: 1.2rem;
    font-family: sans-serif;
  }

  .nav-tabs .nav-link {
    font-weight: 500;
    border: 1px solid transparent;
    transition: all 0.3s ease;
  }

  .nav-tabs .nav-link.active {
    background-color: #f8f9fa;
    border-color: #dee2e6 #dee2e6 #fff;
    color: #1d1a1a;
  }

  .nav-tabs .nav-link:hover {
    background-color: #f1f1f1;

  }
</style>


<div class="container">
  <div class="row mb-4">

    <!-- Propriétés -->
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Propriétés</small></div>
            <i class="fas fa-building text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ $nombreMaisons ?? 0 }}</h4>

           <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Chambres</small></div>
            <i class="fas fa-home text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ $nombreChambres ?? 0 }}</h4>
          
        </div>
      </div>
    </div>

    <!-- Chambres -->
    {{-- <div class="col-6 col-md-4 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">

         
        </div>

      </div>
    </div> --}}

    <!-- Occupées -->
    <div class="col-6 col-md-4 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Occupées</small></div>
            <i class="fas fa-user-friends text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1">{{ $nombreOccupations ?? 0 }}</h4>
          <small class="text-muted">sur {{ $nombreChambres ?? 0 }} chambres</small>
        </div>
      </div>
    </div>

    <!-- Revenus/mois -->
    <div class="col-6 col-md-6 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Revenus/mois</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ number_format($revenusMensuels, 0, ',', ' ' )  }} FCFA</h4>
        </div>
      </div>
    </div>


     <!-- Revenus/mois -->
    <div class="col-6 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Paiement en attente de validation</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0"><span class="text-warning">{{ $paiementespecesvalid ?? 0 }}</span></h4>
        </div>
      </div>
    </div>

    <!-- Interventions -->
    <div class="col-6 col-md-6 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Interventions</small></div>
            <i class="fas fa-cog text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1 text-warning">{{ $interventionsEnAttente ?? 0 }}</h4>
          <small class="text-muted">en attente</small>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="container mt-5">
  <div class="row justify-content-center">
   <div class="col-md-12">
  <!-- Onglets de navigation -->
      <ul class="nav nav-tabs nav-fill w-100 rounded-1 l1 text-center">
        <li class="nav-item">
           <a class="nav-link rounded-1 "  data-bs-toggle="tab" href="#moyenspaiement" >Moyens de paiement</a>
         </li>

         <li class="nav-item">
           <a class="nav-link  active rounded-1 "  data-bs-toggle="tab" href="#proprietes" >Propriétés</a>
         </li>
         <li class="nav-item">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#locataires">Locataires</a>
         </li>
         <li class="nav-item">
        <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiementenattentev">Paiements en attente de validation</a>
         </li>
         <li class="nav-item">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiements">Paiements</a>
         </li>
         <li class="nav-item ">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#interventions">Interventions</a>
         </li>
       </ul>

  <!-- Contenu des onglets -->
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="proprietes">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4>Mes Propriétés</h4>
          <small class="text-muted">Gérez vos maisons et chambres</small>
        </div>
         <a href="{{ route('maisons.create') }}" class="btn rounded-1 text-white" style="background-color: #00B86B;">
             <i class="ti ti-plus me-1"></i> Ajouter une propriété
        </a>
      </div>

  @forelse ($maisons as $maison)
  <div class="card mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-1"><i class="bi bi-building me-1 text-primary"></i> {{ $maison->libelle }}</h5>
        <small class="text-muted"><i class="ti ti-building me-2 text-primary"></i> {{ $maison->ville }}</small>,
        <small class="text-muted"><i class="ti ti-map-pin me-2 text-primary"></i> {{ $maison->quartier }}</small>,
        <small class="text-muted"><i class="ti ti-home me-2 text-primary"></i>{{ $maison->adresse }}</small>
      </div>
      <div class="text-end d-flex flex-wrap align-items-center justify-content-end gap-2">
        <span class="badge rounded-pill bg-light text-dark border me-3">6/8 occupées</span>
        <a id="toggleBtn{{ $maison->id }}" class="btn btn-outline-secondary btn-sm me-1" data-bs-toggle="collapse"
             href="#collapseMaison{{ $maison->id }}" role="button" aria-expanded="false" 
             aria-controls="collapseMaison{{ $maison->id }}">
         <i class="ti ti-eye"></i> Voir chambres
        </a>

        <a class="btn btn-outline-secondary btn-sm me-2" href="{{ route('maisons.edit', $maison->id) }}">
          <i class="ti ti-edit"></i>Modifier
        </a>
         <form action="{{ route('maisons.destroy', $maison->id) }}" method="POST"
             onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
             @include('sweetalert')
             @csrf
             @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm me-2">
                <i class="ti ti-trash"></i> Supprimer</button>
        </form>
      </div>
    </div>


    <!-- Collapse associé à cette maison -->
  <div class="collapse" id="collapseMaison{{ $maison->id }}">
  <div class="d-flex justify-content-end gap-2 mb-3 px-3">


 <a class="btn btn-success btn-sm me-1" href="{{ route('chambres.create', ['maison_id' => $maison->id]) }}">
          <i class="ti ti-plus"></i> Ajouter Chambre
        </a>
         </div>
           @include('maison.show')

    </div>
  </div>
@empty
  <div class="col-12">
    <div class="alert alert-info text-center">Aucune maison enregistrée pour le moment.</div>
  </div>
@endforelse
     <div class="collapse" id="collapseExample">
       <div class="card card-body">
        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
       </div>
     </div>
    </div>

    <!-- Autres onglets (contenu vide pour l'exemple) -->



  <div class="tab-pane fade" id="locataires">
      <div class="row">
         @forelse ($louerChambres as $location)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm p-3 h-100 position-relative">
        <div class="dropdown position-absolute top-0 end-0 m-2">
              <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
              </button>
            <ul class="dropdown-menu">
               {{-- <li>
                <a class="dropdown-item" href="{{ route('louerchambres.edit', $location->id) }}">
                    <i class="ti ti-file-plus me-1"></i> Ajouter votre contrat
                </a>
              </li> --}}
               <li>
                <a class="dropdown-item" href="{{ route('louerchambres.edit', $location->id) }}">
                    <i class="ti ti-edit me-1"></i> Modifier
                </a>
              </li>
              {{-- <li>
                <button class="btn btn-sm btn-secondary" onclick="submitStatutForm('ARCHIVER', {{ $louerchambre->id }})">
                    <i class="ti ti-circle-check me-1"></i> Archiver
                </button>
              </li> --}}
          </ul>
        </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="bg-light rounded-circle p-2 me-2">
                        <i class="ti ti-user" style="font-size: 1.5rem; color: #6c757d;"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">{{ optional($location->user)->name ?? 'Locataire non assigné' }}</h5>
                        @role('gerant')
                        <small class="text-muted "> <span class="text-success">Ref: {{ $location->chambre->ref }} </span></small>
                        @endrole
                    </div>
                   @if ($location->statut !== 'CONFIRMER')
                    <span class="badge mt-5
                        {{
                            $location->statut === 'EN ATTENTE' ? 'bg-warning text-dark' :
                            ($location->statut === 'REJETER' ? 'bg-danger' : 'bg-secondary')
                        }} ms-auto">
                        {{ ucfirst(strtolower($location->statut)) }}
                    </span>
                   @endif
                </div>
                <ul class="list-unstyled mb-3">
                    <li class="mb-1">
                        <i class="ti ti-mail me-2"></i>
                        {{ optional($location->user)->email ?? 'Aucun email' }}
                    </li>
                    <li class="mb-1">
                        <i class="ti ti-phone me-2"></i>
                        {{ optional($location->user)->phone ?? 'Aucun téléphone' }}
                    </li>
                    <li>
                        <i class="ti ti-home me-2"></i>
                        {{ $location->chambre->maison->libelle ?? 'Maison inconnue' }},
                        {{ $location->chambre->libelle ?? 'Ville inconnue' }}
                    </li>
                </ul>
               
    <div class="mt-3">
        @if($location->copieContrat)
            <a href="{{ asset('storage/' . $location->copieContrat) }}" target="_blank" download class="btn btn-outline-success btn-sm me-2">
                <i class="ti ti-download me-1"></i> Télécharger contrat
            </a>
        @else
            <span class="badge bg-secondary">Aucun contrat disponible</span>
        @endif
    </div>


                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted">Loyer mensuel</div>
                        <div class="fw-bold">{{ number_format($location->loyer, 0, ',', ' ') }} FCFA</div>
                    </div>
                    <div>
                        <div class="text-muted">Début occupation</div>
                        <div>{{ $location->debutOccupation }}</div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ route('louerchambres.show', $location->id) }}" class="btn btn-outline-dark w-100 rounded-1">
                        <i class="ti ti-eye me-2"></i> Voir détails
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Aucune location enregistrée pour le moment.</div>
        </div>
    @endforelse
   </div>
</div>



    <div class="tab-pane fade" id="moyenspaiement">   
       @include('moyen-paiement.index');
    </div>

    <div class="tab-pane fade" id="interventions">   
       @include('intervention.index');
    </div>



    @php $i = 0; @endphp

<div class="tab-pane fade" id="paiementenattentev">   
    <div class="card-title text-dark fw-bolder">Paiements en espèces</div>
    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-hover datatable w-100">
            <thead class="thead">
                <tr>
                    <th>N°</th>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>Date</th>
                    {{-- <th>Date de Reception</th> --}}
                    <th>Mois</th>
                    @role('gerant')
                        <th>Locataire</th>
                    @endrole
                    <th>Observation</th>
                    <th>Statut</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paiementespeces as $paiementespece)
                    @if ($paiementespece->statut != 'CONFIRMER')
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $paiementespece->Motif }}</td>
                            <td>{{ $paiementespece->Montant }}</td>
                            <td>{{ $paiementespece->Date }}</td>
                            {{-- <td>{{ $paiementespece->DateReception }}</td> --}}
                            <td>
                                @php
                                    \Carbon\Carbon::setLocale('fr');
                                    $moisArray = is_array($paiementespece->moisPayes)
                                        ? $paiementespece->moisPayes
                                        : json_decode($paiementespece->moisPayes, true);
                                @endphp
                                @if ($moisArray)
                                    @foreach ($moisArray as $mois)
                                        {{ ucfirst(\Carbon\Carbon::parse($mois)->translatedFormat('F Y')) }}<br>
                                    @endforeach
                                @endif
                            </td>
                            @role('gerant')
                                <td>
                                    {{ $paiementespece->louerchambre->user->name ?? '-' }} /
                                    {{ $paiementespece->louerchambre->chambre->libelle ?? '-' }} /
                                    {{ $paiementespece->louerchambre->chambre->maison->libelle ?? '-' }}
                                </td>
                            @endrole
                            <td>{{ $paiementespece->observation ?? '-' }}</td>
                            <td>
                                @if ($paiementespece->statut == 'EN ATTENTE')
                                    <span class="badge bg-warning text-dark">{{ $paiementespece->statut }}</span>
                                @elseif ($paiementespece->statut == 'CONFIRMER')
                                    <span class="badge bg-success text-dark">{{ $paiementespece->statut }}</span>
                                @elseif ($paiementespece->statut == 'REJETER')
                                    <span class="badge bg-danger text-dark">{{ $paiementespece->statut }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="javascript:void(0)" class="text-muted" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical fs-5"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.show', $paiementespece->id) }}">
                                                <i class="fs-4 ti ti-eye"></i> Détails
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.edit', $paiementespece->id) }}">
                                                <i class="fs-4 ti ti-edit"></i> Modifier
                                            </a>
                                        </li> --}}
                                        @role('locataire')
                                            <li>
                                                <form action="{{ route('paiementespeces.destroy', $paiementespece->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-3">
                                                        <i class="fs-4 ti ti-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            </li>
                                        @endrole
                                        @role('gerant')
                                            @if ($paiementespece->statut == 'EN ATTENTE')
                                                <li>
                                                    <form action="{{ route('paiementespeces.changerStatut', $paiementespece->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="statut" value="CONFIRMER">
                                                        <button type="submit" class="dropdown-item text-success d-flex align-items-center gap-3" style="border:none; background:none;">
                                                            <i class="ti ti-circle-check me-1"></i> Confirmer
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item text-danger d-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#modalRejet{{ $paiementespece->id }}">
                                                        <i class="ti ti-circle-x me-1"></i> Rejeter
                                                    </button>
                                                </li>
                                            @endif
                                        @endrole
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modales de rejet, à placer en dehors de <tbody> --}}
@foreach ($paiementespeces as $paiementespece)
    @if ($paiementespece->statut == 'EN ATTENTE')
        <div class="modal fade" id="modalRejet{{ $paiementespece->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $paiementespece->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('paiementespeces.changerStatut', $paiementespece->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="statut" value="REJETER">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $paiementespece->id }}">Motif du rejet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="motif_rejet{{ $paiementespece->id }}" class="form-label">Veuillez indiquer le motif du rejet :</label>
                                <textarea name="motif_rejet" id="motif_rejet{{ $paiementespece->id }}" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-success">Confirmer le rejet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endforeach



    <div class="tab-pane fade" id="paiements">
                 
           <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover datatable w-100">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>
                                        <th>Locataires</th>
                                        <th>Maison/chambre</th>
                                        <th >Date de paiement</th>
                                        <th >Quittance</th>
                                        <th >Montant</th>
                                        <th >Mode de paiement</th>
                                        <th >Mois de paiement</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @isset($historiquesPaiement)
                                    @foreach ($historiquesPaiement as $historiquepaiement)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                        <td >{{ $historiquepaiement->user->name }}</td>
                                       <td >{{ $historiquepaiement->datePaiement }}</td>
                                       <td >{{ $historiquepaiement->louerchambre->chambre->maison->libelle  ?? 'Non défini'}}, {{ $historiquepaiement->louerchambre->chambre->libelle  ?? 'Non défini'}}</td>
                                       <td>
                                  @if($historiquepaiement->quittanceUrl)
                                      <a href="{{ $historiquepaiement->quittanceUrl }}" target="_blank" download class="btn btn-sm btn-success">
                                          Télécharger la quittance
                                      </a>
                                  @elseif($historiquepaiement->modePaiement == 'Espece')
                                       <a href="{{ route('paiementespeces.facture', $historiquepaiement->idTransaction) }}"
                                        target="_blank" download class="btn btn-sm btn-success">
                                         Télécharger la facture
                                       </a>

                                  @else 
                                      <span class="badge bg-danger">
                                          Aucune quittance
                                      </span>
                                     @endif
                                 </td>

                                        <td >{{ $historiquepaiement->montant }}</td>
                                        <td >{{ $historiquepaiement->modePaiement }}</td>
                                       <td>
                                            @if(!empty($historiquepaiement) && !empty($historiquepaiement->moisPaiement))
                                                @php
                                                    $moisArray = json_decode($historiquepaiement->moisPaiement, true);
                                                @endphp
                                                @if(is_array($moisArray))
                                                    @foreach($moisArray as $mois)
                                                        {{ \Carbon\Carbon::parse($mois)->locale('fr')->translatedFormat('F Y') }}<br>
                                                    @endforeach
                                                @else
                                                    {{ \Carbon\Carbon::parse($historiquepaiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>

                                    {{-- <td>{{ \Carbon\Carbon::create()->month($historiquepaiement->moisPaiement)->locale('fr')->monthName }}</td> --}}

                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0)" class="text-muted show" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="true">
                                                        <i class="ti ti-dots-vertical fs-5"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-20px, 1.6px, 0px);"
                                                        data-popper-placement="left-start">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.show',$historiquepaiement->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i> Détails
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.edit',$historiquepaiement->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Ajouter le mois de paiement
                                                            </a>
                                                        </li> --}}
                                                        {{-- <li>
                                                            <form action="{{ route('historiquepaiements.destroy',$historiquepaiement->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>

                                                        </li> --}}
                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('historiquepaiements.show',$historiquepaiement->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('historiquepaiements.edit',$historiquepaiement->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('historiquepaiements.destroy',$historiquepaiement->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"><i class="fa fa-fw fa-trash"></i> {{ __('Supprimer') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    @else
                                        <tr><td colspan="6">Aucun historique de paiement</td></tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
   </div>

  </div>
 </div>

</div>
 </div>

@endrole


































@role('locataire')

@include('louerchambre.forch')
 <style>
  .l1 {
    background-color: white;
    font-size: 1.2rem;
    font-family: sans-serif;
  }

  .nav-tabs .nav-link {
    font-weight: 500;
    border: 1px solid transparent;
    transition: all 0.3s ease;
  }

  .nav-tabs .nav-link.active {
    background-color: #f8f9fa;
    border-color: #dee2e6 #dee2e6 #fff;
    color: #1d1a1a;
  }

  .nav-tabs .nav-link:hover {
    background-color: #f1f1f1;

  }
</style>


<div class="container">
  <div class="row g-3">

    <!-- Propriétés -->
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Mes chambres</small></div>
            <i class="fas fa-building text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ $chambreCount }}</h4>
        </div>
      </div>
    </div>


    <!-- Loyer/mois -->
    <div class="col-6 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Loyer mensuel</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ number_format($loyerMensuel, 0, ',', ' ') }} FCFA</h4>
        </div>
      </div>
    </div>

     <!-- retart -->
    {{-- <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Prochain(s) paiement(s)</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1">{{ $prochainPaiement ? $prochainPaiement->datePaiement->format('d/m/Y') : '—' }}</h4>
         </div>
      </div>
    </div> --}}



    <!-- retart -->
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Paiement(s) en retard</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1"> <span style="color: red">{{ $paiementsEnRetard }}</span></h4>
         </div>
      </div>
    </div>


    <!-- Interventions -->
    <div class="col-6 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Interventions</small></div>
            <i class="fas fa-cog text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1 text-warning">{{ $interventionsEnAttente }}</h4>
          <small class="text-muted">en attente</small>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="container mt-5">
  <div class="row justify-content-center">
   <div class="col-md-12">
  <!-- Onglets de navigation -->
      <ul class="nav nav-tabs nav-fill w-100 rounded-1 l1 text-center">
         <li class="nav-item">
           <a class="nav-link active rounded-1 "  data-bs-toggle="tab" href="#meschambres" >Mes chambres</a>
         </li>
         <li class="nav-item">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#mesinterventions">Mes interventions</a>
         </li>
         <li class="nav-item">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiements">Hitoriques</a>
         </li>
         {{-- <li class="nav-item ">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#interventions">Interventions</a>
         </li> --}}
       </ul>

  <!-- Contenu des onglets -->
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="meschambres">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4>Mes chambres</h4>
          <small class="text-muted">Gérez vos chambres</small>
        </div>
         <button type="button" class="btn rounded-1 text-white" style="background-color: #00B86B;" data-bs-toggle="modal" data-bs-target="#modalLouerChambre">
          <i class="ti ti-plus me-1"></i> Louer une chambre
         </button>

      </div>


      <div class="row">
       @forelse ($louerChambres as $location)
        <div class="col-md-6 col-lg-4 mb-4">
        <div class="card shadow-sm p-3 h-100 position-relative">
        <div class="dropdown position-absolute top-0 end-0 m-2">
              <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
              </button>
            <ul class="dropdown-menu">
               <li>
                <a class="dropdown-item" href="{{ route('louerchambres.edit', $location->id) }}">
                    <i class="ti ti-file-plus me-1"></i> Ajouter votre contrat
                </a>
              </li>
               <li>
                <a class="dropdown-item" href="{{ route('louerchambres.edit', $location->id) }}">
                    <i class="ti ti-edit me-1"></i> Modifier
                </a>
              </li>
          </ul>
        </div>

                <div class="d-flex align-items-center mb-2">
                    <div class="bg-light rounded-circle p-2 me-2">
                        <i class="ti ti-user" style="font-size: 1.5rem; color: #6c757d;"></i>
                    </div>
                    <div class="">
                        <h5 class="mb-0">{{ optional($location->user)->name ?? 'Locataire non assigné' }}</h5>
                        @role('gerant')
                        <small class="text-muted">{{ $location->chambre->ref }}</small>
                        @endrole
                    </div>
                    @if ($location->statut !== 'CONFIRMER')
                    <span class="badge mt-5
                        {{
                            $location->statut === 'EN ATTENTE' ? 'bg-warning text-dark' :
                            ($location->statut === 'REJETER' ? 'bg-danger' : 'bg-secondary')
                        }} ms-auto">
                        {{ ucfirst(strtolower($location->statut)) }}
                    </span>
                   @endif
                </div>
                <ul class="list-unstyled mb-3">
                    <li class="mb-1">
                        <i class="ti ti-mail me-2"></i>
                        {{ optional($location->user)->email ?? 'Aucun email' }}
                    </li>
                    <li class="mb-1">
                        <i class="ti ti-phone me-2"></i>
                        {{ optional($location->user)->phone ?? 'Aucun téléphone' }}
                    </li>
                    <li>
                        <i class="ti ti-home me-2"></i>
                        {{ $location->chambre->maison->libelle ?? 'Maison inconnue' }},
                        {{ $location->chambre->libelle ?? 'Ville inconnue' }}
                    </li>
                </ul>

               
    <div class="mt-3">
        @if($location->copieContrat)
            <a href="{{ asset('storage/' . $location->copieContrat) }}" target="_blank" download class="btn btn-outline-success btn-sm me-2">
                <i class="ti ti-download me-1"></i> Télécharger contrat
            </a>
        @else
            <span class="badge bg-secondary">Aucun contrat disponible</span>
        @endif
    </div>
    
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted">Loyer mensuel</div>
                        <div class="fw-bold">{{ number_format($location->loyer, 0, ',', ' ') }} FCFA</div>
                    </div>
                    <div>
                        <div class="text-muted">Début occupation</div>
                        <div>{{ $location->debutOccupation }}</div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <a href="{{ route('louerchambres.show', $location->id) }}" class="btn btn-outline-dark w-100 rounded-1">
                        <i class="ti ti-eye me-2"></i> Voir détails
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Aucune location enregistrée pour le moment.</div>
        </div>
    @endforelse
</div>


     <div class="collapse" id="collapseExample">
       <div class="card card-body">
        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
       </div>
     </div>
    </div>

    <!-- Autres onglets (contenu vide pour l'exemple) -->
 <div class="tab-pane fade" id="mesinterventions">
       @include('intervention.index');
 </div>


    <div class="tab-pane fade" id="paiements">
                  <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover datatable w-100 ">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>
                                        <th >Date de paiement</th>
                                        <th >Quittance</th>
                                        <th >Montant</th>
                                        <th >Mode de paiement</th>
                                        <th >Mois de paiement</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @isset($historiquesPaiement)
                                    @foreach ($historiquesPaiement as $historiquepaiement)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                        <td >{{ $historiquepaiement->datePaiement }}</td>
                                       <td>
                                  @if($historiquepaiement->quittanceUrl)
                                      <a href="{{ $historiquepaiement->quittanceUrl }}" target="_blank" download class="btn btn-sm btn-success">
                                          Télécharger la quittance
                                      </a>
                                  @elseif($historiquepaiement->modePaiement == 'Espece')
                                       <a href="{{ route('paiementespeces.facture', $historiquepaiement->idTransaction) }}"
                                        target="_blank" download class="btn btn-sm btn-success">
                                         Télécharger la facture PDF
                                       </a>

                                  @else
                                      <span class="badge bg-danger">
                                          Aucune quittance
                                      </span>
                                     @endif
                                 </td>

                                        <td >{{ $historiquepaiement->montant }}</td>
                                        <td >{{ $historiquepaiement->modePaiement }}</td>
                                       <td>
                                            @if(!empty($historiquepaiement) && !empty($historiquepaiement->moisPaiement))
                                                @php
                                                    $moisArray = json_decode($historiquepaiement->moisPaiement, true);
                                                @endphp
                                                @if(is_array($moisArray))
                                                    @foreach($moisArray as $mois)
                                                        {{ \Carbon\Carbon::parse($mois)->locale('fr')->translatedFormat('F Y') }}<br>
                                                    @endforeach
                                                @else
                                                    {{ \Carbon\Carbon::parse($historiquepaiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>

                                    {{-- <td>{{ \Carbon\Carbon::create()->month($historiquepaiement->moisPaiement)->locale('fr')->monthName }}</td> --}}

                                            <td>
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0)" class="text-muted show" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="true">
                                                        <i class="ti ti-dots-vertical fs-5"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-20px, 1.6px, 0px);"
                                                        data-popper-placement="left-start">
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.show',$historiquepaiement->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i> Détails
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.edit',$historiquepaiement->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Ajouter le mois de paiement
                                                            </a>
                                                        </li> --}}
                                                        {{-- <li>
                                                            <form action="{{ route('historiquepaiements.destroy',$historiquepaiement->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>

                                                        </li> --}}
                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('historiquepaiements.show',$historiquepaiement->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('historiquepaiements.edit',$historiquepaiement->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('historiquepaiements.destroy',$historiquepaiement->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"><i class="fa fa-fw fa-trash"></i> {{ __('Supprimer') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    @else
                                        <tr><td colspan="6">Aucun historique de paiement</td></tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>




    <div class="tab-pane fade" id="interventions">
      <p>Contenu des interventions...</p>
    </div>
  </div>
</div>

  </div>
  </div>
@endrole
@endsection



