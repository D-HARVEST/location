@php
    $pagetitle = 'Nouveau Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement(s)' => route('historiquepaiements.index'), 'Nouveau Historiquepaiement' => route('historiquepaiements.create')];
@endphp
@extends('layouts.app')

@section('template_title')

@endsection

@section('content')
    <section class="">
        <div class="row">
            <div class="col-md-12">
                @includeif('partials.errors')

                <div class="card card-default border">
                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('historiquepaiements.index') }}" class="btn btn-sm btn-primary">Retour</a>
                        </div>
                        <form id="paiement-form">
                            @csrf
                            <div class="">
                                <input type="hidden" name="montant" id="montant" value="{{ $montantLoyer }}">
                                <button type="button" class="btn btn-success rounded-1" onclick="payer()">
                                    Payer {{ number_format($montantLoyer, 0, ',', ' ') }} F CFA
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<script>
    function payer() {
        var montant = document.getElementById('montant').value;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        Toast.fire({
            icon: 'info',
            title: 'Redirection vers la plateforme de paiement...'
        });

        let widget = FedaPay.init({
            public_key: '{{ env('FEDAPAY_PUBLIC_KEY') }}',
            sandbox: {{ env('FEDAPAY_SANDBOX', true) ? 'true' : 'false' }},
            transaction: {
                amount: montant,
                description: 'Paiement de loyer',
            },
            onComplete: function (response) {
                if (response.reason === 'CHECKOUT COMPLETE') {
                    window.location.href = "/paiement/fedapay/" + response.transaction.id;
                }
            },
            onError: function (error) {
                Toast.fire({
                    icon: 'error',
                    title: 'Erreur lors du paiement. Veuillez réessayer.'
                });
            }
        });

        widget.open({
            amount: montant,
            description: 'Paiement de loyer',
            email: '{{ auth()->user()->email }}',
            last_name: '{{ auth()->user()->name }}'
        });
    }
</script>
@endsection
