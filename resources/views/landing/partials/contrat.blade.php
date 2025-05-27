<!DOCTYPE html>
<html lang="fr" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo-dh.svg') }}" />
    <title>Go-location</title>

    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('spike/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" />


    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/aos/dist/aos.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" /> --}}


<style>
    body {
     background: #eff5fe;
    }


</style>

</head>
<body>





  <div id="contract-app" class="container mt-5">
        <contract-generator></contract-generator>
 </div>





<script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.prod.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script type="module">
  const { createApp, ref } = Vue;

  createApp({
    components: {
      ContractGenerator: {
        template: `
          <div class="card p-4 shadow-sm">
            <h4 class="mb-4">Générateur de contrat de location</h4>

            <form @submit.prevent="generateContract">
              <div class="mb-3">
                <label class="form-label">Nom et prénoms du propriétaire</label>
                <input v-model="owner" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Téléphone du propriétaire</label>
                <input v-model="telp" type="tel" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">NPI du propriétaire</label>
                <input v-model="npip" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Nom et prénoms du locataire</label>
                <input v-model="tenant" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Téléphone du locataire</label>
                <input v-model="tell" type="tel" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">NPI du locataire</label>
                <input v-model="npil" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Adresse du bien loué</label>
                <input v-model="address" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Montant du loyer (FCFA)</label>
                <input v-model="rent" type="number" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Durée du bail (en mois)</label>
                <input v-model="duration" type="number" class="form-control" required />
              </div>

               <div class="mb-3">
                <label class="form-label">Jour de payement du loyer</label>
                <input v-model="jourl" type="number" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Lieu de signature</label>
                <input v-model="lieu" type="text" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label">Date de début du bail</label>
                <input v-model="startDate" type="date" class="form-control" required />
              </div>

              <button type="submit" class="btn btn-success rounded-1">Générer le contrat</button>
            </form>

            <div v-if="contractGenerated" class="mt-4">
              <h5>Contrat généré :</h5>
              <pre class="bg-light p-3" style="white-space: pre-wrap;">@{{ contractText }}</pre>
              <button class="btn btn-outline-primary mt-2 rounded-1" @click="downloadContract">Télécharger le PDF</button>
            </div>
          </div>
        `,
        setup() {
          const owner = ref('');
          const telp = ref('');
          const npip = ref('');
          const jourl = ref('');
          const tenant = ref('');
          const tell = ref('');
          const npil = ref('');
          const address = ref('');
          const rent = ref('');
          const duration = ref('');
          const lieu = ref('');
          const startDate = ref('');
          const contractText = ref('');
          const contractGenerated = ref(false);

          function generateContract() {
            const today = new Date().toLocaleDateString();

            contractText.value = `


Entre les soussignés :

${owner.value}, NPI : ${npip.value}, Téléphone : ${telp.value}
Ci-après dénommé "le Bailleur",

Et

${tenant.value}, NPI : ${npil.value}, Téléphone : ${tell.value}
Ci-après dénommé "le Locataire",

Il a été convenu ce qui suit :

ARTICLE 1 – OBJET
Le Bailleur loue au Locataire, qui accepte, un bien immobilier situé à l’adresse suivante :
${address.value}

ARTICLE 2 – DURÉE
Le présent contrat est conclu pour une durée de ${duration.value} mois, à compter du ${startDate.value}, renouvelable par tacite reconduction sauf dénonciation.

ARTICLE 3 – LOYER
Le loyer mensuel est fixé à ${rent.value} FCFA. Il est payable au plus tard le ${jourl.value} de chaque mois.

ARTICLE 4 – OBLIGATIONS DU LOCATAIRE
Le Locataire s’engage à :
- Payer le loyer aux échéances convenues.
- Maintenir le logement en bon état.
- Ne pas sous-louer sans autorisation écrite.

ARTICLE 5 – OBLIGATIONS DU BAILLEUR
Le Bailleur s’engage à :
- Délivrer un logement en bon état.
- Effectuer les réparations à sa charge.

Fait à ${lieu.value}, le ${today}

Le Bailleur : _______________________                Le Locataire : _______________________


            `.trim();

            contractGenerated.value = true;
          }

         function downloadContract() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({
    orientation: 'portrait',
    unit: 'mm',
    format: 'A4'
  });

  const pageWidth = doc.internal.pageSize.getWidth();
  const margin = 20;
  const maxLineWidth = pageWidth - margin * 2;
  const lineHeight = 7;
  let y = 30;

  // En-tête du document
  doc.setFontSize(12);
  doc.setFont('helvetica', 'bold');
  doc.text('CONTRAT DE LOCATION', pageWidth / 2, 20, { align: 'center' });

  doc.setFontSize(10);
  doc.setFont('helvetica', 'normal');

  // Transformation du contrat en lignes coupées automatiquement
  const lines = doc.splitTextToSize(contractText.value, maxLineWidth);

  // Affichage ligne par ligne avec saut de page automatique
  lines.forEach((line) => {
    if (y > 280) {
      doc.addPage();
      y = 20;
    }
    doc.text(line, margin, y);
    y += lineHeight;
  });

  // Pied de page avec numérotation (optionnel)
  const pageCount = doc.internal.getNumberOfPages();
  for (let i = 1; i <= pageCount; i++) {
    doc.setPage(i);
    doc.setFontSize(8);
    doc.text(`Page ${i} / ${pageCount}`, pageWidth - margin, 290, { align: 'right' });
  }

  doc.save('contrat-location.pdf');
}

          return {
            owner, telp, npip, jourl, tenant, tell, npil, address, rent, duration,
            lieu, startDate, contractText, contractGenerated,
            generateContract, downloadContract
          };
        }
      }
    }
  }).mount('#contract-app');
</script>
</body>
