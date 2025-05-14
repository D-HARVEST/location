<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Intervention;
use App\Models\Louerchambre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        // Si l'utilisateur est un "locataire"
        if ($user->hasRole('locataire')) {
            $louerchambre = Louerchambre::where('user_id', $user->id)->first();

            if (!$louerchambre) {
                return view('intervention.index', ['interventions' => []])
                    ->with('message', 'Aucune chambre associée à cet utilisateur.');
            }
            $interventions = Intervention::where('louerchambre_id', $louerchambre->id)->paginate();
        } else if ($user->hasRole('gerant')) {
            // Récupère les ID des chambres des maisons gérées par le gérant
            $chambreIds = \App\Models\Chambre::whereHas('maison', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->pluck('id');

            // Récupère les ID des locations associées à ces chambres
            $louerchambreIds = \App\Models\Louerchambre::whereIn('chambre_id', $chambreIds)->pluck('id');

            // Récupère les interventions associées à ces louerchambres
            $interventions = Intervention::whereIn('louerchambre_id', $louerchambreIds)->latest()->paginate(10);
        } else if ($user->hasRole('Super-Admin')) {
            $interventions = Intervention::latest()->paginate(10);
        }

        return view('intervention.index', compact('interventions'))
            ->with('i', ($request->input('page', 1) - 1) * $interventions->perPage());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $intervention = new Intervention();

        return view('intervention.create', compact('intervention'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InterventionRequest $request): RedirectResponse
    {
        // Récupérer l'ID de la chambre louée par l'utilisateur connecté
        $userId = Auth::id();
        $louerchambre = Louerchambre::where('user_id', $userId)->first();

        if (!$louerchambre) {
            return redirect()->route('interventions.index')
                ->withErrors(['Vous n\'avez pas de chambre louée associée.']);
        }

        // Valider et créer l'intervention
        $all = $request->validated();
        $all['louerchambre_id'] = $louerchambre->id;

        Intervention::create($all);

        return Redirect::route('interventions.index')
            ->with('success', 'Intervention créée avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $intervention = Intervention::findOrFail($id);

        return view('intervention.show', compact('intervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $intervention = Intervention::findOrFail($id);

        return view('intervention.edit', compact('intervention'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterventionRequest $request, Intervention $intervention): RedirectResponse
    {
        // Vérifier si l'intervention appartient à l'utilisateur connecté
        $userId = Auth::id();
        $louerchambre = Louerchambre::where('user_id', $userId)->first();

        if (!$louerchambre) {
            return redirect()->route('interventions.index')
                ->withErrors(['Vous n\'avez pas de chambre louée associée.']);
        }

        // Vérifier si l'intervention appartient bien à cette chambre louée
        if ($intervention->louerchambre_id != $louerchambre->id) {
            return redirect()->route('interventions.index')
                ->withErrors(['Vous ne pouvez pas modifier cette intervention.']);
        }

        // Valider et mettre à jour l'intervention
        $all = $request->validated();
        $intervention->update($all);

        return Redirect::route('interventions.index')
            ->with('success', 'Intervention mise à jour avec succès !');
    }

    public function confirmer($id): RedirectResponse
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->update(['statut' => 'CONFIRMER']);

        return redirect()->route('interventions.index')->with('success', 'Intervention confirmée avec succès.');
    }

    public function rejeter($id): RedirectResponse
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->update(['statut' => 'REJETER']);

        return redirect()->route('interventions.index')->with('success', 'Intervention rejetée avec succès.');
    }


    public function destroy($id): RedirectResponse
    {
        $data = Intervention::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Intervention !" . $th->getMessage()]);
        }


        return Redirect::route('interventions.index')
            ->with('success', 'Intervention a été supprimé(e) avec succes !');
    }
}
