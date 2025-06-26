@extends('layouts.app')

@php
    $pagetitle = 'Liste des Maison(s)';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index')];
@endphp

@section('content')



@role('Super-admin')

 <style>
  .l1 {
    background-color: white;
    font-size: 1.2rem;
    font-family: sans-serif;
  }

  .nav-tabs .nav-link {
    font-weight: 400;
    /* border: 1px solid transparent; */
    transition: all 0.3s ease;
  }

  .nav-tabs .nav-link.active {
    background-color: #F3F1EDFF;
    /* border-color: #dee2e6 #dee2e6 #fff; */
    color: #1d1a1a;
  }

  .nav-tabs .nav-link:hover {
    background-color: #f1f1f1;
  }
</style>



<div class="container">
  <div class="row g-3">

    <!-- Propriétés et Chambres -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Abonnements impayés</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0 text-warning">{{ $abonnementEnAttenteHc}}</h4>

        </div>
      </div>
    </div>

  </div>

<div class="container mt-5">
  <div class="row justify-content-center">
   <div class="col-md-12">
  <!-- Onglets de navigation -->
<ul class="nav nav-tabs nav-fill w-100 rounded-1 l1 text-center  p-2"  style="background: rgba(19, 18, 18, 0.12);" >
  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#moyenspaiement">
      <iconify-icon icon="mdi:credit-card-outline" class="me-1"></iconify-icon>
      Moyens de paiement
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link  rounded-1" data-bs-toggle="tab" href="#tousproprietes">
      <iconify-icon icon="mdi:home-group" class="me-1"></iconify-icon>
      Tous les Propriétés
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link active rounded-1" data-bs-toggle="tab" href="#proprietes">
      <iconify-icon icon="mdi:alert-octagon-outline" class="me-1"></iconify-icon>
      Abonnements impayés
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#historique">
      <iconify-icon icon="mdi:history" class="me-1"></iconify-icon>
      Historique paiement d'abonnement
    </a>
  </li>
</ul>

  <!-- Contenu des onglets -->
  <div class="tab-content mt-4">

    <div class="tab-pane fade" id="moyenspaiement">
       @include('moyen-paiement.index');
    </div>

    <div class="tab-pane fade" id="tousproprietes">

          <div class="card-title text-dark fw-bolder">Tous les propriétés</div>
          <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable w-100 rounded-2">
                <thead class="thead">
                    <tr>
                        <th>Libelle</th>
                        <th>Gérant</th>
                        <th>Ville</th>
                        <th>Quartier</th>
                        <th>Pourcentage spécial</th>
                        <th>Mois de fin pourcentage spécial</th>
                        <th>Action</th>

                    </tr>
                </thead>
                 <tbody>
       @foreach($propriete as $abonnement)
        <tr>
        <td>{{ $abonnement->libelle?? '' }}</td>
        <td>{{ $abonnement->user->name ?? '' }}</td>
        <td>{{$abonnement->ville ?? ''}}</td>
        <td>{{ $abonnement->quartier ?? '' }}</td>
        <td>{{ $abonnement->pourcentage_special ?? '4' }} %</td>
        <td>{{  $abonnement->date_fin_mois ?? '-'}}</td>
        <td>

            <button type="button" class="btn btn-outline-secondary btn-sm me-2"
                data-bs-toggle="modal"
                data-bs-target="#editModal{{ $abonnement->id }}">
                <i class="ti ti-edit"></i> Modifier
            </button>

        </td>

    </tr>
       @endforeach

       @foreach($propriete as $abonnement)
<!-- Modal -->
<div class="modal fade" id="editModal{{ $abonnement->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $abonnement->id }}"   style="backdrop-filter: blur(8px)" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <form method="POST" action="{{ route('maisons.update', $abonnement->id) }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $abonnement->id }}">Modifier la maison</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body row">
          <div class="col-lg-6 form-group mb-2">
    <strong><label for="pourcentage_special_{{ $abonnement->id }}" class="form-label">Pourcentage Spécial</label></strong>

    <input
        type="range"
        name="pourcentage_special"
        id="pourcentage_special_{{ $abonnement->id }}"
        min="0"
        max="100"
        step="1"
        value="{{ old('pourcentage_special', $abonnement->pourcentage_special ?? 0) }}"
        class="form-range"
        oninput="document.getElementById('valeurPourcentage_{{ $abonnement->id }}').textContent = this.value + '%';"
    />

    <div>
        <strong><span id="valeurPourcentage_{{ $abonnement->id }}">{{ old('pourcentage_special', $abonnement->pourcentage_special ?? 0) }}%</span></strong>
    </div>
</div>


          <div class="col-lg-6 form-group mb-2">
            <strong><label for="date_fin_mois" class="form-label">Date Fin mois</label></strong>
            <input type="date" name="date_fin_mois" class="form-control"
              value="{{ old('date_fin_mois', $abonnement->date_fin_mois) }}" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary rounded-1">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach

        </tbody>
    </table>
    </div>

    </div>

     <div class="tab-pane fade" id="proprietes">
      <div class="card-title text-dark fw-bolder">Paiement de l’abonnement (4%)/mois</div>
          <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable w-100 rounded-2">
                <thead class="thead">
                    <tr>
                        <th>Gérant</th>
                        <th>Mois</th>
                        <th>Montant à payer</th>
                        <th>Statut</th>

                    </tr>
                </thead>
                 <tbody>
       @foreach($abonnementEnAttenteA as $abonnement)
        <tr>
        <td>{{ $abonnement->user->name }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $abonnement->moisPaiement)->format('F Y') }}</td>
        <td>{{ number_format($abonnement->montant, 0, ',', ' ') }} FCFA</td>
        <td>
            <span class="badge bg-warning text-dark">
                {{ $abonnement->statut }}
            </span>
        </td>

    </tr>
       @endforeach
        </tbody>
    </table>
    </div>
    </div>




     <div class="tab-pane fade" id="historique">

        <div class="card-title text-dark fw-bolder">Historique de paiement de l’abonnement (4%)/mois</div>
    <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable w-100 rounded-2">
                <thead class="thead">
                    <tr>
                        <th>Gérant</th>
                        <th>Mois</th>
                        <th>Montant à payer</th>
                        <th>Statut</th>

                    </tr>
                </thead>
                 <tbody>
       @foreach($abonnementEnAttenteH as $abonnement)
        <tr>
        <td>{{ $abonnement->user->name }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $abonnement->moisPaiement)->format('F Y') }}</td>
        <td>{{ number_format($abonnement->montant, 0, ',', ' ') }} FCFA</td>
        <td>
            <span class="badge bg-success text-dark">
                {{ $abonnement->statut }}
            </span>
        </td>

    </tr>
   @endforeach
   </tbody>
    </table>
    </div>


    </div>






  </div>
 </div>

</div>
 </div>

@endrole


























@role('gerant')


@include('maison.modal1')




 <style>
  .l1 {
    background-color: white;
    font-size: 1.2rem;
    font-family: sans-serif;
  }

  .nav-tabs .nav-link {
    font-weight: 400;
    /* border: 1px solid transparent; */
    transition: all 0.3s ease;
  }

  .nav-tabs .nav-link.active {
    background-color: #F3F1EDFF;
    /* border-color: #dee2e6 #dee2e6 #fff; */
    color: #1d1a1a;
  }

  .nav-tabs .nav-link:hover {
    background-color: #f1f1f1;
  }
</style>


<div class="container">
  <div class="row g-3">

    <!-- Propriétés et Chambres -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Propriétés</small></div>
            <i class="fas fa-building text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ $nombreMaisons ?? 0 }}</h4>

          <hr class="my-2">

          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Chambres</small></div>
            <i class="fas fa-home text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">{{ $nombreChambres ?? 0 }}</h4>

          <hr class="my-2">

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
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Revenus/mois</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">
            {{ number_format($revenusMensuels, 0, ',', ' ') }} FCFA
          </h4>
        </div>
      </div>
    </div>

    <!-- Paiements/Abonnements en attente -->
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Paiements en attente de validation</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0 text-warning">{{ $paiementespecesvalid ?? 0 }}</h4>

          <hr class="my-2">

          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Abonnements impayés</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0 text-warning">{{ $nombreAbonnementEnAttente ?? 0 }}</h4>

          <hr class="my-2">

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
<ul class="nav nav-tabs nav-fill w-100 rounded-1 l1 text-center p-2"  style="background: rgba(19, 18, 18, 0.12);" >

  <li class="nav-item">
    <a class="nav-link rounded-1 " data-bs-toggle="tab" href="#moyenspaiement">
      <iconify-icon icon="mdi:credit-card-outline" class="me-1"></iconify-icon>
      Moyens de paiement
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link active rounded-1" data-bs-toggle="tab" href="#proprietes">
      <iconify-icon icon="mdi:home-outline" class="me-1"></iconify-icon>
      Propriétés
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#locataires">
      <iconify-icon icon="mdi:account-group-outline" class="me-1"></iconify-icon>
      Locataires
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#abonnement">
      <iconify-icon icon="mdi:alert-octagon-outline" class="me-1"></iconify-icon>
      Abonnements impayés
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiementenattentev">
      <iconify-icon icon="mdi:clock-outline" class="me-1"></iconify-icon>
      Paiements en attente
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiements">
      <iconify-icon icon="mdi:history" class="me-1"></iconify-icon>
      Historiques
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#interventions">
      <iconify-icon icon="mdi:tools" class="me-1"></iconify-icon>
      Interventions
    </a>
  </li>

</ul>

  <!-- Contenu des onglets -->
  <div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="proprietes">

    @if(auth()->user()->isActive)
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
      @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
        @endif
    </div>

    <!-- Autres onglets (contenu vide pour l'exemple) -->



  <div class="tab-pane fade" id="locataires">
  @if (auth()->user()->isActive)


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
              <li>
                <a class="dropdown-item" href="{{ route('contrat.show', $location->id) }}">
                    <i class="ti ti-file-text me-1"></i>
                     Générer le contrat</a>
              </li>
              @if ($location->statut === 'CONFIRMER')
              <li>
              <button class="dropdown-item" onclick="submitStatutForm('ARCHIVER', {{ $location->id }})">
                  <i class="ti ti-circle-check me-1"></i> Désactiver
              </button>

            <form id="statut-form-{{ $location->id }}" action="{{ route('louerchambres.updateStatut', $location->id) }}" method="POST" style="display: none;">
                @csrf
                @method('PUT')
                <input type="hidden" name="statut" value="">
            </form>
             </li>
            @endif
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
            match ($location->statut) {
                'EN ATTENTE' => 'bg-warning text-dark',
                'REJETER'    => 'bg-danger',
                'ARCHIVER'   => 'bg-dark',
                default      => 'bg-secondary'
            }
        }} ms-auto">
        {{
            $location->statut === 'ARCHIVER'
                ? 'Désactivé'
                : ucfirst(strtolower($location->statut))
        }}
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
     @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
     @endif
</div>







    <div class="tab-pane fade" id="moyenspaiement">
        @if (auth()->user()->isActive)
       @include('moyen-paiement.index');
         @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
        @endif
    </div>


 <div class="tab-pane fade" id="abonnement">




    <div class="card-title text-dark fw-bolder">Paiement de l’abonnement (4%)/mois</div>
    <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover datatable w-100 rounded-2">
                <thead class="thead">
                    <tr>
                        <th>Mois</th>
                        <th>Montant à payer</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                 <tbody>
      @foreach($abonnementEnAttente as $abonnement)
        <tr>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $abonnement->moisPaiement)->format('F Y') }}</td>
        <td>{{ number_format($abonnement->montant, 0, ',', ' ') }} FCFA</td>
        <td>
            <span class="badge bg-warning text-dark">
                {{ $abonnement->statut }}
            </span>
        </td>
        <td>
            <form id="formPayer">
                @csrf
                <input type="hidden" name="abonnement_id" value="{{ $abonnement->id }}">
                <button type="button"
                        class="btn btn-success rounded-1"
                        onclick="payer(this);"
                         id="payerBtn">
                    <i class="fas fa-credit-card"></i> Payer {{ number_format($abonnement->montant, 0, ',', ' ') }} FCFA
                </button>
            </form>
        </td>
    </tr>
   @endforeach
   </tbody>
    </table>
        </div>
</div>



    <div class="tab-pane fade" id="interventions">
        @if (auth()->user()->isActive)
       @include('intervention.index');
         @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
        @endif
    </div>



    @php $i = 0; @endphp

 <div class="tab-pane fade" id="paiementenattentev">
   @if (auth()->user()->isActive)



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
      @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
        @endif
</div>

{{-- Modales de rejet, à placer en dehors de <tbody> --}}
@foreach ($paiementespeces as $paiementespece)
    @if ($paiementespece->statut == 'EN ATTENTE')
        <div class="modal fade" id="modalRejet{{ $paiementespece->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $paiementespece->id }}"   style="backdrop-filter: blur(8px)" aria-modal="true" role="dialog"   style="backdrop-filter: blur(8px)" aria-modal="true" role="dialog">
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
        @if (auth()->user()->isActive)

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
                          @else
            <div class="alert alert-danger mt-3">
                ❌ Accès refusé. Veuillez payer votre abonnement pour accéder à cette section. Merci!

            </div>
        @endif
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
    font-weight: 400;
    /* border: 1px solid transparent; */
    transition: all 0.3s ease;
  }

  .nav-tabs .nav-link.active {
    background-color: #F3F1EDFF;
    /* border-color: #dee2e6 #dee2e6 #fff; */
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
    <ul class="nav nav-tabs nav-fill w-100 rounded-1 l1 text-center p-2" style="background: rgba(19, 18, 18, 0.12);">
  <li class="nav-item">
    <a class="nav-link active rounded-1" data-bs-toggle="tab" href="#meschambres">
      <iconify-icon icon="mdi:bed-outline" class="me-1"></iconify-icon>
      Mes chambres
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#mesinterventions">
      <iconify-icon icon="mdi:tools" class="me-1"></iconify-icon>
      Mes interventions
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#paiements">
      <iconify-icon icon="mdi:history" class="me-1"></iconify-icon>
      Historiques
    </a>
  </li>

  {{--
  <li class="nav-item">
    <a class="nav-link rounded-1" data-bs-toggle="tab" href="#interventions">
      <iconify-icon icon="mdi:alert-circle-outline" class="me-1"></iconify-icon>
      Interventions
    </a>
  </li>
  --}}
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
               {{-- <li>
                <a class="dropdown-item" href="{{ route('louerchambres.edit', $location->id) }}">
                    <i class="ti ti-edit me-1"></i> Modifier
                </a>
              </li> --}}
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







@role('gerant')
@section('script')

<script>
    function submitStatutForm(statut, id) {
        const form = document.getElementById(`statut-form-${id}`);
        form.querySelector('input[name="statut"]').value = statut;
        form.submit();
    }
</script>




<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
    let fedapayKey = "{{ $clePubliqueSuperAdmin }}";



    function payer(btn) {
        if (!fedapayKey || fedapayKey.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Moyen de paiement indisponible',
                text: "Le moyen de paiement n'est pas encore actif. Veuillez contacter votre propriétaire."
            });
            return;
        }


        let form = btn.closest('form');
        let abonnementId = form.querySelector('input[name="abonnement_id"]').value;


         let montantText = btn.innerText.match(/\d+/g); // Extrait les nombres du texte
         let montant = montantText ? parseInt(montantText.join('')) : 0;

        let widget = FedaPay.init({
            public_key: fedapayKey,
            sandbox: {{ config("services.fedapay.sandbox") ? 'true' : 'false' }},
            transaction: {
                amount: montant,
                description: 'Paiement de l\'abonnement'
            },
            onComplete: (response) => {
                if (response.reason === 'CHECKOUT COMPLETE') {
                    // window.location.href = '/paiementa/' + response.transaction.id;
                     window.location.href = `/paiementa/${response.transaction.id}?abonnement_id=${abonnementId}`;
                }
            },
            onError: (error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur lors du paiement. Veuillez réessayer.'
                });
            }
        });

        widget.open({
            amount: montant,
            description: 'Paiement de l\'abonnement'
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const range = document.getElementById('pourcentage_special');
        const output = document.getElementById('valeurPourcentage');
        output.textContent = range.value + '%';
    });
</script>





@endsection

@endrole
