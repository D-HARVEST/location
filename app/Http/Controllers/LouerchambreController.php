<?php

namespace App\Http\Controllers;

use App\Http\Requests\LouerchambreRequest;
use App\Models\Chambre;
use App\Models\Historiquepaiement;
use App\Models\Louerchambre;
use App\Models\Paiementenattente;
use App\Models\Paiementespece;
use App\Models\User;
use App\Notifications\RappelPaiementLoyer;
use Carbon\CarbonPeriod;
use id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LouerchambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $louerchambres = $user->louerchambres()->with('chambre')->latest()->paginate(10);

        return view('louerchambre.index', compact('louerchambres'))
            ->with('i', ($request->input('page', 1) - 1) * $louerchambres->perPage());
    }


    public function valider(Request $request)
    {
        $request->validate([
            'ref' => 'required|string',
        ]);

        // Récupération de la chambre
        $chambre = Chambre::where('ref', $request->ref)->first();

        if (!$chambre) {
            return back()->with('error', 'Référence invalide. Contactez votre propriétaire.');
        }

        // Vérifie s'il existe une réservation avec statut en attente
        $louer = Louerchambre::where('chambre_id', $chambre->id)
            ->where('statut', 'EN ATTENTE')
            ->first();

        if (!$louer) {
            return back()->with('error', 'Cette chambre n\'est pas disponible à la location.');
        }

        // Mise à jour avec l'utilisateur connecté
        $louer->update([
            'user_id' => Auth::id(),
            'statut' => 'CONFIRMER'
        ]);

        $chambre->update([
            'statut' => 'Non disponible'
        ]);

        return redirect()->route('dashboard')->with('success', 'Chambre louée avec succès !');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $louerchambre = new Louerchambre();

        $chambres = Chambre::pluck('libelle', 'id');
        $user = new User();

        return view('louerchambre.create', compact('louerchambre', 'user', 'chambres'));
    }


    /**
     * Store a newly created resource in storage.
     */


    // public function store(LouerchambreRequest $request): RedirectResponse
    // {
    //     $data = $request->validated();


    //     // Vérification de l'unicité de l'email
    //     if (User::where('email', $data['email'])->exists()) {
    //         return back()->withErrors(['email' => 'Cet email est déjà utilisé.'])->withInput();
    //     }

    //     // Vérification de l'unicité du NPI
    //     if (User::where('npi', $data['npi'])->exists()) {
    //         return back()->withErrors(['npi' => 'Ce NPI est déjà utilisé.'])->withInput();
    //     }
    //     // 1. Création de l'utilisateur
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'npi' => $data['npi'],

    //     ]);

    //     $user->assignRole('locataire');
    //     $data['user_id'] = $user->id;

    //     // 3. Création de la location
    //     Louerchambre::create($data);

    //     return Redirect::route('chambres.show',  ['chambre' => $request->chambre_id])
    //         ->with('success', 'Louerchambre et utilisateur créés avec succès !');
    // }


    public function store(Request $request)
    {
        $chambre = Chambre::find($request->chambre_id);

        $request->validate([
            'chambre_id' => 'required|exists:chambres,id',
            'debutOccupation' => 'required|date',
            'jourPaiementLoyer' => 'required|integer|min:1|max:31',
            'cautionLoyer' => 'nullable|numeric',
            'cautionElectricite' => 'nullable|numeric',
            'cautionEau' => 'nullable|numeric',
        ]);

        LouerChambre::create([
            'chambre_id' => $request->chambre_id,
            'user_id' => null, // on laisse volontairement null
            'debutOccupation' => $request->debutOccupation,
            'loyer' => $chambre->loyer,
            'jourPaiementLoyer' => $request->jourPaiementLoyer,
            'cautionLoyer' => $request->cautionLoyer,
            'cautionElectricite' => $request->cautionElectricite,
            'cautionEau' => $request->cautionEau,
            'statut' => 'EN ATTENTE',
        ]);

        $chambre = Chambre::find($request->chambre_id);
        if ($chambre) {
            $chambre->statut = 'En attente';
            $chambre->save();
        }
        return redirect()->back()->with('success', 'Chambre assignée avec succès (en attente de locataire).');
    }





    /**
     * Display the specified resource.
     */
    public function show($id): View
    {

        $user = Auth::user();
        $chambres = Chambre::pluck('libelle', 'id');
        $louerchambre = Louerchambre::with(['chambre', 'user', 'historiquesPaiements'])
            ->findOrFail($id);
        $historiquepaiements = $user->historiquesPaiements()->where('louerchambre_id', $id)->get();
        $louer = Louerchambre::with(['chambre.maison', 'user'])
            ->findOrFail($id);
        $paiements = HistoriquePaiement::where('louerchambre_id', $louer->id)->get();
        $montantLoyer = $louerchambre->loyer;


        // 🔁 Gestion des paiements en attente
        $aujourdhui = \Carbon\Carbon::today();
        $debut = \Carbon\Carbon::parse($louerchambre->debutOccupation);
        $jourPaiement = $louerchambre->jourPaiementLoyer;


        $debut = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
        $fin = Carbon::today()->startOfMonth();
        $moisPeriode = CarbonPeriod::create($debut, '1 month', $fin);

        foreach ($moisPeriode as $mois) {

            if (!$mois instanceof \Carbon\Carbon) {
                $mois = \Carbon\Carbon::parse($mois . '-01'); // Ajouter un jour pour créer une date valide
            }

            $moisFormat = $mois->format('Y-m');

            // Date limite pour ce mois (même jour que prévu pour le paiement)
            $dateLimite = Carbon::create($mois->year, $mois->month, $jourPaiement)->startOfDay();

            // Vérifie si le paiement a été effectué
            $paiementsExistants = HistoriquePaiement::where('louerchambre_id', $louerchambre->id)->get();

            $paiementEffectue = $paiementsExistants->contains(function ($paiement) use ($moisFormat) {
                $moisPayes = json_decode($paiement->moisPaiement, true);
                return is_array($moisPayes) && in_array($moisFormat, $moisPayes);
            });

            if ($paiementEffectue) {
                // Supprimer un éventuel doublon dans paiement en attente
                Paiementenattente::where('louerchambre_id', $louerchambre->id)
                    ->whereMonth('dateLimite', $dateLimite->month)
                    ->whereYear('dateLimite', $dateLimite->year)
                    ->delete();
            } else {
                // Créer le paiement en attente s’il n’existe pas déjà
                $paiementEnAttenteExiste = Paiementenattente::where('louerchambre_id', $louerchambre->id)
                    ->whereMonth('dateLimite', $dateLimite->month)
                    ->whereYear('dateLimite', $dateLimite->year)
                    ->exists();

                if (!$paiementEnAttenteExiste) {
                    Paiementenattente::create([
                        'louerchambre_id' => $louerchambre->id,
                        'dateLimite' => $dateLimite,
                        'montant' => $louerchambre->loyer,
                        'statut' => 'EN ATTENTE',
                    ]);
                }
            }
        }


        // ⚠️ Mise à jour des statuts individuellement
        $paiementenattentes = \App\Models\Paiementenattente::where('louerchambre_id', $louerchambre->id)->get();

        foreach ($paiementenattentes as $paiement) {
            $dateLimite = \Carbon\Carbon::parse($paiement->dateLimite);

            // Notification de rappel 3 jours avant
            if ($aujourdhui->equalTo($dateLimite->copy()->subDays(3))) {
                $louerchambre->user->notify(new RappelPaiementLoyer($dateLimite, 'RAPPEL'));
            }

            // Notification de retard
            if ($aujourdhui->equalTo($dateLimite)) {
                $louerchambre->user->notify(new RappelPaiementLoyer($dateLimite, 'EN RETARD'));
            }

            // Mise à jour du statut
            if ($aujourdhui->gt($dateLimite)) {
                if ($paiement->statut !== 'EN RETARD') {
                    $paiement->statut = 'EN RETARD';
                    $paiement->save();
                }
            } else {
                if ($paiement->statut !== 'EN ATTENTE') {
                    $paiement->statut = 'EN ATTENTE';
                    $paiement->save();
                }
            }
        }

        $paiementespeces = Paiementespece::where('louerchambre_id', $louerchambre->id)->get();


        return view('louerchambre.show', compact(
            'louerchambre',
            'chambres',
            'historiquepaiements',
            'user',
            'montantLoyer',
            'paiements',
            'paiementenattentes',
            'paiementespeces'
        ));
    }



    public function showContrat($id)
    {
        $location = LouerChambre::with(['user', 'chambre.maison.user'])->findOrFail($id);

        return view('landing.partials.contrat', [
            'location' => $location,
        ]);
    }



    // public function initialiserPaiement(Request $request)
    // {
    //     $louerchambre = Louerchambre::where('id', $request->chambre_id)
    //         ->where('user_id', auth()->id())
    //         ->where('statut', 'CONFIRMER')
    //         ->latest()
    //         ->first();

    //     if (!$louerchambre) {
    //         return response()->json(['success' => false, 'message' => 'Aucune chambre louée trouvée.'], 404);
    //     }

    //     $debutOccupation = \Carbon\Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
    //     $moisPaiement = $request->moisPaiement;

    //     if (!is_array($moisPaiement) || count($moisPaiement) === 0) {
    //         return response()->json(['success' => false, 'message' => 'Aucun mois de paiement sélectionné.']);
    //     }

    //     // Vérification des mois
    //     foreach ($moisPaiement as $mois) {
    //         $moisDate = \Carbon\Carbon::parse($mois)->startOfMonth();

    //         if ($moisDate->lt($debutOccupation)) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Le mois ' . $moisDate->translatedFormat('F Y') . ' est antérieur à votre début d’occupation.'
    //             ]);
    //         }

    //         // $paiementExistant = Historiquepaiement::where('user_id', auth()->id())
    //         //     ->where('louerchambre_id', $louerchambre->id)
    //         //     ->whereJsonContains('moisPaiement', 'like', "%$mois%")
    //         //     ->where('modePaiement', '!=', 'EN_ATTENTE')
    //         //     ->latest()
    //         //     ->first();

    //         $paiementExistant = Historiquepaiement::where('user_id', auth()->id())
    //             ->where('louerchambre_id', $louerchambre->id)
    //             ->where('modePaiement', '!=', 'EN_ATTENTE')
    //             ->get()
    //             ->filter(function ($p) use ($mois) {
    //                 $moisExistants = json_decode($p->moisPaiement, true);
    //                 return in_array($mois, $moisExistants);
    //             })
    //             ->isNotEmpty();



    //         if ($paiementExistant) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Vous avez déjà payé pour le mois de ' . $moisDate->translatedFormat('F Y') . '.'
    //             ]);
    //         }
    //     }

    //     $montantTotal = count($moisPaiement) * $louerchambre->loyer;

    //     try {
    //         $paiement = Historiquepaiement::create([
    //             'idTransaction' => 'EN_ATTENTE',
    //             'louerchambre_id' => $louerchambre->id,
    //             'montant' => $montantTotal,
    //             'modePaiement' => 'EN_ATTENTE',
    //             'moisPaiement' => json_encode($moisPaiement),
    //             'nb_mois' => count($moisPaiement),
    //             'user_id' => auth()->id(),
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'paiement_id' => $paiement->id,
    //             'montant_total' => $montantTotal
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Erreur paiement groupé : ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Erreur interne.'], 500);
    //     }
    // }


    public function initialiserPaiement(Request $request)
    {
        $louerchambre = Louerchambre::where('id', $request->chambre_id)
            ->where('user_id', auth()->id())
            ->where('statut', 'CONFIRMER')
            ->latest()
            ->first();

        if (!$louerchambre) {
            return response()->json(['success' => false, 'message' => 'Aucune chambre louée trouvée.'], 404);
        }

        $debutOccupation = \Carbon\Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
        $moisPaiement = $request->moisPaiement;

        if (!is_array($moisPaiement) || count($moisPaiement) === 0) {
            return response()->json(['success' => false, 'message' => 'Aucun mois de paiement sélectionné.']);
        }

        // Récupérer tous les mois déjà payés (hors EN_ATTENTE)
        $paiementsExistants = Historiquepaiement::where('user_id', auth()->id())
            ->where('louerchambre_id', $louerchambre->id)
            ->where('modePaiement', '!=', 'EN_ATTENTE')
            ->get();

        $moisPayes = [];
        foreach ($paiementsExistants as $p) {
            $mois = json_decode($p->moisPaiement, true);
            foreach ($mois as $m) {
                $moisPayes[] = \Carbon\Carbon::parse($m)->startOfMonth();
            }
        }

        // On trie les mois déjà payés
        $moisPayes = collect($moisPayes)->sort();

        // Trouver le prochain mois à payer
        if ($moisPayes->isNotEmpty()) {
            $dernierMoisPaye = $moisPayes->last();
            $moisAttendu = $dernierMoisPaye->copy()->addMonthNoOverflow();
        } else {
            $moisAttendu = $debutOccupation;
        }




        // Vérifier que le premier mois choisi est bien le mois attendu
        $moisChoisi = collect($moisPaiement)->map(function ($m) {
            return \Carbon\Carbon::parse($m)->startOfMonth();
        })->sort();

        // Vérification supplémentaire : s'assurer qu'aucun des mois choisis n'est déjà payé
        foreach ($moisChoisi as $mois) {
            if ($moisPayes->contains(fn($m) => $m->equalTo($mois))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Le mois ' . $mois->translatedFormat('F Y') . ' a déjà été payé.'
                ]);
            }
        }

        if (!$moisChoisi->first()->equalTo($moisAttendu)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez d’abord payer pour le mois de ' . $moisAttendu->translatedFormat('F Y') . '.'
            ]);
        }



        $montantTotal = count($moisPaiement) * $louerchambre->loyer;

        try {
            $paiement = Historiquepaiement::create([
                'idTransaction' => 'EN_ATTENTE',
                'louerchambre_id' => $louerchambre->id,
                'montant' => $montantTotal,
                'modePaiement' => 'EN_ATTENTE',
                'moisPaiement' => json_encode($moisPaiement),
                'nb_mois' => count($moisPaiement),
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'paiement_id' => $paiement->id,
                'montant_total' => $montantTotal
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur paiement groupé : ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur interne.'], 500);
        }
    }




    public function enregistrerPaiement(string $transaction_id)
    {
        $louerchambre = Louerchambre::where('user_id', auth()->id())
            ->latest()
            ->first();

        // Vérifie si un louerchambre existe
        if (!$louerchambre) {
            return view("layouts.echec", ["message" => "Aucune chambre louée trouvée pour cet utilisateur."]);
        }

        // Vérifier si le statut est bien "CONFIRMER"
        if ($louerchambre->statut !== 'CONFIRMER') {
            return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
                ->with('error', 'statut non confirmer');
        }


        $maison = $louerchambre->chambre->maison;

        $moyenPaiement = $maison->moyenPaiement;

        if (!$moyenPaiement || $moyenPaiement->isActive != 1) {
            return back()->with('error', "Le moyen de paiement n'est pas actif. Veuillez contacter votre propriétaire pour résoudre ce problème.");
        }

        $cle_privee = $moyenPaiement->Cle_privee;
        $response = Http::withToken($cle_privee)
            ->accept('application/json')
            ->get("https://sandbox-api.fedapay.com/v1/transactions/{$transaction_id}", [
                'include' => 'customer.phone_number,currency,payment_method',
                'locale' => 'fr'
            ]);


        $transaction = $response->json();

        if (
            isset($transaction['v1/transaction']['status'])
            && $transaction['v1/transaction']['status'] == 'approved'
        ) {


            $paiement = Historiquepaiement::where('user_id', auth()->id())
                ->where('idTransaction', 'EN_ATTENTE')
                ->latest()
                ->first();


            $nombreMois = $paiement->nb_mois;
            $montantAttendu = intval($louerchambre->loyer) * $nombreMois;

            if ($paiement) {

                if (
                    isset($transaction['v1/transaction']['status']) &&
                    $transaction['v1/transaction']['status'] == 'approved' &&
                    isset($transaction['v1/transaction']['amount']) &&
                    intval($transaction['v1/transaction']['amount']) == $montantAttendu
                ) {
                    // ✅ Paiement validé, on met à jour l’enregistrement
                    $paiement->update([
                        'datePaiement' => now(),
                        'montant' => $transaction['v1/transaction']['amount'],
                        'modePaiement' => $transaction['v1/transaction']['mode'],
                        'idTransaction' => $transaction_id,
                        'quittanceUrl' => $transaction['v1/transaction']['receipt_url'],
                    ]);

                    return redirect()->back()
                        ->with('success', 'Paiement effectué avec succès');
                } else {
                    if (is_null($paiement->datePaiement) && $paiement->modePaiement === 'EN_ATTENTE') {
                        $paiement->delete();
                    }
                }

                return Redirect::route('dashboard', ['louerchambre' => $louerchambre->id])
                    ->with('error', 'Le paiement a échoué ou est introuvable. Veuillez payer d’abord.');
            }
        }
        Log::error("Paiement échoué ou transaction introuvable pour l'utilisateur ID: " . auth()->id() . " avec la transaction ID: " . $transaction_id);

        // return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
        // ->with('error', 'Le paiement a échoué ou est introuvable. Veuillez payer d’abord.');

    }

    public function annulerPaiement($id)
    {
        $paiement = Historiquepaiement::where('id', $id)
            ->where('modePaiement', 'EN_ATTENTE')
            ->where('user_id', auth()->id())
            ->first();

        if ($paiement) {
            $paiement->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Aucun paiement en attente trouvé.'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $louerchambre = Louerchambre::findOrFail($id);
        $chambres = Chambre::pluck('libelle', 'id');
        $user = $louerchambre->user;
        $chambre = $louerchambre->chambre;

        return view('louerchambre.edit', compact('louerchambre', 'chambres', 'user', 'chambre'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LouerchambreRequest $request, Louerchambre $louerchambre): RedirectResponse
    {
        $data = $request->validated();
        $user = $louerchambre->user;


        if ($data['statut'] === 'CONFIRMER') {
            $chambre = $louerchambre->chambre;
            $chambre->update(['statut' => 'Non disponible']);
        } else {

            $chambre = $louerchambre->chambre;
            $chambre->update(['statut' => 'Disponible']);
        }
        if ($request->hasFile('copieContrat')) {
            $file = $request->file('copieContrat');
            if ($louerchambre->copieContrat) {
                Storage::disk('public')->delete($louerchambre->copieContrat);
            }
            $path = $file->store('contrats', 'public');
            $data['copieContrat'] = $path;
        }




        $debutOccupationAvant = optional($louerchambre->debutOccupation)->format('Y-m-d');
        $debutOccupationApres = isset($data['debutOccupation']) ? Carbon::parse($data['debutOccupation'])->format('Y-m-d') : $debutOccupationAvant;

        $louerchambre->update($data);

        if ($debutOccupationAvant !== $debutOccupationApres) {
            Paiementenattente::where('louerchambre_id', $louerchambre->id)->delete();

            // Recalcul des paiements en attente
            $jourPaiement = $louerchambre->jourPaiementLoyer;
            $montantLoyer = $louerchambre->loyer;
            $aujourdhui = \Carbon\Carbon::today();

            $debut = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
            $fin = Carbon::today()->startOfMonth();

            $moisPeriode = CarbonPeriod::create($debut, '1 month', $fin);

            foreach ($moisPeriode as $mois) {
                $moisFormat = $mois->format('Y-m');

                // Date limite pour ce mois (même jour que prévu pour le paiement)
                $dateLimite = Carbon::create($mois->year, $mois->month, $jourPaiement)->startOfDay();

                // Vérifie si le paiement a été effectué
                $paiementEffectue = HistoriquePaiement::where('louerchambre_id', $louerchambre->id)
                    ->where('moisPaiement', $moisFormat)
                    ->exists();

                if ($paiementEffectue) {
                    // Supprimer un éventuel doublon dans paiement en attente
                    Paiementenattente::where('louerchambre_id', $louerchambre->id)
                        ->whereMonth('dateLimite', $dateLimite->month)
                        ->whereYear('dateLimite', $dateLimite->year)
                        ->delete();
                } else {
                    // Créer le paiement en attente s’il n’existe pas déjà
                    $paiementEnAttenteExiste = Paiementenattente::where('louerchambre_id', $louerchambre->id)
                        ->whereMonth('dateLimite', $dateLimite->month)
                        ->whereYear('dateLimite', $dateLimite->year)
                        ->exists();

                    if (!$paiementEnAttenteExiste) {
                        Paiementenattente::create([
                            'louerchambre_id' => $louerchambre->id,
                            'dateLimite' => $dateLimite,
                            'montant' => $louerchambre->loyer,
                            'statut' => 'EN ATTENTE',
                        ]);
                    }
                }
            }
        }


        $paiementenattentes = \App\Models\Paiementenattente::where('louerchambre_id', $louerchambre->id)->get();
        $aujourdhui = Carbon::today();
        foreach ($paiementenattentes as $paiement) {
            if ($aujourdhui > \Carbon\Carbon::parse($paiement->dateLimite)) {
                if ($paiement->statut !== 'EN RETARD') {
                    $paiement->statut = 'EN RETARD';
                    $paiement->save();
                }
            } else {
                if ($paiement->statut !== 'EN ATTENTE') {
                    $paiement->statut = 'EN ATTENTE';
                    $paiement->save();
                }
            }
        }

        return Redirect::route('dashboard', ['chambre' => $request->chambre_id])
            ->with('success', 'Louerchambre et utilisateur ont été mis à jour avec succès !');
    }






    public function destroy(Request $request, $id): RedirectResponse
    {
        dd([
            'hasFile' => $request->hasFile('copieContrat'),
            'file' => $request->file('copieContrat'),
            'all_inputs' => $request->all()
        ]);
        $data = Louerchambre::findOrFail($id);

        try {

            $chambreId = $data->chambre_id;
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Louerchambre !" . $th->getMessage()]);
        }


        return Redirect::route('chambres.show', ['chambre' => $chambreId])
            ->with('success', 'Louerchambre a été supprimé(e) avec succes !');
    }



    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:EN ATTENTE,CONFIRMER,REJETER,ARCHIVER',
        ]);

        $location = LouerChambre::with('chambre')->findOrFail($id);
        $location->statut = $request->statut;
        $location->save();

        // Synchroniser le statut de la chambre si nécessaire
        if ($request->statut === 'EN ATTENTE') {
            $location->chambre->statut = 'En attente';
            $location->chambre->save();
        } elseif ($request->statut === 'REJETER' || $request->statut === 'ARCHIVER') {
            $location->chambre->statut = 'Disponible';
            $location->chambre->save();
        } elseif ($request->statut === 'CONFIRMER') {
            $location->chambre->statut = 'Non disponible';
            $location->chambre->save();
        }

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}
