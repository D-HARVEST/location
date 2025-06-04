<!-- Modal -->
<div class="modal fade" id="modalLouerChambre" tabindex="-1" aria-labelledby="modalLouerChambreLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0">
      <div class="modal-header">
    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        {{-- Formulaire intégré --}}
        <form method="POST" action="{{ route('louer_chambre.valider') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="ref" class="form-label"><strong>Référence de la chambre</strong></label>
                <input type="text" name="ref" class="form-control @error('ref') is-invalid @enderror" id="ref">
                {!! $errors->first('ref', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success rounded-1">Valider</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
