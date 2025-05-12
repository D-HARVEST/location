<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChambreRequest;
use App\Http\Requests\MaisonRequest;
use App\Models\Category;
use App\Models\Chambre;
use App\Models\Maison;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        
        $maisons = Maison::where('user_id', Auth::id())->paginate();

        return view('maison.index', compact('maisons'))
            ->with('i', ($request->input('page', 1) - 1) * $maisons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $maison = new Maison();
        $categories = Category::pluck('libelle', 'id');
        return view('maison.create', compact('maison', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaisonRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $all['user_id'] = Auth::id();
        Maison::create($all);

        return Redirect::route('maisons.index')
            ->with('success', 'Maison a été créé(e) avec succes !');
    }


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $maison = Maison::findOrFail($id);
        $chambre = null;
        $chambres = Chambre::paginate();
        $chambres = $maison->chambres()->paginate();
        $categories = Category::pluck('libelle', 'id');
        $maisons = Maison::pluck('libelle', 'id');
        $types = Type::pluck('libelle', 'id');
        return view('maison.show', compact('maison', 'chambre', 'chambres', 'categories', 'maisons', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $maison = Maison::findOrFail($id);
        $categories = Category::pluck('libelle', 'id');
        return view('maison.edit', compact('maison', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaisonRequest $request, Maison $maison): RedirectResponse
    {
        $all=$request->validated();
        $maison->update($all);

        return Redirect::route('maisons.index')
            ->with('success', 'Maison a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = Maison::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Maison !" . $th->getMessage()]);
        }


        return Redirect::route('maisons.index')
            ->with('success', 'Maison a été supprimé(e) avec succes !');
    }
}
