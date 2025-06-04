<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20" style="display: none">
            <strong>
                <label for="chambre_libelle" class="form-label">{{ __('Chambre') }}</label>
            </strong>
            <input type="text" class="form-control rounded-05" id="chambre_libelle"
                   value="{{ $chambre->libelle ?? '' }}" readonly>
            <input type="hidden" name="chambre_id" value="{{ $chambre->id ?? '' }}">
        </div>

@role('gerant')
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="caution_loyer" class="form-label">{{ __('Prix caution du loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="number" name="cautionLoyer" class="form-control @error('cautionLoyer') is-invalid @enderror rounded-05" value="{{ old('cautionLoyer', $louerchambre?->cautionLoyer) }}" id="caution_loyer" >
            {!! $errors->first('cautionLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="caution_electricite" class="form-label">{{ __('Prix caution electricite') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="number" name="cautionElectricite" class="form-control @error('cautionElectricite') is-invalid @enderror rounded-05" value="{{ old('cautionElectricite', $louerchambre?->cautionElectricite) }}" id="caution_electricite" >
            {!! $errors->first('cautionElectricite', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="caution_eau" class="form-label">{{ __('Prix caution eau') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="number" name="cautionEau" class="form-control @error('cautionEau') is-invalid @enderror rounded-05" value="{{ old('cautionEau', $louerchambre?->cautionEau) }}" id="caution_eau" >
            {!! $errors->first('cautionEau', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="debut_occupation" class="form-label">{{ __("Date d'entrée") }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="date" name="debutOccupation" class="form-control @error('debutOccupation') is-invalid @enderror rounded-05" value="{{ old('debutOccupation', $louerchambre?->debutOccupation) }}" id="debut_occupation" required >
            {!! $errors->first('debutOccupation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>



@endrole


     @role('locataire')
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="copie_contrat" class="form-label">{{ __('Copie du contrat') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="file" name="copieContrat" class="form-control @error('copieContrat') is-invalid @enderror rounded-05" id="copie_contrat" >
            {!! $errors->first('copieContrat', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        @endrole

        @role('gerant')

        <div class="col-lg-6 form-group mb-2 mb20" style="display: none">
            <strong> <label for="loyer" class="form-label">{{ __('Prix du loyer') }}</label></strong>
            <input type="number"
                   name="loyer"
                   class="form-control @error('loyer') is-invalid @enderror rounded-05"
                   value="{{ old('loyer', $louerchambre?->loyer ?? $chambre?->loyer) }}"
                   id="loyer"
                   required
                    @role('gerant') required @endrole>
            {!! $errors->first('loyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="jour_paiement_loyer" class="form-label">{{ __('Jour paiement loyer') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="jourPaiementLoyer" pattern="^(?:[1-9]|1[0-9]|2[0-8])$" title="Veuillez entrer un nombre entre 1 et 28" placeholder="Entrez le jour de paiement du loyer entre 1 et 28"  class="form-control @error('jourPaiementLoyer') is-invalid @enderror rounded-05" value="{{ old('jourPaiementLoyer', $louerchambre?->jourPaiementLoyer) }}" id="jour_paiement_loyer"  required>
            {!! $errors->first('jourPaiementLoyer', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
       @endrole


        <div class="col-lg-6 form-group mt-4" style="display: none">
            <strong>
               <label class="form-label d-block">{{ __('Veillez confirmer que vous avez loué cette chambre') }}</label>

           </strong>
           @php
               $statuts = ['EN ATTENTE', 'CONFIRMER', 'REJETER', 'ARCHIVER'];
               $statutActuel = old('statut', $louerchambre?->statut);
           @endphp

           @foreach($statuts as $index => $statut)
               <div class="form-check form-check-inline">
                   <input class="form-check-input @error('statut') is-invalid @enderror"
                          type="radio"
                          name="statut"
                          id="statut_{{ $statut }}"
                          value="{{ $statut }}"
                          {{ $statutActuel === $statut ? 'checked' : '' }}
                          @if($index === 0) required @endif>
                   <label class="form-check-label" for="statut_{{ $statut }}">{{ $statut }}</label>
               </div>
           @endforeach

           {!! $errors->first('statut', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
       </div>


    </div>


    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
