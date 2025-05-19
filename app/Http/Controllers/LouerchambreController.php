<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use App\Models\Chambre;
use Carbon\CarbonPeriod;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\Louerchambre;
use Illuminate\Http\Request;
use App\Models\Paiementespece;
use Illuminate\Support\Carbon;
use App\Models\Paiementenattente;
use App\Models\Historiquepaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LouerchambreRequest;

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


    public function store(LouerchambreRequest $request): RedirectResponse
    {
        $data = $request->validated();


        // Vérification de l'unicité de l'email
        if (User::where('email', $data['email'])->exists()) {
            return back()->withErrors(['email' => 'Cet email est déjà utilisé.'])->withInput();
        }

        // Vérification de l'unicité du NPI
        if (User::where('npi', $data['npi'])->exists()) {
            return back()->withErrors(['npi' => 'Ce NPI est déjà utilisé.'])->withInput();
        }

        // 1. Création de l'utilisateur
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'npi' => $data['npi'],

        ]);

        $user->assignRole('locataire');

        // 2. Ajout de l'ID de l'utilisateur aux données de location
        $data['user_id'] = $user->id;

        // 3. Création de la location
        Louerchambre::create($data);


        return Redirect::route('chambres.show',  ['chambre' => $request->chambre_id])
            ->with('success', 'Louerchambre et utilisateur créés avec succès !');
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
        $historiquepaiements = Historiquepaiement::where('user_id', $user->id)->get();
        $louer = Louerchambre::with(['chambre.maison', 'user'])
            ->findOrFail($id);
        $paiements = HistoriquePaiement::where('louerchambre_id', $louer->id)->get();
        $montantLoyer = $louerchambre->loyer;

        $jourPaiement = $louerchambre->jourPaiementLoyer;

        $debut = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
        $fin = Carbon::today()->startOfMonth();

        // Créer une période mensuelle
        $moisPeriode = CarbonPeriod::create($debut, '1 month', $fin);

        foreach ($moisPeriode as $mois) {
            $moisFormat = $mois->format('Y-m');

            // Date limite pour ce mois
            $dateLimite = Carbon::create($mois->year, $mois->month, $jourPaiement);

            // Vérifier si le paiement pour ce mois existe
            $paiementExiste = HistoriquePaiement::where('louerchambre_id', $louerchambre->id)
                ->where('moisPaiement', $moisFormat)
                ->exists();

            // Si le paiement existe, on le supprime
            if ($paiementExiste) {
                Paiementenattente::where('louerchambre_id', $louerchambre->id)
                    ->whereDate('dateLimite', $dateLimite)
                    ->delete();
                continue;
            }

            // Si aucun paiement et que la date est dépassée, on vérifie ou crée un en attente
            if (!$paiementExiste && $dateLimite->lessThanOrEqualTo(Carbon::today())) {
                $attenteExiste = Paiementenattente::where('louerchambre_id', $louerchambre->id)
                    ->whereDate('dateLimite', $dateLimite)
                    ->exists();

                if (!$attenteExiste) {
                    Paiementenattente::create([
                        'louerchambre_id' => $louerchambre->id,
                        'dateLimite' => $dateLimite,
                        'montant' => $montantLoyer,
                        'etat' => 'en attente',
                    ]);
                }
            }
        }

        // Récupérer tous les paiements en attente
        $paiementenattentes = Paiementenattente::where('louerchambre_id', $louerchambre->id)->get();

        $paiementespeces = Paiementespece::where('louerchambre_id', $louerchambre->id)->get();
        return view('louerchambre.show', compact('louerchambre', 'chambres', 'historiquepaiements', 'user', 'montantLoyer', 'paiements', 'paiementenattentes', 'paiementespeces'));
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
            && isset($transaction['v1/transaction']['amount'])
            && intval($transaction['v1/transaction']['amount']) == intval($louerchambre->loyer)
        ) {


            Historiquepaiement::create([
                'louerchambre_id' => $louerchambre->id,
                'datePaiement' => now(),
                'montant' => $transaction['v1/transaction']['amount'],
                'modePaiement' =>  $transaction['v1/transaction']['mode'],
                'idTransaction' => $transaction_id,
                'user_id' => auth()->id(),
                'quittanceUrl' => $transaction['v1/transaction']['receipt_url'],
            ]);

            return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
                ->with('success', 'Paiement effectué avec succès; veillez ajouter la quittance et le mois');
        }

        return Redirect::route('louerchambres.show', ['louerchambre' => $louerchambre->id])
            ->with('error', 'Le paiement a échoué ou est introuvable. Veuillez payer d’abord.');
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
            $chambre->update(['statut' => 'Non disponible']);  // Mettre à jour le statut de la chambre
        } else {

            $chambre = $louerchambre->chambre;
            $chambre->update(['statut' => 'Disponible']);  // Mettre à jour le statut de la chambre
        }


        if ($request->hasFile('copieContrat')) {

            $file = $request->file('copieContrat');


            if ($louerchambre->copieContrat) {
                Storage::disk('public')->delete($louerchambre->copieContrat);
            }
            $path = $file->store('contrats', 'public');
            $data['copieContrat'] = $path;
        }


        // Comparaison des dates normalisées
        $debutOccupationAvant = optional($louerchambre->debutOccupation)->format('Y-m-d');
        $debutOccupationApres = isset($data['debutOccupation']) ? Carbon::parse($data['debutOccupation'])->format('Y-m-d') : $debutOccupationAvant;

        $louerchambre->update($data); // Mettre à jour les données avant recalcul

        if ($debutOccupationAvant !== $debutOccupationApres) {
            // Suppression des anciens paiements en attente
            Paiementenattente::where('louerchambre_id', $louerchambre->id)->delete();

            // Recalcul des paiements en attente
            $jourPaiement = $louerchambre->jourPaiementLoyer;
            $montantLoyer = $louerchambre->loyer;

            $debut = Carbon::parse($louerchambre->debutOccupation)->startOfMonth();
            $fin = Carbon::today()->startOfMonth();

            $moisPeriode = CarbonPeriod::create($debut, '1 month', $fin);

            foreach ($moisPeriode as $mois) {
                $moisFormat = $mois->format('Y-m');
                $dateLimite = Carbon::create($mois->year, $mois->month, $jourPaiement);

                $paiementExiste = HistoriquePaiement::where('louerchambre_id', $louerchambre->id)
                    ->where('moisPaiement', $moisFormat)
                    ->exists();

                if ($paiementExiste) {
                    continue;
                }

                if ($dateLimite->lessThanOrEqualTo(Carbon::today())) {
                    Paiementenattente::create([
                        'louerchambre_id' => $louerchambre->id,
                        'dateLimite' => $dateLimite,
                        'montant' => $montantLoyer,
                        'etat' => 'en attente',
                    ]);
                }
            }
        }

        // === FIN GESTION PAIEMENTS EN ATTENTE ===



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
