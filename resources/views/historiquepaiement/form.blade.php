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

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="quittance_url" class="form-label">{{ __('Quittanceurl') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="file" name="quittanceUrl" class="form-control @error('quittanceUrl') is-invalid @enderror rounded-05" value="{{ old('quittanceUrl', $historiquepaiement?->quittanceUrl) }}" id="quittance_url" >
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
        <div class="col-lg-6 form-group mb-2 mb20" >
            <strong> <label for="mois_paiement" class="form-label">{{ __('Mois de paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="month" name="moisPaiement" class="form-control @error('moisPaiement') is-invalid @enderror rounded-05" value="{{ old('mois de Paiement', $historiquepaiement?->moisPaiement) }}" id="mois_paiement" >
            {!! $errors->first('moisPaiement', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" style="display: none;">>
            <strong> <label for="user_id" class="form-label">{{ __('User Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror rounded-05" value="{{ old('user_id', $historiquepaiement?->user_id) }}" id="user_id" >
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
