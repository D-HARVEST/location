<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirmer la suppression du compte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Veuillez entrer votre mot de passe pour confirmer la suppression de votre compte.</p>
                <form method="POST" action="{{ route('account.delete') }}">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
