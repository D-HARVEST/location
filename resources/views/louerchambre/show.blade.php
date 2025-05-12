@php
    $pagetitle = 'Détails Louerchambre';
    $breadcrumbs = ['Liste des Louerchambre' => route('louerchambres.index'), 'Détails Louerchambre' => ''];
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
                                <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->chambre->libelle }}" readonly>
                            </div>

                            <div class="col-lg-4">
                                <strong class="text-dark">Locataire:</strong>
                                <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->user->name }}" readonly>
                            </div>

                            <div class="col-lg-4">
                                <strong class="text-dark">Date d'entrée:</strong>
                                <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->debutOccupation }}" readonly>
                            </div>

                            <div class="col-lg-4">
                                <strong class="text-dark">Prix du loyer:</strong>
                                <input type="text" class="form-control rounded my-1 text-dark" value="{{ $louerchambre->loyer }}" readonly>
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
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->

        <!-- Historique des paiements -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="my-3 mx-3">


                <div class="card card-default border">
                    <div class="card-body">


                            <div class="">
                                <button type="reset" class="btn btn-success w-100 rounded-1"
                                onclick="payer(this);"
                                title="Payer la location"
                                montant ="{{ $montantLoyer }}">
                                   <i class="fa fa-credit-card me-2"></i>
                                   Payer le loyer pour ({{ $montantLoyer }} F CFA)
                               </button>
                            </div>

                    </div>
                </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title text-dark fw-bolder mb-3">Historique des paiements</div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historiquepaiements as $historiquepaiement)
                                <tr>
                                    <td>{{ $historiquepaiement->datePaiement }}</td>
                                    <td>{{ $historiquepaiement->montant }}</td>
                                    <td>
                                        @if($historiquepaiement->statut == 'EN ATTENTE')
                                            <span class="badge bg-warning">EN ATTENTE</span>
                                        @elseif($historiquepaiement->statut == 'CONFIRMER')
                                            <span class="badge bg-success">CONFIRMER</span>
                                        @elseif($historiquepaiement->statut == 'REJETER')
                                            <span class="badge bg-danger">REJETER</span>
                                        @elseif($historiquepaiement->statut == 'ARCHIVER')
                                            <span class="badge bg-danger">ARCHIVER</span>
                                        @else
                                            <span class="badge bg-secondary">Inconnu</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Aucun paiement enregistré</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
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
        var montant = btn.getAttribute('montant');

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
            public_key: '{{ env('FEDAPAY_PUBLIC_KEY') }}',
            sandbox:{{ env('FEDAPAY_SANDBOX') ? 'true' : 'false' }},
            transaction: {
                amount: montant,
                description: 'Paiement de loyer',
            },

            onComplete: (response) => {
                if (response.reason === 'CHECKOUT COMPLETE') {
                    window.location.href = '/paiement/' + response.transaction.id;
                }
            },
            // onError: (error) =>{
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Erreur lors du paiement. Veuillez réessayer.'
            //     });
            // }

            onError: (error) => {
    fetch('/fedapay/log-error', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(error)
    });

    console.error("FedaPay Error:", error);

    Toast.fire({
        icon: 'error',
        title: 'Erreur : ' + (error.message || 'Paiement échoué. Veuillez réessayer.')
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
