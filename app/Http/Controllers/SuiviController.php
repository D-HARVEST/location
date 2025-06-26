<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;
use App\Models\HistoriquePaiement;
use Illuminate\Support\Facades\Auth;

class SuiviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $chambres = Chambre::whereHas('maison', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('historiquePaiements') // pour charger les historiques de chaque chambre
        ->get();
        return view('suivi_mensuel', compact('chambres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
