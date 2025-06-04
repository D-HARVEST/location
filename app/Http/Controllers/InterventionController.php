<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Intervention;
use App\Models\Louerchambre;
use App\Notifications\InterventionSoumise;
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
    public function index(Request $request)
    {
        $user = Auth::user();

        // Si l'utilisateur est un "locataire"
        if ($user->hasRole('locataire')) {
            $louerchambre = $user->louerChambres;
            $interventions = $user->interventions()->paginate(10);
        }
        // Si l'utilisateur est un "gérant"
        else if ($user->hasRole('gerant')) {
            // Récupère les ID des chambres des maisons gérées par le gérant
            $chambreIds = Chambre::whereHas('maison', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->pluck('id');

            // Récupère les ID des louerchambres associées à ces chambres
            $louerchambreIds = Louerchambre::whereIn('chambre_id', $chambreIds)->pluck('id');

            // Récupère les interventions associées à ces louerchambres
            $interventions = Intervention::whereIn('louerchambre_id', $louerchambreIds)
                ->latest()
                ->paginate(10);
        }
        // Si l'utilisateur est un super admin
        else if ($user->hasRole('Super-Admin')) {
            $interventions = Intervention::latest()->paginate(10);
        }

        return view('dashboard', compact('interventions'))
            ->with('i', ($request->input('page', 1) - 1) * $interventions->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        $intervention = new Intervention();
        $louerchambres = Auth::user()->louerChambres;


        return view('intervention.create', compact('intervention', 'louerchambres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InterventionRequest $request): RedirectResponse
    {

        $all = $request->validated();
        $intervention = Intervention::create($all);

        $louerchambre = $intervention->louerchambre;
        $chambre = $louerchambre->chambre ?? null;
        $maison = $chambre->maison ?? null;
        $gerant = $maison?->user;

        if ($gerant && $gerant->hasRole('gerant')) {
            $gerant->notify(new InterventionSoumise($intervention));
        }

        return Redirect::route('dashboard')
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
        $user = Auth::user();
        $louerchambres = Auth::user()->louerChambres;
        $intervention = Intervention::findOrFail($id);

        return view('intervention.edit', compact('intervention', 'louerchambres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterventionRequest $request, Intervention $intervention): RedirectResponse
    {



        $all = $request->validated();
        $intervention->update($all);

        return Redirect::route('interventions.index')
            ->with('success', 'Intervention mise à jour avec succès !');
    }

    public function confirmer($id): RedirectResponse
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->update(['statut' => 'CONFIRMER']);

        return redirect()->route('dashboard')->with('success', 'Intervention confirmée avec succès.');
    }

    public function rejeter($id): RedirectResponse
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->update(['statut' => 'REJETER']);

        return redirect()->route('dashboard')->with('success', 'Intervention rejetée avec succès.');
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


        return Redirect::route('dashboard')
            ->with('success', 'Intervention a été supprimé(e) avec succes !');
    }
}
