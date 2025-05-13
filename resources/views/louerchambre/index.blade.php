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
                <div class="card">



                    <div class="card-body">
                      @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                       @role('gerant')
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createChambreModal">
                                + Lier locataire à une chambre
                            </button>
                        </div>
                       @endrole
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Louerchambre(s)</h5>
                            <span>Liste des Louerchambre(s)</span>
                            <hr>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable">
                                <thead class="thead">
                                    <tr>
                                    <th>N°</th>

									{{-- <th >Chambre</th>--}}
									<th >Locataire</th>
									<th >Debut d'entrée</th>
									{{-- <th >Prix du loyer</th> --}}
									<th >Caution loyer</th>
									<th >Caution electricite</th>
									<th >Caution eau</th>
									<th >Copie contrat</th>
									{{-- <th >Jour paiement loyer</th> --}}
                                    <th >Statut</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($louerchambres as $louerchambre)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $louerchambre->chambre->libelle }}</td> --}}
										<td >{{ $louerchambre->user->name ?? '-'}}</td>
										<td >{{ $louerchambre->debutOccupation ?? '-' }}</td>
										{{-- <td >{{ $louerchambre->chambre->loyer ?? '-' }}</td> --}}
										<td >{{ $louerchambre->cautionLoyer ?? '-' }}</td>
										<td >{{ $louerchambre->cautionElectricite ?? '-' }}</td>
										<td >{{ $louerchambre->cautionEau ?? '-' }}</td>
                                        <td>
                                            @if($louerchambre->copieContrat)
                                                <a href="{{ asset('storage/' . $louerchambre->copieContrat) }}" target="_blank" class="badge bg-success text-white" style="text-decoration: none;">
                                                    Voir la copie du contrat
                                                </a>
                                            @else
                                                <span class="badge bg-danger">
                                                    Aucun fichier disponible
                                                </span>
                                            @endif
                                        </td>

										{{-- <td >{{ $louerchambre->jourPaiementLoyer ?? '-' }}</td> --}}
                                        <td>
                                            {{-- Affichage du statut avec un badge --}}
                                            @if($louerchambre->statut == 'EN ATTENTE')
                                                <span class="badge bg-warning">EN ATTENTE</span>
                                            @elseif($louerchambre->statut == 'CONFIRMER')
                                                <span class="badge bg-success">CONFIRMER</span>
                                            @elseif($louerchambre->statut == 'REJETER')
                                                <span class="badge bg-danger">REJETER</span>
                                            @elseif($louerchambre->statut == 'ARCHIVER')
                                                <span class="badge bg-danger">ARCHIVER</span>
                                            @else
                                                <span class="badge bg-secondary">Inconnu</span>
                                            @endif
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
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('louerchambres.show',$louerchambre->id) }}">
                                                                <i class="fs-4 ti ti-eye"></i> Détails
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('louerchambres.edit',$louerchambre->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Modifier
                                                            </a>
                                                        </li>
                                                        @role('gerant')
                                                        <li>
                                                            <form action="{{ route('louerchambres.destroy',$louerchambre->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                </button>
                                                            </form>

                                                        </li>
                                                        @endrole
                                                        @if($louerchambre->statut == 'EN ATTENTE')
                                                            <li>
                                                                <a href="#" class="dropdown-item d-flex align-items-center text-success gap-3"
                                                                onclick="submitStatutForm('CONFIRMER', {{ $louerchambre->id }})">
                                                                    <i class="ti ti-circle-check fs-4 text-success"></i> Confirmer
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="dropdown-item d-flex align-items-center text-danger gap-3"
                                                                onclick="submitStatutForm('REJETER', {{ $louerchambre->id }})">
                                                                    <i class="ti ti-circle-x fs-4 text-danger"></i> Rejeter
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                {{--
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('louerchambres.show',$louerchambre->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                            <a class="dropdown-item" href="{{ route('louerchambres.edit',$louerchambre->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('louerchambres.destroy',$louerchambre->id) }}" method="POST">
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
