<div class="">
    <div class="row">
        
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="chambre_id" class="form-label">{{ __('Chambre Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="chambre_id" class="form-control @error('chambre_id') is-invalid @enderror rounded-05" value="{{ old('chambre_id', $photo?->chambre_id) }}" id="chambre_id" >
            {!! $errors->first('chambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="url" class="form-label">{{ __('Url') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror rounded-05" value="{{ old('url', $photo?->url) }}" id="url" >
            {!! $errors->first('url', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
