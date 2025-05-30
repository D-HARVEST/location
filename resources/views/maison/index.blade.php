@extends('layouts.app')

@php
    $pagetitle = 'Liste des Maison(s)';
    $breadcrumbs = ['Liste des Maison(s)' => route('maisons.index')];
@endphp

@section('content')

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
  <div class="row g-3">

    <!-- Propriétés -->
    <div class="col-6 col-md-4 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Propriétés</small></div>
            <i class="fas fa-building text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">5</h4>
        </div>
      </div>
    </div>

    <!-- Chambres -->
    <div class="col-6 col-md-4 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Chambres</small></div>
            <i class="fas fa-home text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">23</h4>
        </div>
      </div>
    </div>

    <!-- Occupées -->
    <div class="col-6 col-md-4 col-lg-2">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Occupées</small></div>
            <i class="fas fa-user-friends text-muted"></i>
          </div>
          <h4 class="mt-2 mb-1">18</h4>
          <small class="text-muted">sur 23 chambres</small>
        </div>
      </div>
    </div>

    <!-- Revenus/mois -->
    <div class="col-6 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div><small class="text-muted">Revenus/mois</small></div>
            <i class="fas fa-credit-card text-muted"></i>
          </div>
          <h4 class="mt-2 mb-0">2 850 000 FCFA</h4>
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
          <h4 class="mt-2 mb-1 text-warning">3</h4>
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
           <a class="nav-link active rounded-1 "  data-bs-toggle="tab" href="#proprietes" >Propriétés</a>
         </li>
         <li class="nav-item">
      <a class="nav-link rounded-1" data-bs-toggle="tab" href="#locataires">Locataires</a>
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
        <a id="toggleBtn{{ $maison->id }}" class="btn btn-outline-secondary btn-sm me-1" data-bs-toggle="collapse" href="#collapseMaison{{ $maison->id }}" role="button" aria-expanded="false" aria-controls="collapseMaison{{ $maison->id }}">
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
     @foreach ($louerChambres as $location)
    <div class="card shadow-sm p-3 mb-4 border-1" style="max-width: 400px;">
        <div class="d-flex align-items-center mb-2">
            <div class="bg-light rounded-circle p-2 me-2">
                <i class="ti ti-user" style="font-size: 1.5rem; color: #6c757d;"></i>
            </div>
            <div>
                <h5 class="mb-0">{{ optional($location->user)->name ?? 'Locataire non assigné' }}</h5>
                @role('gerant')
                <small class="text-muted">{{ $location->chambre->ref }}</small>
                @endrole
            </div>
            <span class="badge
                {{
                    $location->statut === 'CONFIRMER' ? 'bg-success' :
                    ($location->statut === 'EN ATTENTE' ? 'bg-warning text-dark' :
                    ($location->statut === 'REJETER' ? 'bg-danger' : 'bg-secondary'))
                }} ms-auto">
                {{ ucfirst(strtolower($location->statut)) }}
            </span>
        </div>
        <ul class="list-unstyled mb-3">
            <li class="mb-1">
                <i class="ti ti-email me-2"></i>
                {{ optional($location->user)->email ?? 'Aucun email' }}
            </li>
            <li class="mb-1">
                <i class="ti ti-phone me-2"></i>
                {{ optional($location->user)->telephone ?? 'Aucun téléphone' }}
            </li>
            <li>
                <i class="ti ti-home me-2"></i>
                {{ $location->chambre->maison->libelle ?? 'Maison inconnue' }}
            </li>
        </ul>
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
@endforeach

    </div>





    <div class="tab-pane fade" id="paiements">
      <p>Contenu des paiements...</p>
    </div>
    <div class="tab-pane fade" id="interventions">
      <p>Contenu des interventions...</p>
    </div>
  </div>
</div>

  </div>
  </div>


@endsection



