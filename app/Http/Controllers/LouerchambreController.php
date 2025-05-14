<?php

namespace App\Http\Controllers;

use App\Http\Requests\LouerchambreRequest;
use App\Models\Chambre;
use App\Models\Historiquepaiement;
use App\Models\Louerchambre;
use App\Models\Paiementenattente;
use App\Models\User;
use id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
        $today = Carbon::today();

        $moisPaiement = $today->format('Y-m');

        // Jour limite de paiement pour ce mois
        $dateLimite = Carbon::create($today->year, $today->month, $jourPaiement);

        // Condition 1 : date d’aujourd’hui a dépassé le jour de paiement
        $jourDepasse = $today->greaterThan($dateLimite);


        $paiementExiste = HistoriquePaiement::where('louerchambre_id', $louerchambre->id)
            ->where('moisPaiement', $moisPaiement)
            ->exists();


        if ($paiementExiste) {
            // 🧹 Nettoyage : suppression du paiement en attente pour ce mois
            Paiementenattente::where('louerchambre_id', $louerchambre->id)
                ->whereMonth('dateLimite', $today->month)
                ->whereYear('dateLimite', $today->year)
                ->delete();
        }

        if ($jourDepasse && !$paiementExiste) {

            // Vérifie si un paiement en attente existe déjà
            $attenteExiste = Paiementenattente::where('louerchambre_id', $louerchambre->id)
                ->whereDate('dateLimite', $dateLimite)
                ->exists();

            if (!$attenteExiste) {
                // Crée le paiement en attente
                Paiementenattente::create([
                    'louerchambre_id' => $louerchambre->id,
                    'dateLimite' => $dateLimite,
                    'montant' => $montantLoyer,
                    'etat' => 'en attente',
                ]);
            }
        } elseif ($paiementExiste) {
            // Supprimer tout paiement en attente s’il y a déjà eu paiement
            Paiementenattente::where('louerchambre_id', $louerchambre->id)
                ->whereDate('dateLimite', $dateLimite)
                ->delete();
        }


        $paiementenattentes = Paiementenattente::where('louerchambre_id', $louerchambre->id)->get();




        return view('louerchambre.show', compact('louerchambre', 'chambres', 'historiquepaiements', 'user', 'montantLoyer', 'paiements', 'paiementenattentes'));
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



        $response = Http::withToken('sk_sandbox_EsXh2eiF51m-nZRoLDJYVAOo')
            ->accept('application/json')
            ->timeout(60)
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
                'modePaiement' =>  'MTN',
                'idTransaction' => $transaction_id,
                'user_id' => auth()->id(),
                'quittanceUrl' => null,
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


            // $file = $request->file('copieContrat');
            // $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            // $path = $file->storeAs('contrats', $filename, 'public');

            // Enregistrer le nouveau chemin relatif
            // $data['copie_contrat'] = $path;
        }


        $louerchambre->update($data);


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
