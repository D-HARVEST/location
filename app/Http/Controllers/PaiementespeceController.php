<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\LouerChambre;
use Illuminate\Http\Request;
use App\Models\Paiementespece;
use App\Models\Historiquepaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PaiementespeceRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementespeceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paiementespeces = Paiementespece::paginate();

        return view('paiementespece.index', compact('paiementespeces'))
            ->with('i', ($request->input('page', 1) - 1) * $paiementespeces->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $paiementespece = new Paiementespece();

        $louerchambre = LouerChambre::with('user', 'chambre.maison')
            ->findOrFail($request->louerchambre_id);

        return view('paiementespece.create', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(PaiementespeceRequest $request): RedirectResponse
    // {
    //     $all = $request->validated();

    //     $louerchambre = Louerchambre::findOrFail($all['louerchambre_id']);
    //     $debutOccupation = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();


    //     $moisAEnregistrer = [];

    //     foreach ($all['moisPayes'] as $mois) {
    //         $moisDate = Carbon::parse($mois . '-01')->startOfMonth();

    //         // Vérifie si le mois est antérieur à l’entrée
    //         if ($moisDate->lt($debutOccupation)) {
    //             return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} est antérieur à la date d'entrée.");
    //         }

    //         // Vérifie si le mois a déjà été payé
    //         $existe = Historiquepaiement::where('louerchambre_id', $all['louerchambre_id'])
    //             ->whereJsonContains('moisPaiement', $mois)
    //             ->exists();

    //         if ($existe) {
    //             return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} a déjà été payé.");
    //         }

    //         $moisAEnregistrer[] = $mois;
    //     }



    //     // Enregistre les mois en JSON
    //     $all['moisPayes'] = json_encode($moisAEnregistrer);

    //     $paiement = Paiementespece::create($all);

    //     return Redirect::route('louerchambres.show', ['louerchambre' => $paiement->louerchambre_id])
    //         ->with('success', 'Paiement en espèce enregistré avec succès pour les mois sélectionnés.');
    // }


    public function store(PaiementespeceRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $louerchambre = LouerChambre::findOrFail($all['louerchambre_id']);
        $debutOccupation = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();

        // Récupère tous les mois déjà payés
        $moisDejaPayes = Historiquepaiement::where('louerchambre_id', $all['louerchambre_id'])
            ->pluck('moisPaiement')
            ->flatMap(function ($item) {
                return json_decode($item, true);
            })
            ->map(fn($mois) => Carbon::parse($mois . '-01')->startOfMonth())
            ->sort()
            ->values();

        // Détermine le mois minimum à payer (dernier mois payé +1 ou début occupation)
        if ($moisDejaPayes->isNotEmpty()) {
            $dernierMoisPaye = $moisDejaPayes->last();
            $moisAttendu = $dernierMoisPaye->copy()->addMonth();
        } else {
            $moisAttendu = $debutOccupation;
        }

        // Trie les mois envoyés
        $moisDemandes = collect($all['moisPayes'])->map(fn($m) => Carbon::parse($m . '-01')->startOfMonth())->sort()->values();

        $moisAEnregistrer = [];

        foreach ($moisDemandes as $moisDate) {
            if ($moisDate->lt($debutOccupation)) {
                return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} est antérieur à la date d'entrée.");
            }

            // Mois déjà payé
            if ($moisDejaPayes->contains(fn($d) => $d->equalTo($moisDate))) {
                return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} a déjà été payé.");
            }

            // Vérifie si les mois suivent bien la séquence attendue
            if (!$moisDate->equalTo($moisAttendu)) {
                return Redirect::back()->withInput()->with('error', "Vous devez payer le mois de {$moisAttendu->translatedFormat('F Y')} avant {$moisDate->translatedFormat('F Y')}.");
            }

            $moisAEnregistrer[] = $moisDate->format('Y-m');
            $moisAttendu->addMonth(); // Passe au mois suivant
        }

        $all['moisPayes'] = json_encode($moisAEnregistrer);
        $paiement = Paiementespece::create($all);

        return Redirect::route('louerchambres.show', ['louerchambre' => $paiement->louerchambre_id])
            ->with('success', 'Paiement en espèce enregistré avec succès pour les mois sélectionnés.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paiementespece = Paiementespece::findOrFail($id);

        $louerchambre = LouerChambre::with('user', 'chambre.maison')
            ->findOrFail($paiementespece->louerchambre_id);

        return view('paiementespece.show', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paiementespece = Paiementespece::findOrFail($id);
        $louerchambre = LouerChambre::with('user', 'chambre.maison')
            ->findOrFail($paiementespece->louerchambre_id);

        return view('paiementespece.edit', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(PaiementespeceRequest $request, Paiementespece $paiementespece): RedirectResponse
    // {
    //     $all = $request->validated();

    //     $louerchambre = Louerchambre::findOrFail($all['louerchambre_id']);
    //     $debutOccupation = Carbon::parse($louerchambre->debutOccupation);

    //     // Vérification pour chaque mois payé
    //     foreach ($all['moisPayes'] as $mois) {
    //         $moisDate = Carbon::parse($mois . '-01')->startOfMonth();

    //         // Vérifie si le mois est antérieur à l’entrée
    //         if ($moisDate->lt($debutOccupation)) {
    //             return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} est antérieur à la date d'entrée.");
    //         }

    //         $existeDeja = Historiquepaiement::where('louerchambre_id', $all['louerchambre_id'])
    //             ->whereJsonContains('moisPaiement', $mois)
    //             ->exists();



    //         if ($existeDeja) {
    //             return Redirect::back()->withInput()->with('error', "Le mois $mois a déjà été payé.");
    //         }

    //         $moisPaiement = Carbon::parse($mois . '-01');

    //         if ($moisPaiement->lt($debutOccupation->startOfMonth())) {
    //             return Redirect::back()->withInput()->with('error', "Vous ne pouvez pas payer le mois $mois car il est antérieur à votre date d’entrée : " . $debutOccupation->format('d/m/Y'));
    //         }
    //     }

    //     // Mettre à jour le paiement avec statut
    //     $all['statut'] = 'EN ATTENTE';
    //     $paiementespece->update($all);

    //     return Redirect::route('louerchambres.show', ['louerchambre' => $paiementespece->louerchambre_id])
    //         ->with('success', 'Paiement en espèce mis à jour avec succès !');
    // }



    public function update(PaiementespeceRequest $request, Paiementespece $paiementespece): RedirectResponse
    {
        $all = $request->validated();
        $louerchambre = LouerChambre::findOrFail($all['louerchambre_id']);
        $debutOccupation = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();

        // Récupère tous les mois déjà payés par d'autres paiements (hors celui qu'on modifie)
        $moisDejaPayes = Historiquepaiement::where('louerchambre_id', $all['louerchambre_id'])
            ->where('id', '!=', $paiementespece->id)
            ->pluck('moisPaiement')
            ->flatMap(fn($item) => json_decode($item, true))
            ->map(fn($mois) => Carbon::parse($mois . '-01')->startOfMonth())
            ->sort()
            ->values();

        // Déterminer le premier mois à payer : dernier payé + 1 ou date d’entrée
        $moisAttendu = $moisDejaPayes->isNotEmpty()
            ? $moisDejaPayes->last()->copy()->addMonth()
            : $debutOccupation;

        $moisDemandes = collect($all['moisPayes'])
            ->map(fn($m) => Carbon::parse($m . '-01')->startOfMonth())
            ->sort()
            ->values();

        $moisAEnregistrer = [];

        foreach ($moisDemandes as $moisDate) {
            if ($moisDate->lt($debutOccupation)) {
                return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} est antérieur à la date d'entrée.");
            }

            if ($moisDejaPayes->contains(fn($d) => $d->equalTo($moisDate))) {
                return Redirect::back()->withInput()->with('error', "Le mois {$moisDate->translatedFormat('F Y')} a déjà été payé.");
            }

            if (!$moisDate->equalTo($moisAttendu)) {
                return Redirect::back()->withInput()->with('error', "Vous devez payer le mois de {$moisAttendu->translatedFormat('F Y')} avant {$moisDate->translatedFormat('F Y')}.");
            }

            $moisAEnregistrer[] = $moisDate->format('Y-m');
            $moisAttendu->addMonth();
        }

        // Mettre à jour les données
        $all['moisPayes'] = json_encode($moisAEnregistrer);
        $all['statut'] = 'EN ATTENTE';

        $paiementespece->update($all);

        return Redirect::route('louerchambres.show', ['louerchambre' => $paiementespece->louerchambre_id])
            ->with('success', 'Paiement en espèce mis à jour avec succès !');
    }


    public function destroy($id): RedirectResponse
    {
        $data = Paiementespece::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Paiementespece !" . $th->getMessage()]);
        }


        return Redirect::route('louerchambres.show', ['louerchambre' => $data->louerchambre_id])
            ->with('success', 'Paiement en espèce a été supprimé(e) avec succes !');
    }

    public function changerStatut(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'statut' => 'required|in:CONFIRMER,REJETER',
            'motif_rejet' => 'required_if:statut,REJETER'
        ]);

        $paiement = Paiementespece::findOrFail($id);
        $paiement->statut = $request->statut;
        // $moisPayes = $request->moisPayes;

        if ($request->statut === 'REJETER') {
            $paiement->Motif_rejet = $request->motif_rejet;
        }

        $paiement->save();

        if ($request->statut == 'CONFIRMER') {
            $louerchambre = LouerChambre::findOrFail($paiement->louerchambre_id);

            Historiquepaiement::create([
                'louerchambre_id' => $paiement->louerchambre_id,
                'datePaiement'    => $paiement->Date,
                'montant'         => $paiement->Montant,
                'modePaiement'    => 'Espece',
                'idTransaction'   => $paiement->id,
                'moisPaiement'    => $paiement->moisPayes,
                'user_id'         => $louerchambre->user_id,
            ]);
        }

        return back()->with('success', 'Le statut du paiement a été mis à jour avec succès.');
    }

    public function telechargerFacture($id)
    {
        $paiement = Paiementespece::findOrFail($id);
        $louerchambre = LouerChambre::with('user', 'chambre.maison')
            ->findOrFail($paiement->louerchambre_id);

        $data = [
            'paiement' => $paiement,
            'louerchambre' => $louerchambre,
            'locataire' => $louerchambre->user,
            'chambre' => $louerchambre->chambre,
            'maison' => $louerchambre->chambre->maison,
        ];

        // Génère le PDF depuis la vue facture
        $pdf = Pdf::loadView('factures.paiement', $data);

        return $pdf->download('facture_' . $paiement->id . '.pdf');
    }
}
