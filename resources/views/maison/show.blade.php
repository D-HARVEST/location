 <div class="container p-4">
            <div class="row mt-4">
            @forelse ($maison->chambres as $chambre)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 h-100">

                <div class="card-body position-relative bg-white border shadow-sm rounded-2">
                    {{-- Bouton menu (3 points) --}}
                    <div class="dropdown position-absolute top-0 end-0 m-2">
                        <a class="text-muted" href="#" role="button" id="dropdownMenu{{ $chambre->id }}"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $chambre->id }}">

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
                    @role('gerant')
                    <small class="text-muted fs-3">Réfrence : <span class=" text-warning"> {{ $chambre->ref ?? 'N/A' }}</span></small>
                    @endrole
                     <div class="mt-2 text-end d-flex justify-content-between">
                       @php
                         $colors = [
                             'Disponible' => 'bg-success',
                             'En attente' => 'bg-warning',
                             'Non disponible' => 'bg-danger',
                         ];
                         $color = $colors[$chambre->statut] ?? 'bg-secondary'; // fallback couleur
                     @endphp

                    <span class="badge {{ $color }}">
                        {{ $chambre->statut }}
                    </span>

                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">{{ number_format($chambre->loyer, 0, ',', ' ') }} FCFA/mois</span>
                        <span class="fw-bold text-dark"></span>
                    </div>
                    <div class="">
                        <span class="text-muted ">{{ $chambre->category?->libelle ?? 'N/A' }}, {{ $chambre->type?->libelle ?? 'Type inconnu' }}</span>
                    </div>

                     @if ($chambre->statut === 'Disponible')
    <button type="button"
        class="btn btn-outline-secondary rounded-1 mt-4 mt-auto"
        onclick="setChambreId({{ $chambre->id }})"
        data-bs-toggle="modal"
        data-bs-target="#createChambreModal">
        Assigner locataire
    </button>
@else
    <div class="mt-4 mt-auto" style="visibility: hidden;">
        <button class="btn btn-outline-secondary rounded-1">Placeholder</button>
    </div>
@endif

                </div>
            </div>
           @empty
           <div class="col-12">
             <div class="alert alert-info text-center">Aucune Chambre enregistrée pour le moment.</div>
           </div>
         @endforelse
         </div>
      </div>
