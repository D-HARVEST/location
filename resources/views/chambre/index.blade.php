{{-- @php
    $pagetitle = 'Liste des Chambre(s)';
    $breadcrumbs = ['Liste des Chambre(s)' => route('chambres.index')];
@endphp

@extends('layouts.app') --}}


{{-- @section('content') --}}
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">



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
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Chambre(s)</h5>
                            <span>Liste des Chambre(s)</span>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>

									<th >Désignation de la chambre</th>
									<th >Statut</th>
									<th >Jour de paiement</th>
									<th > Prix du loyer</th>
									<th >Categorie </th>
									<th >Type</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($chambres as $chambre)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $chambre->libelle }}</td>
										<td >                       @php
                                            $badgeClass = $chambre->statut === 'Disponible' ? 'bg-success' : 'bg-danger';
                                        @endphp

                                        <div class="col-lg-4">

                                            <span class="badge {{ $badgeClass }} my-1">
                                                {{ $chambre->statut }}
                                            </span>
                                        </div>
                                        </td>
										<td >{{ $chambre->jourPaiementLoyer }}</td>
										<td >{{ $chambre->loyer }}</td>
										<td>{{ $chambre->category?->libelle ?? 'N/A' }}</td>
                                        <td>{{ $chambre->type?->libelle ?? 'N/A' }}</td>



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
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('chambres.show',$chambre->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i></i>Détail / Asssocier un locataire
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('chambres.edit',$chambre->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Modifier
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('chambres.destroy',$chambre->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>

                                                        </li>
                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('chambres.show',$chambre->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('chambres.edit',$chambre->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('chambres.destroy',$chambre->id) }}" method="POST">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $chambres->withQueryString()->links() !!}
            </div>
        </div>
    </div>
{{-- @endsection --}}
