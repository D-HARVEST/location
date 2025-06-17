<!DOCTYPE html>
<html lang="fr" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo-dh.svg') }}" />
    <title>Go-location</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('spike/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstraps/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('spike/assets/libs/aos/dist/aos.css') }}" />

    <style>
        body {
            background: #eff5fe;
        }
    </style>

    <script>
        const initialData = @json($location);
    </script>
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
                                <div class="mb-3" v-for="(label, key) in labels" :key="key">
                                    <label class="form-label">@{{ label }}</label>
                                    <input v-model="fields[key]" :type="types[key]" class="form-control" required />
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
                        // Initialisation des champs depuis initialData
                        const maison = initialData.chambre?.maison || {};
                        const user = initialData.user || {};

                        const fields = ref({
                            owner: initialData?.chambre?.maison?.user?.name || '',
                            telp: initialData?.chambre?.maison?.user?.phone || '',
                            npip: initialData?.chambre?.maison?.user?.npi || '',
                            tenant: user.name || '',
                            tell: user.phone || '',
                            npil: user.npi || '',
                            address: maison.adresse || '',
                            rent: initialData.loyer || '',
                            duration: "",
                            jourl: initialData.jourPaiementLoyer || '',
                            lieu: "",
                            startDate: initialData.debutOccupation || ''
                        });

                        const labels = {
                            owner: "Nom et prénoms du propriétaire",
                            telp: "Téléphone du propriétaire",
                            npip: "NPI du propriétaire",
                            tenant: "Nom et prénoms du locataire",
                            tell: "Téléphone du locataire",
                            npil: "NPI du locataire",
                            address: "Adresse du bien loué",
                            rent: "Montant du loyer (FCFA)",
                            duration: "Durée du bail (en mois)",
                            jourl: "Jour de paiement du loyer",
                            lieu: "Lieu de signature",
                            startDate: "Date de début du bail"
                        };

                        const types = {
                            owner: "text", telp: "tel", npip: "text",
                            tenant: "text", tell: "tel", npil: "text",
                            address: "text", rent: "number", duration: "number",
                            jourl: "number", lieu: "text", startDate: "date"
                        };

                        const contractText = ref('');
                        const contractGenerated = ref(false);

                        function generateContract() {
                            const today = new Date().toLocaleDateString();

                            contractText.value = `
Entre les soussignés :

${fields.value.owner}, NPI : ${fields.value.npip}, Téléphone : ${fields.value.telp}
Ci-après dénommé "le Bailleur",

Et

${fields.value.tenant}, NPI : ${fields.value.npil}, Téléphone : ${fields.value.tell}
Ci-après dénommé "le Locataire",

Il a été convenu ce qui suit :

ARTICLE 1 – OBJET
Le Bailleur loue au Locataire, qui accepte, un bien immobilier situé à l’adresse suivante :
${fields.value.address}

ARTICLE 2 – DURÉE
Le présent contrat est conclu pour une durée de ${fields.value.duration} mois, à compter du ${fields.value.startDate}, renouvelable par tacite reconduction sauf dénonciation.

ARTICLE 3 – LOYER
Le loyer mensuel est fixé à ${fields.value.rent} FCFA. Il est payable au plus tard le ${fields.value.jourl} de chaque mois.

ARTICLE 4 – OBLIGATIONS DU LOCATAIRE
Le Locataire s’engage à :
- Payer le loyer aux échéances convenues.
- Maintenir le logement en bon état.
- Ne pas sous-louer sans autorisation écrite.

ARTICLE 5 – OBLIGATIONS DU BAILLEUR
Le Bailleur s’engage à :
- Délivrer un logement en bon état.
- Effectuer les réparations à sa charge.

Fait à ${fields.value.lieu}, le ${today}

Le Bailleur : _______________________                Le Locataire : _______________________
                            `.trim();

                            contractGenerated.value = true;
                        }

                        function downloadContract() {
                            const { jsPDF } = window.jspdf;
                            const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'A4' });

                            const pageWidth = doc.internal.pageSize.getWidth();
                            const margin = 20;
                            const maxLineWidth = pageWidth - margin * 2;
                            const lineHeight = 7;
                            let y = 30;

                            doc.setFontSize(12);
                            doc.setFont('helvetica', 'bold');
                            doc.text('CONTRAT DE LOCATION', pageWidth / 2, 20, { align: 'center' });

                            doc.setFontSize(10);
                            doc.setFont('helvetica', 'normal');
                            const lines = doc.splitTextToSize(contractText.value, maxLineWidth);

                            lines.forEach((line) => {
                                if (y > 280) {
                                    doc.addPage();
                                    y = 20;
                                }
                                doc.text(line, margin, y);
                                y += lineHeight;
                            });

                            const pageCount = doc.internal.getNumberOfPages();
                            for (let i = 1; i <= pageCount; i++) {
                                doc.setPage(i);
                                doc.setFontSize(8);
                                doc.text(`Page ${i} / ${pageCount}`, pageWidth - margin, 290, { align: 'right' });
                            }

                            doc.save('contrat-location.pdf');
                        }

                        return {
                            fields, labels, types,
                            contractText, contractGenerated,
                            generateContract, downloadContract
                        };
                    }
                }
            }
        }).mount('#contract-app');
    </script>
</body>
</html>
