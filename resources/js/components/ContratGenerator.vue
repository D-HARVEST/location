<template>
  <div class="card p-4 shadow rounded-3">
    <h4 class="mb-4">Formulaire de génération de contrat</h4>
    <form @submit.prevent="genererContrat">
      <div class="mb-3">
        <label for="proprietaire" class="form-label">Nom du propriétaire</label>
        <input v-model="form.proprietaire" type="text" class="form-control" id="proprietaire" required>
      </div>
      <div class="mb-3">
        <label for="locataire" class="form-label">Nom du locataire</label>
        <input v-model="form.locataire" type="text" class="form-control" id="locataire" required>
      </div>
      <div class="mb-3">
        <label for="bien" class="form-label">Description du bien loué</label>
        <input v-model="form.bien" type="text" class="form-control" id="bien" required>
      </div>
      <div class="mb-3">
        <label for="loyer" class="form-label">Montant du loyer</label>
        <input v-model="form.loyer" type="number" class="form-control" id="loyer" required>
      </div>
      <div class="mb-3">
        <label for="date_debut" class="form-label">Date de début</label>
        <input v-model="form.date_debut" type="date" class="form-control" id="date_debut" required>
      </div>
      <button type="submit" class="btn btn-success">Générer le contrat</button>
    </form>

    <div v-if="contratGenere" class="mt-4 alert alert-info">
      <h5>Contrat généré :</h5>
      <pre>{{ contratGenere }}</pre>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContratGenerator",
  data() {
    return {
      form: {
        proprietaire: '',
        locataire: '',
        bien: '',
        loyer: '',
        date_debut: ''
      },
      contratGenere: ''
    };
  },
  methods: {
    genererContrat() {
      this.contratGenere = `
        CONTRAT DE LOCATION
        -----------------------
        Propriétaire : ${this.form.proprietaire}
        Locataire : ${this.form.locataire}
        Bien loué : ${this.form.bien}
        Loyer mensuel : ${this.form.loyer} FCFA
        Début du contrat : ${this.form.date_debut}
      `;
    }
  }
};
</script>
