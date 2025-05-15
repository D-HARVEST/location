<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="motif" class="form-label">{{ __('Motif') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Motif" class="form-control @error('Motif') is-invalid @enderror rounded-05" value="{{ old('Motif', $paiementespece?->Motif) }}" id="motif" >
            {!! $errors->first('Motif', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="montant" class="form-label">{{ __('Montant') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Montant" class="form-control @error('Montant') is-invalid @enderror rounded-05" value="{{ old('Montant', $paiementespece?->Montant) }}" id="montant" >
            {!! $errors->first('Montant', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="date" class="form-label">{{ __('Date') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            @php
                use Carbon\Carbon;

                $dateValue = old('Date', $paiementespece?->Date ? Carbon::parse($paiementespece->Date)->format('Y-m-d') : now()->format('Y-m-d'));
            @endphp

            <input type="date" name="Date" class="form-control @error('Date') is-invalid @enderror rounded-05" value="{{ $dateValue }}" id="date">
            {!! $errors->first('Date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="dateReception" class="form-label">{{ __('Date de reception') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="date" name="DateReception" class="form-control @error('DateReception') is-invalid @enderror rounded-05" value="{{ old('DateReception', $paiementespece?->DateReception) }}" id="dateReception" >
            {!! $errors->first('DateReception', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20" >
            <strong> <label for="mois" class="form-label">{{ __('Mois de paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="month" name="Mois" class="form-control @error('Mois') is-invalid @enderror rounded-05" value="{{ old('Mois', $paiementespece?->Mois) }}" id="mois" required>
            {!! $errors->first('Mois', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="louerchambre_id" class="form-label">{{ __('Locataire') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="hidden" name="louerchambre_id" value="{{ $louerchambre->id }}">

            <input type="text" class="form-control" readonly
                value="{{ $louerchambre->user->name }} ({{ $louerchambre->chambre->libelle }} - {{ $louerchambre->chambre->maison->libelle }})">
            {!! $errors->first('louerchambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-12 form-group mb-2 mb20">
            <strong> <label for="observation" class="form-label">{{ __('Observation') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <textarea type="text" name="observation" class="form-control @error('observation') is-invalid @enderror rounded-05" value="{{ old('observation', $paiementespece?->observation) }}" id="observation" ></textarea>
            {!! $errors->first('observation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
