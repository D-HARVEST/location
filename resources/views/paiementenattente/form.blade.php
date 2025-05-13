<div class="">
    <div class="row">
        
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="louerchambre_id" class="form-label">{{ __('Louerchambre Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="louerchambre_id" class="form-control @error('louerchambre_id') is-invalid @enderror rounded-05" value="{{ old('louerchambre_id', $paiementenattente?->louerchambre_id) }}" id="louerchambre_id" >
            {!! $errors->first('louerchambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="date_limite" class="form-label">{{ __('Datelimite') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="dateLimite" class="form-control @error('dateLimite') is-invalid @enderror rounded-05" value="{{ old('dateLimite', $paiementenattente?->dateLimite) }}" id="date_limite" >
            {!! $errors->first('dateLimite', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="montant" class="form-label">{{ __('Montant') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="montant" class="form-control @error('montant') is-invalid @enderror rounded-05" value="{{ old('montant', $paiementenattente?->montant) }}" id="montant" >
            {!! $errors->first('montant', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
