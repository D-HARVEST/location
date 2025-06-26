<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaiementenattenteRequest;
use App\Models\HistoriquePaiement;
use App\Models\Paiementenattente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PaiementenattenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $today = Carbon::today();

        $paiementenattentes = Paiementenattente::with('louerchambre')
            ->get()
            ->filter(function ($paiement) use ($today) {
                $dateLimite = Carbon::parse($paiement->dateLimite);
                $mois = $dateLimite->format('m');
                $annee = $dateLimite->format('Y');

                $jourPaiement = $paiement->louerchambre->jourPaiementLoyer ?? 0;

                // 1. Vérifie si la date d’aujourd’hui dépasse le jourPaiement du mois
                if ($today->day <= $jourPaiement) {
                    return false; // trop tôt
                }

                // 2. Vérifie si un paiement existe déjà pour le mois
                $existeDeja = HistoriquePaiement::where('louerchambre_id', $paiement->louerchambre_id)
                    ->whereYear('datePaiement', $annee)
                    ->whereMonth('datePaiement', $mois)
                    ->exists();

                return !$existeDeja;
            });

        return view('paiementenattente.index', [
            'paiementenattentes' => $paiementenattentes->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $paiementenattente = new Paiementenattente();

        return view('paiementenattente.create', compact('paiementenattente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaiementenattenteRequest $request): RedirectResponse
    {
        $all = $request->validated();
        Paiementenattente::create($all);

        return Redirect::route('paiementenattentes.index')
            ->with('success', 'Paiementenattente a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $paiementenattente = Paiementenattente::findOrFail($id);

        return view('paiementenattente.show', compact('paiementenattente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $paiementenattente = Paiementenattente::findOrFail($id);

        return view('paiementenattente.edit', compact('paiementenattente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaiementenattenteRequest $request, Paiementenattente $paiementenattente): RedirectResponse
    {
        $all=$request->validated();
        $paiementenattente->update($all);

        return Redirect::route('paiementenattentes.index')
            ->with('success', 'Paiementenattente a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = Paiementenattente::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Paiementenattente !" . $th->getMessage()]);
        }


        return Redirect::route('paiementenattentes.index')
            ->with('success', 'Paiementenattente a été supprimé(e) avec succes !');
    }
}
