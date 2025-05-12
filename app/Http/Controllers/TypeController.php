<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $types = Type::paginate();

        return view('type.index', compact('types'))
            ->with('i', ($request->input('page', 1) - 1) * $types->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $type = new Type();

        return view('type.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request): RedirectResponse
    {
        $all = $request->validated();
        Type::create($all);

        return Redirect::route('types.index')
            ->with('success', 'Type a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $type = Type::findOrFail($id);

        return view('type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $type = Type::findOrFail($id);

        return view('type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type): RedirectResponse
    {
        $all=$request->validated();
        $type->update($all);

        return Redirect::route('types.index')
            ->with('success', 'Type a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {
        $data = Type::findOrFail($id);

        try {
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(["Une erreur s'est produite lors de la suppression du Type !" . $th->getMessage()]);
        }


        return Redirect::route('types.index')
            ->with('success', 'Type a été supprimé(e) avec succes !');
    }
}
