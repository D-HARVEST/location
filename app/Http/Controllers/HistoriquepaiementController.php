<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoriquepaiementRequest;
use App\Models\HistoriquePaiement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\LouerChambre;

class HistoriquepaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $historiquepaiements = HistoriquePaiement::paginate();

        return view('historiquepaiement.index', compact('historiquepaiements'))
            ->with('i', ($request->input('page', 1) - 1) * $historiquepaiements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(HistoriquepaiementRequest $request): RedirectResponse
    {
        $all = $request->validated();
        HistoriquePaiement::create($all);

        return Redirect::route('historiquepaiements.index')
            ->with('success', 'Historiquepaiement a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $historiquepaiement = HistoriquePaiement::findOrFail($id);

        return view('historiquepaiement.show', compact('historiquepaiement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $historiquepaiement = HistoriquePaiement::findOrFail($id);

        return view('historiquepaiement.edit', compact('historiquepaiement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HistoriquepaiementRequest $request, HistoriquePaiement $historiquepaiement): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('quittanceUrl')) {
            $file = $request->file('quittanceUrl');

            // Facultatif : supprimer l'ancienne quittance si elle existe
            if ($historiquepaiement->quittanceUrl) {
                Storage::disk('public')->delete($historiquepaiement->quittanceUrl);
            }

            $path = $file->store('quittances', 'public');
            $data['quittanceUrl'] = $path;
        }

        $historiquepaiement->update($data);

        return Redirect::route('louerchambres.show', ['louerchambre' => $historiquepaiement->louerchambre_id])
            ->with('success', 'Historiquepaiement mis à jour avec succès.');
    }

    public function destroy($id): RedirectResponse
    {
        $data = HistoriquePaiement::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Historiquepaiement !" . $th->getMessage()]);
        }


        return Redirect::route('louerchambres.show', ['louerchambre' => $data->louerchambre_id])
            ->with('success', 'Historiquepaiement a été supprimé(e) avec succes !');
    }



    public function create()
    {
        $user = auth()->user();

        $louerchambre = LouerChambre::where('user_id', $user->id)
                            ->latest()
                            ->first();

        // Vérifier si le statut est bien "CONFIRMER"
        if (!$louerchambre || $louerchambre->statut !== 'CONFIRMER') {
            return redirect()->back()->with('error', 'Veuillez confirmer d\'abord votre statut avant de procéder au paiement.');
        }

        $montantLoyer = $louerchambre->loyer;

        return view('historiquepaiement.create', compact('montantLoyer'));
    }




   public function aprespaiement(string $transaction_id)
   {
       if (HistoriquePaiement::where("idTransaction", $transaction_id)->exists()) {
           return redirect("/historiquepaiements")->with("error", "Ce paiement a déjà été enregistré.");
       }

       $historiquepaiements = HistoriquePaiement::where("idTransaction", $transaction_id)->first();

       $response = Http::withToken(env("FEDAPAY_PRIVATE_KEY"))
           ->accept('application/json')
           ->get("https://sandbox-api.fedapay.com/v1/transactions/{$transaction_id}", [
               'include' => 'customer.phone_number,currency,payment_method',
               'locale' => 'fr'
           ]);


       $res = $response->json();


       if (isset($res['v1/transaction']['status']) && $res['v1/transaction']['status'] == 'approved' && intval($res['v1/transaction']['amount']) == intval($historiquepaiements->getMontant())) {
           $historiquepaiements->update([
               'TransactionId' => $transaction_id,

           ]);


           return view("layouts.succes", ["message" => "Paiement effectué avec succès."]);
       }

       return view("layouts.echec", ["message" => "Le paiement a échoué ou n’a pas été retrouvé."]);
   }
}
