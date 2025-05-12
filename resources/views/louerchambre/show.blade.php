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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-end">
                        <a href="{{ route('chambres.show', $louerchambre->chambre_id) }}" class="btn btn-sm btn-primary">Retour</a>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <strong class="text-dark">Chambre:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ optional($louerchambre->chambre)->libelle }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Locataire:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ optional($louerchambre->user)->name }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Date d'entrée:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->debutOccupation }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Prix du loyer:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->chambre->loyer }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Caution du loyer:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->cautionLoyer }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Caution d'électricité:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->cautionElectricite }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Caution d'eau:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->cautionEau }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Jour du paiement du loyer:</strong>
                            <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->jourPaiementLoyer }}" readonly>
                        </div>

                        <div class="col-lg-4">
                            <strong class="text-dark">Copie du contrat:</strong><br>
                            @if($louerchambre->copieContrat)
                                <a href="{{ asset('storage/' . $louerchambre->copieContrat) }}" class="btn btn-sm btn-success mt-1" download>
                                    Télécharger la copie du contrat
                                </a>
                            @else
                                <p class="mt-1">Aucun fichier disponible</p>
                            @endif
                        </div>

                        <div class="col-lg-4 mt-3">
                            <strong class="text-dark">Statut:</strong><br>
                            @php
                                $statut = $louerchambre->statut;
                                $classes = [
                                    'EN ATTENTE' => 'warning',
                                    'CONFIRMER' => 'success',
                                    'REJETER' => 'danger',
                                    'ARCHIVER' => 'danger',
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

    <!-- Paiement + Historique -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">

                <div class="my-3 mx-3">
                    <div class="card border">
                        <div class="card-body">
                            <button type="button" class="btn btn-success w-100 rounded-1"
                                    onclick="payer(this);"
                                    title="Payer la location"
                                    data-montant="{{ $montantLoyer }}">
                                <i class="fa fa-credit-card me-2"></i>
                                Payer le loyer pour ({{ $montantLoyer }} F CFA)
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover datatable">
                            <thead class="thead">
                                <tr>
                                    <th>N°</th>


                                <th >Date de paiement</th>
                                <th >Quittance url</th>
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
                                    <td >{{ $historiquepaiement->quittanceUrl }}</td>
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
                                                            <i class="fs-4 ti ti-edit"></i> Quittance
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
</section>
@endsection

@section('script')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
    function payer(btn) {
        var montant = btn.getAttribute('data-montant');

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
