<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chambre;
use App\Models\HistoriquePaiement;
use App\Models\Intervention;
use App\Models\LouerChambre;
use App\Models\Maison;
use App\Models\Paiementenattente;
use App\Models\Paiementespece;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'paiementespecesvalid' => $paiementespecesvalid
        ])->with('i', ($request->input('page', 1) - 1) * $maisons->perPage());
    }
}
