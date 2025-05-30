@extends('layouts.app')

@section('content')

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
        <button class="btn btn-dark rounded-1">
          <i class="bi bi-plus-lg me-1"></i> Ajouter une propriété
        </button>
      </div>

      <!-- Carte Propriété 1 -->
      <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1"><i class="bi bi-building me-1 text-primary"></i> Résidence Les Palmiers</h5>
            <small class="text-muted">Cocody, Abidjan</small>
          </div>
          <div class="text-end">
            <span class="badge rounded-pill bg-light text-dark border me-2">6/8 occupées</span>
              <a class="btn btn-outline-secondary btn-sm me-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
               <i class="bi bi-eye"></i> Voir chambres
              </a>
            <button class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-pencil-square"></i> Modifier
            </button>
          </div>
        </div>
      </div>

    <div class="collapse" id="collapseExample">
       <div class="card card-body">
        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
       </div>
    </div>

      <!-- Carte Propriété 2 -->
      <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-1"><i class="bi bi-building me-1 text-primary"></i> Villa Moderne</h5>
            <small class="text-muted">Plateau, Abidjan</small>
          </div>
          <div class="text-end">
            <span class="badge rounded-pill bg-light text-dark border me-2">4/6 occupées</span>
            <button class="btn btn-outline-secondary btn-sm me-1">
              <i class="bi bi-eye"></i> Voir chambres
            </button>
            <button class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-pencil-square"></i> Modifier
            </button>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        <a href="#" class="text-dark text-decoration-none">
          <i class="bi bi-plus-lg me-1"></i> Ajouter une nouvelle propriété
        </a>
      </div>

    </div>

    <!-- Autres onglets (contenu vide pour l'exemple) -->
    <div class="tab-pane fade" id="locataires">
      <p>Contenu des locataires...</p>
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
