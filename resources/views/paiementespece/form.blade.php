<div class="">
    <div class="row">

        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="motif" class="form-label">{{ __('Motif') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Motif" class="form-control @error('Motif') is-invalid @enderror rounded-05" value="{{ old('Motif', $paiementespece?->Motif) }}" id="motif" required >
            {!! $errors->first('Motif', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="montant" class="form-label">{{ __('Montant') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="text" name="Montant" id="Montant" class="form-control @error('Montant') is-invalid @enderror"
                    value="{{ old('Montant', $paiementespece?->Montant ?? $louerchambre->loyer) }}" readonly>
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
        {{-- <div class="col-lg-6 form-group mb-2 mb20">
            <strong> <label for="dateReception" class="form-label">{{ __('Date de reception') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <input type="date" name="DateReception" class="form-control @error('DateReception') is-invalid @enderror rounded-05" value="{{ old('DateReception', $paiementespece?->DateReception) }}" id="dateReception" >
            {!! $errors->first('DateReception', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div> --}}
        <div class="col-lg-6 form-group mb-2 mb20" >
            <strong> <label for="moisPayes" class="form-label">{{ __('Mois de paiement') }}</label> <!-- <strong class="text-danger"> * </strong> -->  </strong>
            <select name="moisPayes[]" id="moisPayes" class="form-control select2 bg-light border-dark text-dark @error('moisPayes') is-invalid @enderror" multiple required>
                @php
    Carbon::setLocale('fr');

    $start = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
    $now = Carbon::now()->startOfMonth();
    $end = $now->copy()->addMonths(24);

   $selectedMois = old('moisPayes');

if (!$selectedMois && $paiementespece?->moisPayes) {
    $selectedMois = is_array($paiementespece->moisPayes)
        ? $paiementespece->moisPayes
        : json_decode($paiementespece->moisPayes, true);
}
$selectedMois = is_array($selectedMois) ? $selectedMois : [];
  @endphp

                @while ($start <= $end)
                    <option value="{{ $start->format('Y-m') }}"
                        {{ in_array($start->format('Y-m'), $selectedMois) ? 'selected' : '' }}>
                        {{ ucfirst($start->translatedFormat('F Y')) }}
                    </option>
                    @php $start->addMonth(); @endphp
                @endwhile
            </select>

            {!! $errors->first('moisPayes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="col-lg-12 form-group mb-2 mb20">
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
