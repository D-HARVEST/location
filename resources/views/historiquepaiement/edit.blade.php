@php
    $pagetitle = 'Modifier Historiquepaiement';
    $breadcrumbs = ['Liste des Historiquepaiement(s)' => route('historiquepaiements.index'), 'Modifier Historiquepaiement' => ''];
@endphp
@extends('layouts.app')

@section('template_title')
    Formulaire de modification: Historiquepaiement
@endsection

@section('content')
    <section class="">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">

                    <div class="card-body">
                        <div class="text-end">
                            <a href="{{ route('louerchambres.show', $historiquepaiement->louerchambre_id) }}" class="btn btn-sm btn-primary">Retour</a>
                        </div>
                        <div class="col mb-2">
                            <h5 class="card-title text-dark fw-bolder mb-0">Mois de paiement</h5>
                            <span>Ajouter  le mois de paiement</span>
                            <hr>
                        </div>
                        <form method="POST" action="{{ route('historiquepaiements.update', $historiquepaiement->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                           <div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">
            <strong> <label for="louerchambre_id" class="form-label">{{ __('Louerchambre Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="louerchambre_id" class="form-control @error('louerchambre_id') is-invalid @enderror rounded-05" value="{{ old('louerchambre_id', $historiquepaiement?->louerchambre_id) }}" id="louerchambre_id" >
            {!! $errors->first('louerchambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">
            <strong> <label for="date_paiement" class="form-label">{{ __('Date paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="datePaiement" class="form-control @error('datePaiement') is-invalid @enderror rounded-05" value="{{ old('datePaiement', $historiquepaiement?->datePaiement) }}" id="date_paiement">
            {!! $errors->first('datePaiement', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">
            <strong> <label for="quittance_url" class="form-label">{{ __('Quittance de paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="file" name="quittanceUrl" class="form-control @error('quittanceUrl') is-invalid @enderror rounded-05" id="quittance_url">
            {!! $errors->first('quittanceUrl', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="col-lg-6 form-group mb-2 mb20" style="display: none">
            <strong> <label for="montant" class="form-label">{{ __('Montant') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror rounded-05" value="{{ old('montant', $historiquepaiement?->montant) }}" id="montant" >
            {!! $errors->first('montant', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">>
            <strong> <label for="mode_paiement" class="form-label">{{ __('Modepaiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="modePaiement" class="form-control @error('modePaiement') is-invalid @enderror rounded-05" value="{{ old('modePaiement', $historiquepaiement?->modePaiement) }}" id="mode_paiement" >
            {!! $errors->first('modePaiement', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">>
            <strong> <label for="id_transaction" class="form-label">{{ __('Idtransaction') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="idTransaction" class="form-control @error('idTransaction') is-invalid @enderror rounded-05" value="{{ old('idTransaction', $historiquepaiement?->idTransaction) }}" id="id_transaction" >
            {!! $errors->first('idTransaction', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="mois_paiement" class="form-label">{{ __('Mois de paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="month" name="moisPaiement" class="form-control @error('moisPaiement') is-invalid @enderror rounded-05" value="{{ old('mois de Paiement', $historiquepaiement?->moisPaiement) }}" id="mois_paiement" required>
            {!! $errors->first('moisPaiement', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">>
            <strong> <label for="user_id" class="form-label">{{ __('User Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror rounded-05" value="{{ old('user_id', $historiquepaiement?->user_id) }}" id="user_id" >
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">payer maintenant</button>
    </div>
</div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
