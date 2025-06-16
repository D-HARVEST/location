<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="designation" class="form-label">{{ __('Designation') }}</label> <!-- <strong class="text-danger"> , 'KKiaPay' => 'KKiaPay' </strong> -->  </strong>
            {{ html()->select('Designation', [''  =>'--Sélectionner la désignation--','FedaPay' => 'FedaPay'])
                ->class('form-control rounded-05 ' . ($errors->has('Designation') ? 'is-invalid' : ''))
                ->required()
                ->value(old('Designation', $moyenPaiement?->Designation))
            }}
            {!! $errors->first('Designation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="cle_privee" class="form-label">{{ __('Cle Privee') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Cle_privee" class="form-control @error('Cle_privee') is-invalid @enderror rounded-05" value="{{ old('Cle_privee', $moyenPaiement?->Cle_privee) }}" id="cle_privee" >
            {!! $errors->first('Cle_privee', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="cle_public" class="form-label">{{ __('Cle Public') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Cle_public" class="form-control @error('Cle_public') is-invalid @enderror rounded-05" value="{{ old('Cle_public', $moyenPaiement?->Cle_public) }}" id="cle_public" >
            {!! $errors->first('Cle_public', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="is_active" class="form-label">{{ __('Statut') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            {{ html()->select('isActive', [''  => '-- Sélectionner le statut --','1' => 'Active', '0' => 'Non Active'])
                ->class('form-control rounded-05 ' . ($errors->has('isActive') ? 'is-invalid' : ''))
                ->required()
                ->value(old('isActive', $moyenPaiement?->isActive))
            }}
            {!! $errors->first('isActif', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
