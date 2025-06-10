@php
    $pagetitle = 'Détails Louerchambre';
    $breadcrumbs = ['Liste des Louerchambre' => route('louerchambres.index'), 'Détails Louerchambre' => ''];
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('template_title')
    Détails Louerchambre
@endsection


@section('content')
<section>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">


                    <div class="row g-4">
                        @php
                            $fields = [
                                'Chambre' => optional($louerchambre->chambre)->libelle,
                                'Locataire' => optional($louerchambre->user)->name,
                                'Date d\'entrée' => $louerchambre->debutOccupation,
                                'Prix du loyer' => number_format($louerchambre->chambre->loyer, 0, ',', ' ') . ' FCFA',
                                'Caution du loyer' => number_format($louerchambre->cautionLoyer, 0, ',', ' ') . ' FCFA',
                                'Caution d\'électricité' => number_format($louerchambre->cautionElectricite, 0, ',', ' ') . ' FCFA',
                                'Caution d\'eau' => number_format($louerchambre->cautionEau, 0, ',', ' ') . ' FCFA',
                                'Jour du paiement du loyer' => $louerchambre->jourPaiementLoyer,
                            ];
                        @endphp

                        @foreach($fields as $label => $value)
                            <div class="col-lg-4">
                                <div class="bg-light p-3 rounded">
                                    <div class="text-muted small">{{ $label }}</div>
                                    <div class="fw-semibold text-dark">{{ $value }}</div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-4">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Copie du contrat</div>
                                @if($louerchambre->copieContrat)
                                    <a href="{{ asset('storage/' . $louerchambre->copieContrat) }}" target="_blank" class="text-success fw-semibold text-decoration-none">
                                        Voir la copie du contrat
                                    </a>
                                @else
                                    <span class="text-danger fw-semibold">Aucun fichier disponible</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="bg-light p-3 rounded">
                                <div class="text-muted small">Statut</div>
                                @php
                                    $statut = $louerchambre->statut;
                                    $classes = [
                                        'EN ATTENTE' => 'warning',
                                        'CONFIRMER' => 'success',
                                        'REJETER' => 'danger',
                                        'ARCHIVER' => 'secondary',
                                    ];
                                    $class = $classes[$statut] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $class }}">{{ $statut }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="row">
        <div class="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">



                        <div class="card-body">
                             <div class="text-end mb-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">Retour</a>
                          </div>
                          @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            {{-- <div class="text-end">
                                <a href="{{ route('paiementenattentes.create') }}" class="btn btn-sm btn-primary rounded-05"> Nouveau</a>
                            </div> --}}
                            <div class="col mb-2">
                                <h5 class="card-title text-dark fw-bolder mb-0">Paiement en attente(s)</h5>
                                <span>Liste des Paiement en attente(s)</span>
                                <hr>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover datatable w-100">
                                    <thead class="thead">
                                        <tr>
                                            <th>N°</th>


                                        <th >Datelimite</th>
                                        <th >Montant</th>
                                        <th >Etat</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp

                                        @foreach ($paiementenattentes as $paiementenattente)
                                            <tr>
                                                <td>{{ ++$i }}</td>


                                                <td>
                                                    @if(!empty($paiementenattente->dateLimite))
                                                        {{ \Carbon\Carbon::parse($paiementenattente->dateLimite)->locale('fr')->translatedFormat('F Y') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                            <td >{{ $paiementenattente->montant }}</td>
                                            <td>
                                                @if($paiementenattente->statut == 'EN ATTENTE')
                                                    <span class="badge bg-warning">EN ATTENTE</span>
                                                @elseif ($paiementenattente->statut == 'EN RETARD')
                                                     <span class="badge bg-danger"> EN RETARD</span>
                                                @endif
                                            </td>


                                                {{-- <td>
                                                    <div class="dropdown dropstart">
                                                        <a href="javascript:void(0)" class="text-muted show" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-expanded="true">
                                                            <i class="ti ti-dots-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-20px, 1.6px, 0px);"
                                                            data-popper-placement="left-start">
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementenattentes.show',$paiementenattente->id) }}">
                                                                    <i class="fs-4 ti ti-eye"></i> Détails
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementenattentes.edit',$paiementenattente->id) }}">
                                                                    <i class="fs-4 ti ti-edit"></i> Modifier
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('paiementenattentes.destroy',$paiementenattente->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                    </button>
                                                                </form>

                                                            </li>
                                                        </ul>
                                                    </div> --}}
                                                    {{--
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="{{ route('paiementenattentes.show',$paiementenattente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                                <a class="dropdown-item" href="{{ route('paiementenattentes.edit',$paiementenattente->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                                <div class="dropdown-divider"></div>
                                                                <form action="{{ route('paiementenattentes.destroy',$paiementenattente->id) }}" method="POST">
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
                    {{-- {!! $paiementenattentes->withQueryString()->links() !!} --}}
                </div>
            </div>
        </div>
    </div>

    @role('gerant|locataire')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body border-1">
                        {{-- <h4 class="card-title">Paiement en espèce(s)</h4> --}}
                        @role('locataire')
                        <div class="card border">
                        <div class="btn btn-success w-100 rounded-1">
                            <a href="{{ route('paiementespeces.create', ['louerchambre_id' => $louerchambre->id]) }}" class="text-white" >
                                 <i class="fa fa-credit-card me-2"></i>
                                    Payer en espèce</a>
                        </div>
                        </div>
                        @endrole

                        <div class="card-title text-dark fw-bolder mt-4">Paiements en espèces</div>
                        <hr>

                        <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
                                    <thead class="thead">
                                        <tr>
                                            <th>N°</th>

                                        <th >Motif</th>
                                        <th >Montant</th>
                                        <th >Date</th>
                                        {{-- <th >Date de Reception</th> --}}
                                        <th >Mois</th>
                                        @role('gerant')
                                        <th >Locataire</th>
                                        @endrole
                                        <th >Observation</th>
                                        <th >Statut</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        @foreach ($paiementespeces as $paiementespece)
                                          @if ($paiementespece->statut != 'CONFIRMER')

                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td >{{ $paiementespece->Motif }}</td>
                                                <td >{{ $paiementespece->Montant }}</td>
                                                <td >{{ $paiementespece->Date }}</td>
                                                {{-- <td >{{ $paiementespece->DateReception }}</td> --}}
                                                <td >
                                                    @php
                                                        \Carbon\Carbon::setLocale('fr');

                                                        $moisArray = is_array($paiementespece->moisPayes)
                                                            ? $paiementespece->moisPayes
                                                            : json_decode($paiementespece->moisPayes, true);

                                                        if ($moisArray) {
                                                            foreach ($moisArray as $mois) {
                                                                echo ucfirst(\Carbon\Carbon::parse($mois)->translatedFormat('F Y')) . '<br>';
                                                            }
                                                        }
                                                    @endphp
                                                </td>
                                                @role('gerant')
                                                <td >{{ $paiementespece->louerchambre->user->name}} / {{ $paiementespece->louerchambre->chambre->libelle }} / {{ $paiementespece->louerchambre->chambre->maison->libelle }}</td>
                                                @endrole
                                                <td >{{ $paiementespece->observation ?? '-' }}</td>
                                                <td>
                                                    @if ($paiementespece->statut == 'EN ATTENTE')
                                                    <span class="badge bg-warning text-dark">{{ $paiementespece->statut}}</span>
                                                    @elseif ($paiementespece->statut == 'CONFIRMER')
                                                    <span class="badge bg-success text-dark">{{ $paiementespece->statut}}</span>
                                                    @elseif ($paiementespece->statut == 'REJETER')
                                                    <span class="badge bg-danger text-dark">{{ $paiementespece->statut}}</span>
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
                                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.show',$paiementespece->id) }}">
                                                                        <i class="fs-4 ti ti-eye"></i> Détails
                                                                    </a>
                                                                </li>
                                                              
                                                                @role('locataire')
                                                                <li>
                                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.edit',$paiementespece->id) }}">
                                                                        <i class="fs-4 ti ti-edit"></i> Modifier
                                                                    </a>
                                                                </li>
                                                             
                                                                <li>
                                                                    <form action="{{ route('paiementespeces.destroy',$paiementespece->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-3">
                                                                        <i class="fs-4 ti ti-trash"></i> {{ __('Supprimer') }}
                                                                        </button>
                                                                    </form>

                                                                </li>
                                                                @endrole


                                                                @role('gerant')
                                                                    @if($paiementespece->statut == 'EN ATTENTE')
                                                                        <form action="{{ route('paiementespeces.changerStatut', $paiementespece->id) }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="statut" value="CONFIRMER">
                                                                            <button type="submit" class="dropdown-item text-success d-flex align-items-center gap-3" style="border:none; background:none;">
                                                                                <i class="ti ti-circle-check me-1"></i> Confirmer
                                                                            </button>
                                                                        </form>

                                                                        <button type="button" class="dropdown-item text-danger d-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#modalRejet{{ $paiementespece->id }}">
                                                                            <i class="ti ti-circle-x me-1"></i> Rejeter
                                                                        </button>

                                                                    @endif
                                                                @endrole
                                                            </ul>
                                                        </div>
                                                        {{--
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Actions
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="{{ route('paiementespeces.show',$paiementespece->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Détails') }}</a>
                                                                    <a class="dropdown-item" href="{{ route('paiementespeces.edit',$paiementespece->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Modifier') }}</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <form action="{{ route('paiementespeces.destroy',$paiementespece->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item text-danger"><i class="fa fa-fw fa-trash"></i> {{ __('Supprimer') }}</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        --}}
                                                </td>
                                            </tr>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endrole




    <!-- Paiement + Historique -->
    @role('locataire')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="my-3 mx-3">
                        <div class="card border">
                            <div class="card-body">
                                @if ($louerchambre->statut === 'CONFIRMER')
                                <form id="formPayer">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="moisPaiement">Mois de paiement</label>
                                       <select class="select2 form-control" name="moisPaiement[]" id="moisPaiement" multiple required>
                                         @php
                                             $start = \Carbon\Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
                                             $now = \Carbon\Carbon::now()->startOfMonth();
                                         @endphp
                                         @while($start <= $now->copy()->addMonths(24))
                                             <option value="{{ $start->format('Y-m') }}">{{ $start->locale('fr')->translatedFormat('F Y') }}</option>
                                          @php $start->addMonth(); @endphp
                                         @endwhile
                                       </select>
                                    </div>

                                   <button type="button"
                                       class="btn btn-success w-100 rounded-1"
                                       onclick="payer(this);"
                                       data-montant="{{ $montantLoyer }}"
                                       data-chambre="{{ $louerchambre->id }}" 
                                       id="payerBtn">
                                   <i class="fa fa-credit-card me-2"></i>
                                   Payer le loyer
                                  </button>

                                </form>
                                @else
                                <div class="alert alert-warning mb-0 text-center">
                                    Paiement indisponible tant que le statut n’est pas confirmé.
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">


                    <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover datatable">
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
                                    @foreach ($historiquepaiements as $historiquepaiement)
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
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
                                    <thead class="thead">
                                        <tr>
                                            <th>N°</th>
                                        <th>Locataire</th>

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
                                        @foreach ($paiements as $paiement)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $paiement->user->name }}</td>

                                            <td >{{ $paiement->datePaiement }}</td>
                                            <td>
                                                @if($paiement->quittanceUrl)
                                                    <a href="{{ $paiement->quittanceUrl }}" target="_blank" download class="btn btn-sm btn-success">
                                                        Télécharger la quittance
                                                    </a>
                                                @elseif($paiement->modePaiement == 'Espece')
                                                    <a href="{{ route('paiementespeces.facture', $paiement->idTransaction) }}"
                                                        target="_blank" download class="btn btn-sm btn-success">
                                                        Télécharger la facture PDF
                                                    </a>

                                                @else
                                                    <span class="badge bg-danger">
                                                        Aucune quittance
                                                    </span>
                                                    @endif
                                            </td>

                                            <td >{{ $paiement->montant }}</td>
                                            <td >{{ $paiement->modePaiement }}</td>
                                            <td>
                                                @if(!empty($paiement) && !empty($paiement->moisPaiement))
                                                  @php
$moisBruts = $paiement->moisPaiement ?? '';
$moisArray = json_decode($moisBruts, true) ?? [];
@endphp

@foreach($moisArray as $mois)
    @if(!empty(trim($mois)))
        {{ \Carbon\Carbon::parse(trim($mois))->locale('fr')->translatedFormat('F Y') }}<br>
    @endif
@endforeach


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
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.show',$paiement->id) }}">
                                                                    <i class="fs-4 ti ti-eye"></i> Détails
                                                                </a>
                                                            </li>

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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
</section>
@endsection



@section('script')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
    let fedapayKey = "{{ $clePublic ?? '' }}"; // récupéré automatiquement
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectMois = document.getElementById('moisPaiement');
        const payerBtn = document.getElementById('payerBtn');

        if (!selectMois || !payerBtn) return;

        const montantUnitaire = parseInt(payerBtn.getAttribute('data-montant')) || 0;

        function updateBoutonPaiement() {
            const moisSelectionnes = Array.from(selectMois.selectedOptions);
            const total = montantUnitaire * moisSelectionnes.length;
            payerBtn.innerHTML = `<i class="fa fa-credit-card me-2"></i> Payer le loyer pour (${total.toLocaleString()} F CFA)`;
        }

        // Pour Select2, on attend l'initialisation et on utilise l'événement jQuery
        if ($(selectMois).hasClass('select2')) {
            $(selectMois).on('change', updateBoutonPaiement);
        } else {
            selectMois.addEventListener('change', updateBoutonPaiement);
        }
    });
</script>



<script>
function payer(btn) {
    //  var montantUnitaire = btn.getAttribute('data-montant');
     var moisPaiement = Array.from(document.getElementById('moisPaiement').selectedOptions).map(option => option.value);
     var montantUnitaire = parseInt(btn.getAttribute('data-montant'));
     var montant = montantUnitaire * moisPaiement.length;
     var chambreId = btn.getAttribute('data-chambre');

   if (moisPaiement.length === 0) {
    Swal.fire({
        icon: 'warning',
        title: 'Veuillez sélectionner au moins un mois de paiement.'
    });
    return;
   }


     if (!fedapayKey || fedapayKey.trim() === "") {
        Swal.fire({
            icon: 'error',
            title: 'Moyen de paiement indisponible',
            text: "Le moyen de paiement n'est pas encore actif. Veuillez contacter votre propriétaire."
        });
        return;
         }
         var debutOccupation = "{{ \Carbon\Carbon::parse($louerchambre->debutOccupation)->format('Y-m') }}";
         if (moisPaiement.some(mois => mois < debutOccupation)) {
          Swal.fire({
              icon: 'error',
              title: 'Mois invalide',
              text: 'Un des mois choisis est avant le début de votre occupation.'
          });
          return;
         }


    fetch("{{ route('paiement.initialiser') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({
            montant: montant,
            moisPaiement: Array.from(moisPaiement),
            chambre_id: chambreId
        })
    })
    .then(res => res.json())
    .then(data => {
    if (data.success) {
        let paiementId = data.paiement_id;
        let widget = FedaPay.init({
            public_key: fedapayKey,
            sandbox: {{ config("services.fedapay.sandbox") ? 'true' : 'false' }},
            transaction: {
                amount: montant,
                description: 'Paiement de loyer',
            },
            onComplete: (response) => {
                if (response.reason === 'CHECKOUT COMPLETE') {
                    window.location.href = '/paiement/' + response.transaction.id;
                } else {
                    // 🔁 Paiement non complété => supprimer l'entrée
                    fetch(`/paiement/annuler/${paiementId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                }
            },
            onError: (error) => {
                // 🔁 Paiement échoué => supprimer aussi
                fetch(`/paiement/annuler/${paiementId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur lors du paiement. Veuillez réessayer.'
                });
            }
        });

        widget.open({
            amount: montant,
            description: 'Paiement de loyer'
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: data.message || 'Erreur lors de l’enregistrement initial.'
        });
    }
});
}
</script>
@endsection
