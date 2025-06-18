<!-- Modal Assigner Locataire -->
<div class="modal fade" id="createChambreModal" tabindex="-1" aria-labelledby="createChambreModalLabel" style="backdrop-filter: blur(8px)" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable modal-sm">
    <form action="{{ route('louerchambres.store') }}" method="POST">
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createChambreModalLabel">Assigner un locataire</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="chambre_id" id="modalChambreId">

          <div class="mb-3">
            <label for="debutOccupation" class="form-label">Début d’occupation</label>
            <input type="date" name="debutOccupation" class="form-control" required>
          </div>

          {{-- <div class="mb-3">
            <label for="loyer" class="form-label">Loyer (FCFA)</label>
            <input type="number" name="loyer" class="form-control" required>
          </div> --}}

          <div class="mb-3">
            <label for="jourPaiementLoyer" class="form-label">Jour de paiement du loyer</label>
            <input type="number" name="jourPaiementLoyer" min="1" max="31" class="form-control" required>
          </div>

          <!-- Cautions -->
          <div class="mb-3">
            <label for="cautionLoyer" class="form-label">Caution Loyer</label>
            <input type="number" name="cautionLoyer" class="form-control">
          </div>
          <div class="mb-3">
            <label for="cautionElectricite" class="form-label">Caution Électricité</label>
            <input type="number" name="cautionElectricite" class="form-control">
          </div>
          <div class="mb-3">
            <label for="cautionEau" class="form-label">Caution Eau</label>
            <input type="number" name="cautionEau" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success rounded-1">Créer location</button>
          <button type="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </form>
  </div>
</div>
