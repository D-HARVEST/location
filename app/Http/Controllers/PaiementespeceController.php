<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Louerchambre;
use Illuminate\Http\Request;
use App\Models\Paiementespece;
use App\Models\Historiquepaiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PaiementespeceRequest;

class PaiementespeceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paiementespeces = Paiementespece::paginate();

        return view('paiementespece.index', compact('paiementespeces'))
            ->with('i', ($request->input('page', 1) - 1) * $paiementespeces->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $paiementespece = new Paiementespece();

        $louerchambre = Louerchambre::with('user', 'chambre.maison')
        ->findOrFail($request->louerchambre_id);

        return view('paiementespece.create', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaiementespeceRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $paiementespece = Paiementespece::create($all);

         $louerchambre = Louerchambre::findOrFail($paiementespece->louerchambre_id);

       Historiquepaiement::create([
        'louerchambre_id' => $paiementespece->louerchambre_id,
        'datePaiement'    => $paiementespece->DateReception,
        'montant'         => $paiementespece->Montant,
        'modePaiement'    => 'Espece',
        'idTransaction'   => $paiementespece->id,
        'moisPaiement'    => $paiementespece->Mois,
        'user_id'         => $louerchambre->user_id,
    ]);

        return Redirect::route('louerchambres.show', ['louerchambre' => $paiementespece->louerchambre_id])
            ->with('success', 'Paiement en espèce enregistré avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paiementespece = Paiementespece::findOrFail($id);

        $louerchambre = Louerchambre::with('user', 'chambre.maison')
        ->findOrFail($paiementespece->louerchambre_id);

        return view('paiementespece.show', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paiementespece = Paiementespece::findOrFail($id);
        $louerchambre = Louerchambre::with('user', 'chambre.maison')
        ->findOrFail($paiementespece->louerchambre_id);

        return view('paiementespece.edit', compact('paiementespece', 'louerchambre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaiementespeceRequest $request, Paiementespece $paiementespece): RedirectResponse
    {
        $all=$request->validated();
        $paiementespece->update($all);

        return Redirect::route('louerchambres.show', ['louerchambre' => $paiementespece->louerchambre_id])
            ->with('success', 'Paiement en espèce a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = Paiementespece::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Paiementespece !" . $th->getMessage()]);
        }


        return Redirect::route('louerchambres.show', ['louerchambre' => $data->louerchambre_id])
            ->with('success', 'Paiement en espèce a été supprimé(e) avec succes !');
    }
}
