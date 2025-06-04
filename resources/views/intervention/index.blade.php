
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                      @role('locataire')
                        <div class="text-end">
                            <a href="{{ route('interventions.create') }}" class="btn btn-sm btn-primary rounded-05">+ Ajouter une intervention</a>
                        </div>
                      @endrole
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Intervention(s)</h5>
                            <span>Liste des Intervention(s)</span>
                            <hr>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable w-100">
                                <thead class="thead">
                                    <tr>
                                    <th>N°</th>
                                    <th>locataire</th>
                                    <th>Maison</th>
                                    <th>chambre</th>
									<th >Libelle</th>
									{{-- <th >Description</th> --}}
                                    <th >Date de soumission d'intervention</th>
									<th >Statut</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @php
                                       $i = 0;
                                   @endphp

                                    @forelse ($interventions as $intervention)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                        <td >{{ $intervention->louerchambre->user->name ?? '-' }}</td>
                                        <td >{{ $intervention->louerchambre->chambre->maison->libelle ?? '-' }}</td>
                                        <td >{{ $intervention->louerchambre->chambre->libelle ?? '-' }}</td>
										<td >{{ $intervention->libelle }}</td>
										{{-- <td >{{ $intervention->description }}</td> --}}
                                        <td >{{ $intervention->created_at }}</td>
										<td>
                                            @php
                                                $badgeColor = match($intervention->statut) {
                                                    'EN ATTENTE' => 'warning',
                                                    'CONFIRMER' => 'success',
                                                    'REJETER' => 'danger',

                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badgeColor }}">
                                                {{ $intervention->statut }}
                                            </span>
                                        </td>


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
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('interventions.show',$intervention->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i> Détails
                                                            </a>
                                                        </li>
                                                        @if($intervention->statut === 'EN ATTENTE')
                                                      @role('gerant')
                                                     <li>
                                                        <form action="{{ route('interventions.confirmer', $intervention->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item text-success d-flex align-items-center gap-3">
                                                                <i class="fs-4 ti ti-check"></i> Confirmer
                                                            </button>
                                                        </form>
                                                           </li>

                                                           <li>
                                                        <form action="{{ route('interventions.rejeter', $intervention->id) }}" method="POST">
                                                                   @csrf
                                                                   @method('PATCH')
                                                                   <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-3">
                                                                       <i class="fs-4 ti ti-x"></i> Rejeter
                                                                   </button>
                                                               </form>
                                                           </li>

                                                       @endrole

                                                        @role('locataire')
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('interventions.edit',$intervention->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Modifier
                                                            </a>
                                                         </li>
                                                        <li>
                                                            <form action="{{ route('interventions.destroy',$intervention->id) }}" method="POST"
                                                                 onsubmit="event.preventDefault(); showDeleteAlert(() => this.submit());">
                                                                  @include('sweetalert')
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @endrole
                                                        @endif

                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('interventions.show',$intervention->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('interventions.edit',$intervention->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('interventions.destroy',$intervention->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"><i class="fa fa-fw fa-trash"></i> {{ __('Supprimer') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                --}}
                                            </td>

                                        </tr>
                                        @empty
                                        <tr><td colspan="8" class="text-center">Aucune intervention trouvée</td></tr>
                                    @endforelse



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

