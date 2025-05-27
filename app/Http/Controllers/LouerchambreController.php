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


    public function store(LouerchambreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Rechercher l'utilisateur par email ou NPI
       $user = User::where('email', $data['email'])
            ->where('npi', $data['npi'])
            ->first();


        if ($user) {
            // Mise à jour des informations de l'utilisateur
            $user->update([
                // 'name' => $data['name'],
                // 'email' => $data['email'],
                'npi' => $data['npi'],
            ]);

            // Assigner le rôle "locataire" s'il ne l'a pas encore
            if (!$user->hasRole('locataire')) {
                $user->assignRole('locataire');
            }
        } else {
            // Création d'un nouvel utilisateur
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'npi' => $data['npi'],
            ]);

            $user->assignRole('locataire');
        }

        // Associer l'utilisateur à la chambre
        $data['user_id'] = $user->id;
        Louerchambre::create($data);

        return Redirect::route('chambres.show', ['chambre' => $request->chambre_id])
            ->with('success', 'Utilisateur associé à la chambre avec succès !');
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







    public function initialiserPaiement(Request $request)
    {
        $louerchambre = Louerchambre::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$louerchambre) {
            return response()->json(['success' => false, 'message' => 'Aucune chambre louée trouvée pour cet utilisateur.'], 404);
        }


        $debutOccupation = \Carbon\Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
        $moisPaiement = \Carbon\Carbon::parse($request->moisPaiement)->startOfMonth();

        if ($moisPaiement->lt($debutOccupation)) {
            return response()->json([
                'success' => false,
                'message' => 'Le mois de paiement ne peut pas être antérieur à la date de début d’occupation.'
            ]);
        }

        if ($louerchambre->statut !== 'CONFIRMER') {
            return response()->json(['success' => false, 'message' => 'Aucune location confirmée trouvée.']);
        }

        $paiementExistant = Historiquepaiement::where('moisPaiement', $request->moisPaiement)
            ->where('user_id', auth()->id())
            ->first();

        // Paiement existe et n'est pas en attente => déjà payé
        if ($paiementExistant && $paiementExistant->modePaiement !== 'EN_ATTENTE') {
            return response()->json(['success' => false, 'message' => 'Vous avez déjà payé pour ce mois.']);
        }

        try {
            // Création d'un nouveau paiement
            $paiement = Historiquepaiement::create([
                'idTransaction' => 'EN_ATTENTE',
                'louerchambre_id' => $louerchambre->id,
                'montant' => $request->montant,
                'modePaiement' => 'EN_ATTENTE',
                'moisPaiement' => $request->moisPaiement,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['success' => true, 'paiement_id' => $paiement->id]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création/mise à jour du paiement : ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur interne.'], 500);
        }

        return response()->json(['success' => true]);
    }



    // public function enregistrerPaiement(string $transaction_id)
    // {
    //     $louerchambre = Louerchambre::where('user_id', auth()->id())
    //         ->latest()
    //         ->first();

    //     if (!$louerchambre) {
    //         return view("layouts.echec", ["message" => "Aucune chambre louée trouvée pour cet utilisateur."]);
    //     }

    //     if ($louerchambre->statut !== 'CONFIRMER') {
    //         return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
    //             ->with('error', 'Statut non confirmé');
    //     }

    //     $maison = $louerchambre->chambre->maison;
    //     $moyenPaiement = $maison->moyenPaiement;

    //     if (!$moyenPaiement || $moyenPaiement->isActive != 1) {
    //         return back()->with('error', "Le moyen de paiement n'est pas actif. Veuillez contacter votre propriétaire pour résoudre ce problème.");
    //     }

    //     $cle_privee = $moyenPaiement->Cle_privee;

    //     $response = Http::withToken($cle_privee)
    //         ->accept('application/json')
    //         ->get("https://sandbox-api.fedapay.com/v1/transactions/{$transaction_id}", [
    //             'include' => 'customer.phone_number,currency,payment_method',
    //             'locale' => 'fr'
    //         ]);

    //     $transaction = $response->json();

    //     $paiement = Historiquepaiement::where('user_id', auth()->id())
    //         ->where('louerchambre_id', $louerchambre->id)
    //         ->where('modePaiement', 'EN_ATTENTE')
    //         ->latest()
    //         ->first();

    //     if (
    //         $paiement &&
    //         isset($transaction['v1/transaction']['status']) &&
    //         $transaction['v1/transaction']['status'] === 'approved' &&
    //         isset($transaction['v1/transaction']['amount']) &&
    //         intval($transaction['v1/transaction']['amount']) === intval($louerchambre->loyer)
    //     ) {
    //         // ✅ Paiement approuvé => mise à jour
    //         $paiement->update([
    //             'datePaiement' => now(),
    //             'montant' => $transaction['v1/transaction']['amount'],
    //             'modePaiement' => $transaction['v1/transaction']['mode'],
    //             'idTransaction' => $transaction_id,
    //             'quittanceUrl' => $transaction['v1/transaction']['receipt_url'],
    //         ]);

    //         return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
    //             ->with('success', 'Paiement effectué avec succès.');
    //     }

    //     return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
    //         ->with('error', 'Aucun historique de paiement trouvé. Veuillez initier un nouveau paiement.');
    // }

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
            && isset($transaction['v1/transaction']['amount'])
            && intval($transaction['v1/transaction']['amount']) == intval($louerchambre->loyer)
        ) {


            $paiement = Historiquepaiement::where('user_id', auth()->id())
                ->where('louerchambre_id', $louerchambre->id)
                ->where('modePaiement', 'EN_ATTENTE')
                ->latest()
                ->first();

            if ($paiement) {

                if (
                    isset($transaction['v1/transaction']['status']) &&
                    $transaction['v1/transaction']['status'] == 'approved' &&
                    isset($transaction['v1/transaction']['amount']) &&
                    intval($transaction['v1/transaction']['amount']) == intval($louerchambre->loyer)
                ) {
                    // ✅ Paiement validé, on met à jour l’enregistrement
                    $paiement->update([
                        'datePaiement' => now(),
                        'montant' => $transaction['v1/transaction']['amount'],
                        'modePaiement' => $transaction['v1/transaction']['mode'],
                        'idTransaction' => $transaction_id,
                        'quittanceUrl' => $transaction['v1/transaction']['receipt_url'],
                    ]);

                    return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
                        ->with('success', 'Paiement effectué avec succès; veillez ajouter la quittance et le mois');
                } else {
                    if (is_null($paiement->datePaiement) && $paiement->modePaiement === 'EN_ATTENTE') {
                        $paiement->delete();
                    }
                }

                return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
                    ->with('error', 'Le paiement a échoué ou est introuvable. Veuillez payer d’abord.');
            }
        }
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

        return Redirect::route('chambres.show', ['chambre' => $request->chambre_id])
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
}
