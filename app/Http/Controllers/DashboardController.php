<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chambre;
use App\Models\HistoriquePaiAdm;
use App\Models\HistoriquePaiement;
use App\Models\Intervention;
use App\Models\LouerChambre;
use App\Models\Maison;
use App\Models\MoyenPaiement;
use App\Models\Paiementenattente;
use App\Models\Paiementespece;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $maisons = Maison::with('chambres')
            ->where('user_id', $user->id)
            ->paginate(10);

        $moyenPaiements = $user->moyenpaiements()->with('user')->latest()->paginate(10);


        $categories = Category::pluck('libelle', 'id');
        $types = Type::pluck('libelle', 'id');

        // Définir les requêtes de base
        $louerChambresQuery = LouerChambre::query();
        $interventionsQuery = Intervention::query();
        $historiquesPaiementQuery = HistoriquePaiement::query();

        if ($user->hasRole('gerant')) {
            $louerChambresQuery->whereHas('chambre.maison', fn($q) => $q->where('user_id', $user->id));
            $interventionsQuery->whereHas('louerchambre.chambre.maison', fn($q) => $q->where('user_id', $user->id));
            $historiquesPaiementQuery->whereHas('louerchambre.chambre.maison', fn($q) => $q->where('user_id', $user->id));
        } elseif ($user->hasRole('locataire')) {
            $louerChambresQuery->where('user_id', $user->id);
            $interventionsQuery->whereHas('louerchambre', fn($q) => $q->where('user_id', $user->id));
            $historiquesPaiementQuery->where('user_id', $user->id);
        } else {
            // Aucun résultat par défaut
            $louerChambresQuery->whereRaw('0=1');
            $interventionsQuery->whereRaw('0=1');
            $historiquesPaiementQuery->whereRaw('0=1');
        }

        $paiementespeces = \App\Models\PaiementEspece::where('statut', 'EN ATTENTE')
            ->whereHas('louerchambre.chambre.maison', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['louerchambre.chambre.maison', 'louerchambre.user']) // optimisation
            ->latest()
            ->get();


        $paiementespecesvalid = \App\Models\PaiementEspece::where('statut', 'EN ATTENTE')
            ->whereHas('louerchambre.chambre.maison', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['louerchambre.chambre.maison', 'louerchambre.user']) // optimisation
            ->latest()
            ->count();







        // Exécuter les requêtes avec les relations utiles
        $louerChambres = $louerChambresQuery->with(['chambre.maison', 'user'])->latest()->paginate(10);
        $interventions = $interventionsQuery->with(['louerchambre.chambre.maison', 'louerchambre.user'])->latest()->get();
        $historiquesPaiement = $historiquesPaiementQuery->with(['louerchambre.chambre.maison', 'user'])->latest()->paginate(10);

        // Statistiques
        $userId = $user->id;
        $chambreIds = Chambre::whereHas('maison', fn($q) => $q->where('user_id', $userId))->pluck('id');
        // $louerIds = LouerChambre::where('statut', 'CONFIRMER')->pluck('id');


        $nombreMaisons = Maison::where('user_id', $userId)->count();
        $nombreChambres = Chambre::whereHas('maison', fn($q) => $q->where('user_id', $userId))->count();
        $nombreOccupations = LouerChambre::whereIn('chambre_id', $chambreIds)
            ->where('statut', 'CONFIRMER')
            ->count();

        $chambreIds = \App\Models\Chambre::whereHas('maison', function ($query) {
            $query->where('user_id', auth()->id());
        })->pluck('id');

        $revenusMensuels = \App\Models\LouerChambre::whereIn('chambre_id', $chambreIds)
            ->where('statut', 'CONFIRMER')
            ->sum('loyer');

        $montantAbonnement =  $revenusMensuels * 5 / 100;


        $interventionsEnAttente = $interventionsQuery->where('statut', 'EN ATTENTE')->count();



        // Spécifique au locataire
        $loyerMensuel = null;
        $paiementsEnRetard = null;
        $prochainPaiement = null;
        $chambreCount = null;

        if ($user->hasRole('locataire')) {
            $loyerMensuel = $louerChambres->sum('loyer');
            $chambreCount = $louerChambres->count();
            $paiementsEnRetard = PaiementEnAttente::whereHas('louerchambre', fn($q) => $q->where('user_id', $userId))
                ->where('statut', 'EN RETARD')
                ->count();

            $prochainPaiement = HistoriquePaiement::where('user_id', $userId)
                ->where('datePaiement', '>', now())
                ->orderBy('datePaiement')
                ->first();
        }

        return view('dashboard', [
            'maisons' => $maisons,
            'categories' => $categories,
            'types' => $types,
            'maison' => null,
            'louerChambres' => $louerChambres,
            'interventions' => $interventions,
            'historiquesPaiement' => $historiquesPaiement,
            'revenusMensuels' => $revenusMensuels,
            'interventionsEnAttente' => $interventionsEnAttente,
            'nombreMaisons' => $nombreMaisons,
            'nombreChambres' => $nombreChambres,
            'nombreOccupations' => $nombreOccupations,
            'loyerMensuel' => $loyerMensuel,
            'paiementsEnRetard' => $paiementsEnRetard,
            'prochainPaiement' => $prochainPaiement,
            'chambreCount' => $chambreCount,
            'moyenPaiements' => $moyenPaiements,
            'paiementespeces' => $paiementespeces,
            'paiementespecesvalid' => $paiementespecesvalid,
            'montantAbonnement' => $montantAbonnement
        ])->with('i', ($request->input('page', 1) - 1) * $maisons->perPage());
    }





    public function enregistrerPaiement(string $transaction_id)
    {

        $superAdmin = User::whereHas('roles', function ($q) {
            $q->where('name', 'Super-admin');
        })->first();

        $moyenPaiement = MoyenPaiement::where('user_id', $superAdmin->id)
            ->where('isActive', 1)
            ->first();

        if (!$moyenPaiement) {
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
        //   dump($transaction);
        if (
            isset($transaction['v1/transaction']['status']) &&
            $transaction['v1/transaction']['status'] == 'approved' &&
            isset($transaction['v1/transaction']['amount']) &&
            intval($transaction['v1/transaction']['amount']) == $transaction['v1/transaction']['amount']
        ) {
            // Vérifie si l'enregistrement existe déjà
            $existant = HistoriquePaiAdm::where('idTransaction', $transaction_id)->first();

            if (!$existant) {
                HistoriquePaiAdm::create([
                    'datePaiement' => now(),
                    'montant' => $transaction['v1/transaction']['amount'],
                    'modePaiement' => $transaction['v1/transaction']['mode'] ?? '',
                    'idTransaction' => $transaction_id,
                    'quittanceUrl' => $transaction['v1/transaction']['receipt_url'] ?? '',
                    'user_id' => auth()->id()
                ]);
            }
            return redirect()->back()
                ->with('success', 'Paiement effectué avec succès');
        } else {
            return Redirect::route('dashboard')
                ->with('error', 'Le paiement a échoué ou est introuvable. Veuillez payer d’abord.');
        }
    }
}
