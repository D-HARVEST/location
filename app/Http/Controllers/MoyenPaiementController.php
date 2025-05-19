<?php

namespace App\Http\Controllers;

use App\Models\MoyenPaiement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MoyenPaiementRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MoyenPaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $moyenPaiements = MoyenPaiement::paginate();

        return view('moyen-paiement.index', compact('moyenPaiements'))
            ->with('i', ($request->input('page', 1) - 1) * $moyenPaiements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $moyenPaiement = new MoyenPaiement();

        return view('moyen-paiement.create', compact('moyenPaiement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MoyenPaiementRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $all['user_id'] = auth()->user()->id;
        MoyenPaiement::create($all);

        return Redirect::route('moyen-paiements.index')
            ->with('success', 'MoyenPaiement a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $moyenPaiement = MoyenPaiement::findOrFail($id);

        return view('moyen-paiement.show', compact('moyenPaiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $moyenPaiement = MoyenPaiement::findOrFail($id);

        return view('moyen-paiement.edit', compact('moyenPaiement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoyenPaiementRequest $request, MoyenPaiement $moyenPaiement): RedirectResponse
    {
        $all=$request->validated();
        $moyenPaiement->update($all);

        return Redirect::route('moyen-paiements.index')
            ->with('success', 'MoyenPaiement a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = MoyenPaiement::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du MoyenPaiement !" . $th->getMessage()]);
        }


        return Redirect::route('moyen-paiements.index')
            ->with('success', 'MoyenPaiement a été supprimé(e) avec succes !');
    }
}
