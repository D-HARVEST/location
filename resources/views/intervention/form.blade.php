<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="libelle" class="form-label">{{ __('Libelle') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror rounded-05" value="{{ old('libelle', $intervention?->libelle) }}" id="libelle" >
            {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="louerchambre_id" class="form-label">{{ __('Louerchambre Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="louerchambre_id" class="form-control @error('louerchambre_id') is-invalid @enderror rounded-05" value="{{ old('louerchambre_id', $intervention?->louerchambre_id) }}" id="louerchambre_id" >
            {!! $errors->first('louerchambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong>
                <label for="description" class="form-label">
                    {{ __('Description') }}
                </label>
            </strong>

            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $intervention?->description) }}</textarea>

            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>



    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
