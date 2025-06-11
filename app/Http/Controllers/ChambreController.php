<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChambreRequest;
use App\Models\Category;
use App\Models\Chambre;
use App\Models\Louerchambre;
use App\Models\Maison;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $chambres = Chambre::where('user_id', Auth::id())->paginate();

        return view('chambre.index', compact('chambres'))
            ->with('i', ($request->input('page', 1) - 1) * $chambres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $chambre = new Chambre();
        $categories = Category::pluck('libelle', 'id');
        $maisons = Maison::pluck('libelle', 'id');
        $types = Type::pluck('libelle', 'id');
        $maisonId = $request->query('maison_id');
        $maison = Maison::find($maisonId);

        return view('chambre.create', compact('chambre', 'categories', 'maisons', 'types', 'maison'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChambreRequest $request): RedirectResponse
    {
        $all = $request->validated();
        
        Chambre::create($all);

        return Redirect::route('dashboard')
            ->with('success', 'Chambre a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = Auth::user();
        $chambre =  Chambre::findOrFail($id);

        // if ($user->hasRole('gerant') && $chambre->user_id !== $user->id) {
        //     abort(403, 'Accès non autorisé.');
        // }

        if ($user->hasRole('locataire')) {
            $hasRented = Louerchambre::where('chambre_id', $id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$hasRented) {
                abort(403, 'Accès non autorisé.');
            }

            // Ne montrer que ses propres locations
            $louerchambres = Louerchambre::where('chambre_id', $id)
                ->where('user_id', $user->id)
                ->paginate(10);
        } else {
            // Pour les gérants (ayant passé la vérification plus haut)
            $louerchambres = Louerchambre::where('chambre_id', $id)
                ->with('user')
                ->paginate(10);
        }

        $user = new User();
        $chambres = Chambre::pluck('libelle', 'id');
        $louerchambre = Louerchambre::where('chambre_id', $id)->first(); // ou selon ta logique métier

        return view('chambre.show', compact('chambre', 'louerchambres', 'user', 'chambres', 'louerchambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $chambre = Chambre::findOrFail($id);
        $categories = Category::pluck('libelle', 'id');
        $maisons = Maison::pluck('libelle', 'id');
        $types = Type::pluck('libelle', 'id');

        return view('chambre.edit', compact('chambre', 'categories', 'maisons', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChambreRequest $request, Chambre $chambre): RedirectResponse
    {
        $all = $request->validated();
        $chambre->update($all);

        // Recharger le modèle pour s'assurer d'avoir la dernière valeur du loyer
        $chambre->refresh();
        // Mettre à jour le loyer dans la table louerchambres
        DB::table('louerchambres')
            ->where('chambre_id', $chambre->id)
            ->update(['jourPaiementLoyer' => $chambre->jourPaiementLoyer, 'loyer' => $chambre->loyer]);


        return Redirect::route('dashboard')
            ->with('success', 'Chambre a été mis(e) à jour avec succes !');
    }




    public function destroy($id): RedirectResponse
    {
        $data = Chambre::findOrFail($id);

        try {
            $maisonId = $data->maison_id; // Assure-toi que ce champ existe bien
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Chambre !" . $th->getMessage()]);
        }

        return Redirect::route('dashboard')
            ->with('success', 'Chambre a été supprimé(e) avec succes !');
    }


    public function validateStatut(Request $request)
    {
        $request->validate([
            'statut' => ['required', 'string', 'in:EN ATTENTE,CONFIRMER,REJETER,ARCHIVER'],
            'id' => ['required', 'exists:louerchambres,id'],
        ]);

        $louerchambre = Louerchambre::findOrFail($request->id);
        $louerchambre->update([
            'statut' => $request->statut
        ]);

        $chambre = Chambre::find($louerchambre->chambre_id);
        if ($chambre) {
            if ($request->statut === 'CONFIRMER') {
                $chambre->update(['statut' => 'Non disponible']);
            } else {
                $chambre->update(['statut' => 'Disponible']);
            }
        }

        return redirect()->back()->with('success', "Statut mis à jour avec succès !");
    }
}
