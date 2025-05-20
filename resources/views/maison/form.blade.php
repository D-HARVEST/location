<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="libelle" class="form-label">{{ __('Nom de la maison') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror rounded-05" value="{{ old('libelle', $maison?->libelle) }}" id="libelle" >
            {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="pays" class="form-label">{{ __('Pays') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Pays" class="form-control @error('Pays') is-invalid @enderror rounded-05" value="{{ old('Pays', $maison?->Pays) }}" id="pays" >
            {!! $errors->first('Pays', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="ville" class="form-label">{{ __('Ville') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="ville" class="form-control @error('ville') is-invalid @enderror rounded-05" value="{{ old('ville', $maison?->ville) }}" id="ville" >
            {!! $errors->first('ville', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="quartier" class="form-label">{{ __('Quartier') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="quartier" class="form-control @error('quartier') is-invalid @enderror rounded-05" value="{{ old('quartier', $maison?->quartier) }}" id="quartier" >
            {!! $errors->first('quartier', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="adresse" class="form-label">{{ __('Adresses') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror rounded-05" value="{{ old('adresse', $maison?->adresse) }}" id="adresse" >
            {!! $errors->first('adresse', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="user_id" class="form-label">{{ __('User Id') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror rounded-05" value="{{ old('user_id', $maison?->user_id) }}" id="user_id" >
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="jour_paiement_loyer" class="form-label">{{ __('Jour Paiement Loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" text-muted name="jourPaiementLoyer" pattern="^(?:[1-9]|1[0-9]|2[0-8])$" title="Veuillez entrer un nombre entre 1 et 28" placeholder="Entrez le jour de paiement du loyer entre 1 et 28" class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05" value="{{ old('jourPaiementLoyer', $maison?->jourPaiementLoyer) }}" id="jour_paiement_loyer"  >
            {!! $errors->first('jourPaiementLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2">
            <strong> <label for="moyenPaiement_id" class="form-label">{{ __('Moyen de paiement') }}</label></strong>
            {{
                html()->select('moyenPaiement_id', ['' => '-- Sélectionner un moyen de paiement --'] + $moyenPaiements->toArray())
                    ->class('form-control ' . ($errors->has('moyenPaiement_id') ? 'is-invalid' : ''))
                    ->id('moyenPaiement_id')
                    ->required()
                    ->value(old('moyenPaiement_id', $maison?->moyenPaiement_id))
            }}
            {!! $errors->first('moyenPaiement_id', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
