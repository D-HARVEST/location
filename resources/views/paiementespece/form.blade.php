<div class="">
    <div class="row">

        <!-- Champ Motif -->
        <div class="col-lg-6 form-group mb-2 mb20">
            <label for="motif" class="form-label fw-bold">{{ __('Motif') }} <span class="text-danger">*</span></label>
            <input type="text" name="Motif" id="motif" required
                class="form-control @error('Motif') is-invalid @enderror rounded-05"
                value="{{ old('Motif', $paiementespece?->Motif) }}">
            {!! $errors->first('Motif', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Champ Montant -->
        <div class="col-lg-6 form-group mb-2 mb20">
            <label for="Montant" class="form-label fw-bold">{{ __('Montant') }} <span class="text-danger">*</span></label>
            <input type="number" name="Montant" id="Montant" required min="0" step="0.01"
                class="form-control @error('Montant') is-invalid @enderror rounded-05"
                value="{{ old('Montant', $paiementespece?->Montant ?? $louerchambre->loyer) }}">
            {!! $errors->first('Montant', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Champ Date -->
        <div class="col-lg-6 form-group mb-2 mb20">
            @php
                use Carbon\Carbon;
                $dateValue = old('Date', $paiementespece?->Date ? Carbon::parse($paiementespece->Date)->format('Y-m-d') : now()->format('Y-m-d'));
            @endphp
            <label for="date" class="form-label fw-bold">{{ __('Date') }} <span class="text-danger">*</span></label>
            <input type="date" name="Date" id="date" required
                class="form-control @error('Date') is-invalid @enderror rounded-05"
                value="{{ $dateValue }}">
            {!! $errors->first('Date', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Champ Mois de paiement -->
        <div class="col-lg-6 form-group mb-2 mb20">
            <label for="moisPayes" class="form-label fw-bold">{{ __('Mois de paiement') }} <span class="text-danger">*</span></label>
            @php
                Carbon::setLocale('fr');
                $start = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
                $now = Carbon::now()->startOfMonth();
                $end = $now->copy()->addMonths(24);
                $selectedMois = old('moisPayes', $paiementespece?->moisPayes ?? []);
                $moisDejaPayes = $louerchambre->paiements()->pluck('moisPayes')->flatten()->toArray();
            @endphp
            <select name="moisPayes[]" id="moisPayes" class="form-control select2 bg-light border-dark text-dark @error('moisPayes') is-invalid @enderror" multiple required>
                @while ($start <= $end)
                    @php $mois = $start->format('Y-m'); @endphp
                    <option value="{{ $mois }}"
                        {{ in_array($mois, $selectedMois) ? 'selected' : '' }}
                        {{ in_array($mois, $moisDejaPayes) ? 'disabled' : '' }}>
                        {{ ucfirst($start->translatedFormat('F Y')) }} {{ in_array($mois, $moisDejaPayes) ? '(déjà payé)' : '' }}
                    </option>
                    @php $start->addMonth(); @endphp
                @endwhile
            </select>
            {!! $errors->first('moisPayes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Champ Locataire -->
        <div class="col-lg-12 form-group mb-2 mb20">
            <label for="louerchambre_id" class="form-label fw-bold">{{ __('Locataire') }} <span class="text-danger">*</span></label>
            <input type="hidden" name="louerchambre_id" value="{{ $louerchambre->id }}">
            <input type="text" class="form-control" readonly
                value="{{ $louerchambre->user->name }} ({{ $louerchambre->chambre->libelle }} - {{ $louerchambre->chambre->maison->libelle }})">
            {!! $errors->first('louerchambre_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Champ Observation -->
        <div class="col-lg-12 form-group mb-2 mb20">
            <label for="observation" class="form-label fw-bold">{{ __('Observation') }}</label>
            <textarea name="observation" id="observation" rows="3"
                class="form-control @error('observation') is-invalid @enderror rounded-05">{{ old('observation', $paiementespece?->observation) }}</textarea>
            {!! $errors->first('observation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

    <!-- Bouton d'enregistrement -->
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-success rounded-1">Enregistrer</button>
    </div>
</div>
