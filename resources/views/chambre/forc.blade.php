<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="libelle" class="form-label">{{ __('Libelle') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror rounded-05" value="{{ old('libelle', $chambre?->libelle) }}" id="libelle" >
            {!! $errors->first('libelle', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="statut" class="form-label">{{ __('Statut') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="statut" class="form-control @error('statut') is-invalid @enderror rounded-05" value="{{ old('statut', $chambre?->statut) }}" id="statut" >
            {!! $errors->first('statut', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="jour_paiement" class="form-label">{{ __('Jour Paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text"  pattern="^(?:[1-9]|1[0-9]|2[0-8])$" title="Veuillez entrer un nombre entre 1 et 28" class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05"  id="jourPaiementLoyer" placeholder="Entrez le jour de paiement du loyer entre 1 et 28" name="jourPaiementLoyer" class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05" value="{{ old('jourPaiementLoyer', $chambre?->jourPaiementLoyer) }}" id="jourPaiementLoyer" >
            {!! $errors->first('jourPaiementLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="loyer" class="form-label">{{ __('Prix du loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="loyer" class="form-control @error('loyer') is-invalid @enderror rounded-05" value="{{ old('loyer', $chambre?->loyer) }}" id="loyer" >
            {!! $errors->first('loyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong><label for="categorie_id" class="form-label">{{ __('Catégorie') }}</label></strong>
            <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror rounded-05">
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach ($categories as $id => $libelle)
                    <option value="{{ $id }}" {{ old('categorie_id', $chambre?->categorie_id) == $id ? 'selected' : '' }}>
                        {{ $libelle }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('categorie_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong><label for="type_id" class="form-label">{{ __('Type') }}</label></strong>
            <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror rounded-05">
                <option value="">-- Sélectionnez un type --</option>
                @foreach ($types as $id => $libelle)
                    <option value="{{ $id }}" {{ old('type_id', $chambre?->type_id) == $id ? 'selected' : '' }}>
                        {{ $libelle }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('type_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>




          <input type="hidden" class="form-control rounded-05" value="{{ $chambre?->maison?->libelle }}" readonly>
          <input type="hidden" name="maison_id" value="{{ $chambre?->maison_id  }}">

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
