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
                        <a href="{{ route('chambres.show', $louerchambre->chambre_id) }}" class="btn btn-sm btn-primary">Retour</a>
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
                                <h5 class="card-title text-dark fw-bolder mb-0">Paiementenattente(s)</h5>
                                <span>Liste des Paiementenattente(s)</span>
                                <hr>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
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
                                                <span class="badge bg-warning text-dark">en attente</span>
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

    @role('gerant')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Paiement en espèce(s)</h4> --}}
                        <div class="btn btn-success w-100 rounded-1">
                            <a href="{{ route('paiementespeces.create', ['louerchambre_id' => $louerchambre->id]) }}" class="text-white" >
                                 <i class="fa fa-credit-card me-2"></i>
                                    Payer en espèce</a>
                        </div>

                        <hr>

                        <div class="table-responsive">
                                <table class="table table-striped table-hover datatable">
                                    <thead class="thead">
                                        <tr>
                                            <th>N°</th>

                                        <th >Motif</th>
                                        <th >Montant</th>
                                        <th >Date</th>
                                        <th >Date de Reception</th>
                                        <th >Mois</th>
                                        <th >Locataire</th>
                                        <th >Observation</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paiementespeces as $paiementespece)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                            <td >{{ $paiementespece->Motif }}</td>
                                            <td >{{ $paiementespece->Montant }}</td>
                                            <td >{{ $paiementespece->Date }}</td>
                                            <td >{{ $paiementespece->DateReception }}</td>
                                            <td >{{ \Carbon\Carbon::parse($paiementespece->Mois)->locale('fr')->translatedFormat('F Y')}}</td>
                                            <td >{{ $paiementespece->louerchambre->user->name}} / {{ $paiementespece->louerchambre->chambre->libelle }} / {{ $paiementespece->louerchambre->chambre->maison->libelle }}</td>
                                            <td >{{ $paiementespece->observation }}</td>
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
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('paiementespeces.edit',$paiementespece->id) }}">
                                                                    <i class="fs-4 ti ti-edit"></i> Modifier
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('paiementespeces.destroy',$paiementespece->id) }}" method="POST">
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
        <div class="row mt-4">
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
        <input type="month" class="form-control" name="moisPaiement" id="moisPaiement" required>
    </div>

    <button type="button"
            class="btn btn-success w-100 rounded-1"
            onclick="payer(this);"
            data-montant="{{ $montantLoyer }}">
        <i class="fa fa-credit-card me-2"></i>
        Payer le loyer pour ({{ $montantLoyer }} F CFA)
    </button>
</form>


                                {{-- <button type="button" class="btn btn-success w-100 rounded-1"
                                        onclick="payer(this);"
                                        title="Payer la location"
                                        data-montant="{{ $montantLoyer }}">
                                    <i class="fa fa-credit-card me-2"></i>
                                    Payer le loyer pour ({{ $montantLoyer }} F CFA)
                                </button> --}}
                                @else
                                <div class="alert alert-warning mb-0 text-center">
                                    Paiement indisponible tant que le statut n’est pas confirmé.
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="badge bg-warning text-dark">Après paiement, veillez ajouter le mois de paiement</p>

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
                                                {{ \Carbon\Carbon::parse($historiquepaiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
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
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('historiquepaiements.edit',$historiquepaiement->id) }}">
                                                                <i class="fs-4 ti ti-edit"></i> Ajouter le mois de paiement
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
                                                <a href="{{ asset('storage/' . $paiement->quittanceUrl) }}" target="_blank" download class="badge bg-success text-white" style="text-decoration: none;">
                                                    Télecharger la quittance
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
                                                {{ \Carbon\Carbon::parse($paiement->moisPaiement)->locale('fr')->translatedFormat('F Y') }}
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
    function payer(btn) {
        var montant = btn.getAttribute('data-montant');
        var moisPaiement = document.getElementById('moisPaiement').value;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: 'info',
            title: 'Redirection vers la plateforme de paiement...'
        });

        let widget = FedaPay.init({
            public_key: '{{ config("services.fedapay.public_key") }}',
            sandbox: {{ config("services.fedapay.sandbox") ? 'true' : 'false' }},
            transaction: {
                amount: montant,
                description: 'Paiement de loyer',
            },
            onComplete: (response) => {
                if (response.reason === 'CHECKOUT COMPLETE') {
                    window.location.href = '/paiement/' + response.transaction.id;
                }
            },
            onError: (error) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Erreur lors du paiement. Veuillez réessayer.'
                });
            }
        });

        widget.open({
            amount: montant,
            description: 'Paiement de loyer'
        });
    }
</script>
@endsection
